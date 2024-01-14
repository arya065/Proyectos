<?php
class Fruta
{
    private $color, $tamano;
    function __construct($color, $tamano)
    {
        $this->color = $color;
        $this->tamano = $tamano;
    }
    function getColor()
    {
        echo $this->color;
    }
    function setColor($color)
    {
        $this->color = $color;
    }
    function getTamano()
    {
        echo $this->tamano;
    }
    function setTamano($tamano)
    {
        $this->tamano = $tamano;
    }
    function imprimir()
    {
        echo "Esta es una fruta de color $this->color de tamano $this->tamano";
    }
}
$fruta1 = new Fruta("test1", "test2");
$fruta1->imprimir();
