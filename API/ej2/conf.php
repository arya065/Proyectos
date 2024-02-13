<?php
/* define("DIR_SERV", "http://proyectos/API/ej1/primera_api");*/
define("DIR_SERV", "http://localhost/Proyectos/API/ej2/login_restful/");
define("USER", "jose");
define("PASS", "josefa");
define("DB_NAME", "bd_foro");

/*
ASK API
$app->get("/url", function () {
    $conn = createConn();
    $sql = "SELECT * FROM usuarios";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->debugDumpParams();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array("result" => $res));
    $conn = null;

});
CREATE CONNECTION
function createConn()
{
    try {
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        $conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, USER, PASS, $opt);
        return $conn;
    } catch (PDOException $e) {
        echo "No ha podido crear conexion: " . $e->getMessage();
    }
}
GET FROM API
function getAllProd()
{
    $url = DIR_SERV . "/url";
    $response = consumir_servicios_REST($url, "GET");
    print_r($response);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
}
*/
