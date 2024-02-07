<?php
function getList()
{
    $data = file_get_contents("./data/database.json");
    return json_decode($data)->results;
}
function setList($list)
{
    file_put_contents("./data/database.json", $list);
}
function addToList($value)
{
    $list = getList();
    // print_r(json_encode($value));
    $list[] = $value;
    print_r($list);
}
function getAll()
{
    $list = getList();
    echo '<table border="1px">';
    echo '<tr>';
    echo '<th>Id</th>';
    echo '<th>Points</th>';
    echo '<th>Accion</th>';
    echo '</tr>';
    foreach ($list as $key => $value) {
        echo "<tr>";
        foreach ($value->result as $value2) {
            echo "<td>";
            print_r($value2);
            echo "</td>";
        }
        echo "<td>Borrar-modificar</td>";
        echo "</tr>";
    }
    echo '</table>';
}
function getWithId($id)
{
    $find = false;
    $list = getList();
    echo '<table border="1px">';
    echo '<tr>';
    echo '<th>Id</th>';
    echo '<th>Points</th>';
    echo '<th>Accion</th>';
    echo '</tr>';
    echo "<tr>";
    echo "<td>";
    print_r($id);
    echo "</td>";
    foreach ($list as $value) {
        if (!$find) {
            foreach ($value->result as $key => $value2) {
                if ($key == "id" && $value2 == $id) {
                    echo "<td>";
                    print_r($value2);
                    echo "</td>";
                    echo "<td>Borrar-modificar</td>";
                    break;
                }
            }
        } else {
            break;
        }
    }
    echo "</tr>";
    echo '</table>';
}
