<?php
namespace Model;

/**
 * Clase Vendedor
 *
 * Representa un registro de la tabla `vendedores`.
 *
 * @property int    $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $telefono
 * @property string $descripcion
 */
class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';
     protected static $columnasDB = ['id', 'nombre', 'apellidos', 'telefono', 'descripcion'];

    public $id;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $descripcion;

    public function __construct($args = [])
    {
        $this->id        = $args['id'] ?? null;
        $this->nombre    = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono  = $args['telefono'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
    }

    public function validar()
    {
        self::$errores = [];

        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        } elseif (strlen($this->nombre) < 3) {
            self::$errores[] = "El nombre debe tener al menos 3 caracteres";
        }

        if (!$this->apellidos) {
            self::$errores[] = "Los apellidos son obligatorios";
        } elseif (strlen($this->apellidos) < 3) {
            self::$errores[] = "Los apellidos deben tener al menos 3 caracteres";
        }

        if (!$this->telefono) {
            self::$errores[] = "El teléfono es obligatorio";
        } elseif (!preg_match('/^[0-9]{9}$/', $this->telefono)) {
            self::$errores[] = "El teléfono debe tener exactamente 9 dígitos numéricos";
        } elseif (substr($this->telefono, 0, 1) !== '9') {
            self::$errores[] = "El teléfono debe comenzar con 9";
        }

        return self::$errores;
    }
    public function eliminar()
{
    // Verificar si el vendedor tiene propiedades asociadas
    $query = "SELECT COUNT(*) as total FROM propiedades WHERE vendedor_id = ?";
    $stmt = self::$db->prepare($query);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($resultado['total'] > 0) {
        // Si hay propiedades asociadas, no eliminar
        return false; // devolvemos false en lugar de echo
    }

    // Si no tiene propiedades, proceder con la eliminación
    $stmt = self::$db->prepare("DELETE FROM " . static::$tabla . " WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $this->id);
    $ejecutado = $stmt->execute();
    $stmt->close();

    return $ejecutado;
}
}