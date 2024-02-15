<?php
// define("DIR_SERV", "http://localhost/Proyectos/API/ej2/login_restful");
// define("USER", "jose");
// define("PASS", "josefa");
// define("DB_NAME", "bd_foro");

/*
MAKE API
$app->get("/url", function ($request) {
    try {
    $conn = createConn();
    $sql = "SELECT * FROM usuarios";
    $stmt = $conn->prepare($sql);
    $param = $request->getParam("usuarioAbajo");
    $param = $request->getAttribute("usuarioArriba");
    $stmt->execute([param]);
    $stmt->debugDumpParams();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array("result" => $res));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
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
ASK API
function getAllProd()
{
    $url = DIR_SERV . "/url";
    $response = consumir_servicios_REST($url, "GET");
    $response = consumir_servicios_REST($url, "GET", $dataPorAbajo); -- это для передачи данных с формы
    print_r($response);
    $obj = json_decode($response);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
    }
    return $obj;
}
FILE READ
function readAndWrite(){
    $data = file_get_contents("path/to/file/file.json");
    file_put_contents("path/to/file/file.json", json_encode($data));
}
TIMEOUT
function timeout()
{
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 120)) {
        session_unset();
        session_destroy();
        return true;
    }
    $_SESSION['LAST_ACTIVITY'] = time();
    return false;
}
if (!timeout() && stillExist($_SESSION["usuario"])) {} 
*/
