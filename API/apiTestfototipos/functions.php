<?php
function setCookies()
{
    $cookieName = "passed";
    $cookieValue = true;
    setcookie($cookieName, $cookieValue, time() + (30), "/");
}
function getList()
{
    $data = file_get_contents("./data/database.json");
    return json_decode($data);
}
function setList($list)
{
    file_put_contents("./data/database.json", json_encode($list));
    return json_encode($list);
}
function addToList($id, $points)
{
    if (isset($_COOKIE["passed"])) {
        return json_encode(array("message" => "No se puede pasar el test mas de un vez"));
    } else {
        setCookies();
        $value = ["result" => ["id" => (int) $id, "points" => (int) $points]];
        $list = getList();
        $list[] = $value;
        return setList($list);
    }
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
                    return ["result" => $value->result];
                }
            }
        }
    }
    return ["result" => ["id" => null, "points" => null]];
}
