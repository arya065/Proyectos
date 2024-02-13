<?php
class Empleado
{
    private $nombre, $sueldo;
    function __construct($nombre, $sueldo)
    {
        $this->nombre = $nombre;
        $this->sueldo = $sueldo;
    }
    function print()
    {
        echo "Nombre: $this->nombre";
        if ($this->sueldo > 3000) {
            echo " Tiene que pagar impuestos";
        } else {
            echo " No tiene que pagar impuestos";
        }
    }
}
$emp = new Empleado("test", 4000);
$emp->print();
