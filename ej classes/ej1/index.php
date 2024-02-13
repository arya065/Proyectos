<?php
class Fruta
{
    private $color, $tamano;
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
}
$fruta1 = new Fruta();
$fruta1->setColor("test");
$fruta1->getColor();
$fruta1->setTamano("test2");
$fruta1->getTamano();
