<?php
function getList()
{
    $data = file_get_contents("./data/database.json");
    return json_decode($data)->results;
}
function setList($list)
{
    file_put_contents("./data/database.json", json_encode($list));
    print_r(getList());
    echo "<br>";
}
function addToList($id, $points)
{

    print_r(getList());
    echo "<br>";

    $value = ["result" => ["id" => $id, "points" => $points]];
    $list = getList();
    // print_r(json_encode($value));
    $list[] = $value;
    // print_r($list);
    echo "<br>";
    echo "<br>";

    foreach ($list as $key => $value2) {
        print_r(json_encode($value2));
        echo "<br>";
    }
    // setList($list);
}
function getAll()
{
    $list = getList();
    return $list;
}
function getWithId($id)
{
    $find = false;
    $list = getList();
    foreach ($list as $value) {
        if (!$find) {
            foreach ($value->result as $key => $value2) {
                if ($key == "id" && $value2 == $id) {
                    // print_r($value->result);
                    // echo "<br>";
                    return ["result" => $value->result];
                }
            }
        }
    }
    return ["result" => ["id" => null, "points" => null]];
}
