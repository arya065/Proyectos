<?php
class Film
{
    private $nombre, $ano, $director, $precio, $alquilada, $fecha_dev, $recarga;
    static $list = [];
    function __construct($nombre = "value1", $ano = "1970", $director = "value1", $precio = 1, $alquilada = 0, $fecha_dev = "1 January 2024", $recarga = 0)
    {

        if ($this->getFilm($nombre) == -1) {
            $this->nombre = $nombre;
            $this->ano = $ano;
            $this->director = $director;
            $this->precio = $precio;
            $this->alquilada = $alquilada;
            $this->fecha_dev = $fecha_dev;
            $this->recarga = $recarga;
            self::$list[] = $this;
        }
    }
    function __destruct()
    {
        unset(self::$list[$this->getFilm($this->getName())]);
    }
    function getFilm($name)
    {
        foreach (self::$list as $i => $value) {
            if ($value->getName() == $name) {
                return $i;
            }
        }
        return -1;
    }
    public function getAllData()
    {
        return [$this->nombre, $this->ano, $this->director, $this->precio, $this->alquilada, $this->fecha_dev, $this->recarga];
    }
    public function getName()
    {
        return $this->nombre;
    }
}
