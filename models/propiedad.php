<?php
namespace Model;
/**
 * Clase Propiedad
 *
 * Representa un registro de la tabla `propiedades`.
 *
 * @property int    $id
 * @property string $titulo
 * @property float  $precio
 * @property string $imagen
 * @property string $descripcion
 * @property int    $habitaciones
 * @property int    $wc
 * @property int    $estacionamiento
 * @property string $creado
 * @property int    $vendedor_id
 */

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = [
        'id', 'titulo', 'precio', 'imagen', 'descripcion',
        'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedor_id'
    ];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedor_id;

    public static function fechaActual(): string
    {
        $timezone = $_ENV['APP_TIMEZONE'] ?? date_default_timezone_get();

        try {
            $zonaHoraria = new \DateTimeZone($timezone);
        } catch (\Exception $e) {
            $zonaHoraria = new \DateTimeZone('UTC');
        }

        return (new \DateTime('now', $zonaHoraria))->format('Y-m-d H:i:s');
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? null;
        $this->wc = $args['wc'] ?? null;
        $this->estacionamiento = $args['estacionamiento'] ?? null;

        $this->creado = $args['creado'] ?? self::fechaActual();

        $this->vendedor_id = $args['vendedor_id'] ?? null;
    }
    public function validar()
{
    self::$errores = [];

    if (!$this->titulo) {
        self::$errores[] = "Debes añadir un título";
    }

    if (!$this->precio || !is_numeric($this->precio) || $this->precio <= 0) {
        self::$errores[] = "El precio es obligatorio y debe ser mayor a 0";
    }

    if (!$this->imagen) {
        self::$errores[] = "La imagen es obligatoria";
    }

    if (strlen($this->descripcion) < 50) {
        self::$errores[] = "La descripción debe tener al menos 50 caracteres";
    }

    if (!$this->habitaciones || $this->habitaciones <= 0) {
        self::$errores[] = "El número de habitaciones es obligatorio";
    }

    if (!$this->wc || $this->wc <= 0) {
        self::$errores[] = "El número de baños es obligatorio";
    }

    if (!$this->estacionamiento || $this->estacionamiento < 0) {
        self::$errores[] = "El número de estacionamientos es obligatorio";
    }

    if ($this->vendedor_id === null || $this->vendedor_id === '' || !is_numeric($this->vendedor_id)) {
    self::$errores[] = "Debes elegir un vendedor válido";
} else {
    $vendedor = Vendedor::find((int)$this->vendedor_id);
    if (!$vendedor) {
        self::$errores[] = "El vendedor seleccionado no existe en la base de datos";
    }
}

    return self::$errores;
}
}