<?php
class Fruta
{
    private $color, $tamano;
    static $n_frutas = 0;
    function __construct($color, $tamano)
    {
        $this->color = $color;
        $this->tamano = $tamano;
        self::$n_frutas += 1;
    }
    function __destruct()
    {
        self::$n_frutas -= 1;
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
    static function cuantaFruta()
    {
        echo "n de instancias " . self::$n_frutas . "";
    }
}
$fruta1 = new Fruta("test1", "test2");
$fruta2 = new Fruta("test1", "test2");
$fruta3 = new Fruta("test1", "test2");
$fruta1->imprimir();
echo "<br>";
Fruta::cuantaFruta();
