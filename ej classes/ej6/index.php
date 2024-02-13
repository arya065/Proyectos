<?php
class Menu
{
    private $list;
    function __construct($arr)
    {
        $this->list = $arr;
    }
    function showVert()
    {
        $list = $this->list;
        echo '<ul>';
        foreach ($list as $value) {
            echo "<li>$value</li>";
        }
        echo '</ul>';
    }
    function showHor()
    {
        $list = $this->list;
        echo '<table border="1px">';
        echo '<tr>';
        foreach ($list as $value) {
            echo "<td>$value</td>";
        }
        echo '</tr>';
        echo '</table>';
    }
}
$menu = new Menu(["t1", 't2', 't3']);
$menu->showVert();
$menu->showHor();