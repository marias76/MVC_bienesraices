<?php
namespace Model;

/**
 * Clase base ActiveRecord
 *
 * @property int $id
 * @property string $imagen
 */


class ActiveRecord
{
    public $id;
    public $imagen;
    // conexión a la base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // errores de validación
    protected static $errores = [];

    // definir la conexión a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            // actualizar
            return $this->actualizar();
        } else {
            // crear nuevo registro
            return $this->crear();
        }
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    public function crear()
{
    $atributos = $this->sanitizarDatos();

    $campos = array_keys($atributos);
    $placeholders = implode(', ', array_fill(0, count($campos), '?'));
    $query = "INSERT INTO " . static::$tabla . " (" . implode(', ', $campos) . ") VALUES ($placeholders)";

    $stmt = self::$db->prepare($query);
    if ($stmt === false) {
        die("Error en prepare: " . self::$db->error);
    }

    // Construir tipos dinámicamente
    $tipos = '';
    $valores = [];
    foreach ($atributos as $campo => $valor) {
        if (in_array($campo, ['habitaciones','wc','estacionamiento','vendedor_id'])) {
            $tipos .= 'i'; // entero
            $valores[] = $valor ?? 0;
        } elseif ($campo === 'precio') {
            $tipos .= 'd'; // decimal/float
            $valores[] = $valor ?? 0.0;
        } else {
            $tipos .= 's'; // string
            $valores[] = $valor;
        }
    }

    $stmt->bind_param($tipos, ...$valores);
    $ejecutado = $stmt->execute();

    if ($ejecutado) {
        header('Location: /admin?resultado=1');
        exit;
    } else {
        echo "Error al insertar: " . $stmt->error;
    }

    $stmt->close();
    return $ejecutado;
}
    public function actualizar()
{
    $atributos = $this->sanitizarDatos();

    if (empty($atributos)) {
        die("Error: No hay valores para actualizar");
    }

    $campos = array_keys($atributos);
    $set = implode(', ', array_map(fn($campo) => "$campo = ?", $campos));

    $query = "UPDATE " . static::$tabla . " SET $set WHERE id = ? LIMIT 1";
    $stmt = self::$db->prepare($query);

    if ($stmt === false) {
        die("Error en prepare: " . self::$db->error);
    }

    // Construir tipos dinámicamente
    $tipos = '';
    $valores = [];
    foreach ($atributos as $campo => $valor) {
        if (in_array($campo, ['habitaciones','wc','estacionamiento','vendedor_id'])) {
            $tipos .= 'i'; // entero
            $valores[] = $valor ?? 0;
        } elseif ($campo === 'precio') {
            $tipos .= 'd'; // decimal/float
            $valores[] = $valor ?? 0.0;
        } else {
            $tipos .= 's'; // string
            $valores[] = $valor;
        }
    }

    // añadir el id al final
    $tipos .= 'i';
    $valores[] = $this->id;

    $stmt->bind_param($tipos, ...$valores);
    $resultado = $stmt->execute();

    $stmt->close();
    return $resultado;
}

    public function eliminar()
    {
        $stmt = self::$db->prepare("DELETE FROM " . static::$tabla . " WHERE id = ? LIMIT 1");
        if ($stmt === false) {
            die("Error en prepare: " . self::$db->error);
        }

        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->close();

        if ($this->imagen) {
            $this->eliminarImagen();
        }
        return true;
    }

    public function eliminarImagen()
    {
        if ($this->imagen) {
            $rutaImagen = CARPETA_IMAGENES . $this->imagen;
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }
    }

    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos()
{
    $atributos = $this->atributos();
    $sanitizado = [];

    foreach ($atributos as $key => $value) {
        if ($value === null) {
            // Mantener null sin sanitizar
            $sanitizado[$key] = null;
        } elseif (in_array($key, ['habitaciones','wc','estacionamiento','vendedor_id'])) {
            // Campos enteros
            $sanitizado[$key] = (int)$value;
        } elseif ($key === 'precio') {
            // Precio como float
            $sanitizado[$key] = (float)$value;
        } else {
            // El resto como string escapado
            $sanitizado[$key] = self::$db->real_escape_string((string)$value);
        }
    }

    return $sanitizado;
}
    public static function getErrores()
    {
        return static::$errores;
    }

    public function sincronizar($args = [])
{
    foreach ($args as $key => $value) {
        if (property_exists($this, $key)) {

            // Si el valor es cadena vacía, asignar null
            if ($value === '') {
                $this->$key = null;
                continue;
            }

            // Conversión automática según el tipo de campo
            if (in_array($key, ['habitaciones','wc','estacionamiento'])) {
                // Campos enteros
                $this->$key = (int)$value;
            } elseif ($key === 'vendedor_id') {
                // Vendedor: si no se selecciona nada, queda null
                $this->$key = $value !== '' ? (int)$value : null;
            } elseif ($key === 'precio') {
                // Precio como float
                $this->$key = (float)$value;
            } else {
                // El resto como string
                $this->$key = $value;
            }
        }
    }
}
    public static function all() {
    $query = "SELECT * FROM " . static::$tabla;
    $resultado = self::consultarSQL($query);
    return $resultado;
}

//obtiene determinado número de registros
    public static function get($cantidad) {
    $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;    
    $resultado = self::consultarSQL($query);
    return $resultado;
}

    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id LIMIT 1";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    protected static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        $resultado->free();
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    public function setImagen($imagen)
{
    // Si ya existe un registro con imagen previa, eliminarla
    if (!is_null($this->id) && $this->imagen) {
        $rutaImagen = CARPETA_IMAGENES . $this->imagen;
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }
    }

    // Asignar la nueva imagen si existe
    if ($imagen) {
        $this->imagen = $imagen;
    }
}
}