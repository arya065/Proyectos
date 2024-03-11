<?php
//home page file
// getApiSession();
// if (isset($_SESSION["user"])) {
//     echo "exist";
// }
// function errores()
// {
//     $err_form = false;
//     if (isset($_POST["enter"])) {
//         if ($_POST["usuario"] == "") {
//             $err_form = true;
//         }
//         if ($_POST["clave"] == "") {
//             $err_form = true;
//         }
//         return $err_form;
//     }
//     return true;
// }
// function getApiSession()
// {
//     if (!errores()) {
//         $tmp = login($_POST["usuario"], $_POST["clave"]);
//         $api_session = $tmp->api_session;
//         session_id($api_session);
//         session_start();
//     }
// }

//functions file
// function createConn()
// {
//     try {
//         $opt = [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//             PDO::ATTR_EMULATE_PREPARES => false
//         ];
//         $conn = new PDO("mysql:host=localhost;dbname=" . DB_NAME, USER, PASS, $opt);
//         return $conn;
//     } catch (PDOException $e) {
//         echo "No ha podido crear conexion: " . $e->getMessage();
//     }
// }
// // ASK API
// function consumir_servicios_REST($url, $metodo, $datos = null)
// {
//     $llamada = curl_init();
//     curl_setopt($llamada, CURLOPT_URL, $url);
//     curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
//     if (isset($datos))
//         curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
//     $respuesta = curl_exec($llamada);
//     curl_close($llamada);
//     return $respuesta;
// }
// function login($user, $pass)
// {
//     $url = DIR_SERV . "/login";
//     $response = consumir_servicios_REST($url, "GET", ["usuario" => $user, "clave" => $pass]);
//     $obj = json_decode($response);
//     if (!$obj) {
//         die("<p>Error consumiendo el servicio: " . $url . "<p>" . $response);
//     }
//     return $obj;
// }

// API
// require "src/funciones_servicios.php";
// require __DIR__ . '/Slim/autoload.php';

// $app = new \Slim\App;

// $app->get('/login', function ($request) {
//     try {
//         $conn = createConn();
//         $sql = "SELECT * FROM usuarios WHERE usuario=? and clave = ?";
//         $stmt = $conn->prepare($sql);
//         $usuario = $request->getParam('usuario');
//         $clave = $request->getParam('clave');
//         //-----------------------------------
//         $usuario = "profesor1";
//         $clave = "123456";
//         //-------------------------------------
//         $stmt->execute([$usuario, md5($clave)]);
//         // echo $stmt->debugDumpParams() . PHP_EOL;
//         $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         //session params
//         session_start();
//         $_SESSION["api_session"] = session_id();
//         $_SESSION["user"] = $usuario;
//         $_SESSION["pass"] = $clave;
//         echo json_encode($res[0] == "" ? array ("mensaje" => "Usuario no se encuentra regis. en la BD") : array ("usuario" => $res[0], "api_session" => $_SESSION["api_session"]));
//     } catch (PDOException $e) {
//         echo json_encode(array ("error" => $e->getMessage()));
//     }
//     $conn = null;
// });

// $app->get('/logueado', function ($request) {
//     try {
//         $api_session = $request->getParam('api_session');
//         session_id($api_session);
//         // session_id("39u5c5k1hdgp2cphb6nnohk8fcibh2hi");
//         session_start();
//         if ($_SESSION["user"]) {
//             $usuario = $_SESSION["user"];
//             $clave = $_SESSION["pass"];
//         }
//         $conn = createConn();
//         $sql = "SELECT * FROM usuarios WHERE usuario=? and clave=?";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([$usuario, md5($clave)]);
//         $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         echo json_encode($res[0] == "" ? array ("mensaje" => "Usuario no se encuentra logueado") : array ("usuario" => $res[0]));
//     } catch (PDOException $e) {
//         echo json_encode(array ("error" => $e->getMessage()));
//     }
//     $conn = null;
// });

// $app->get('/salir', function ($request) {
//     try {
//         $api_session = $request->getParam('api_session');
//         session_id($api_session);
//         // session_id("39u5c5k1hdgp2cphb6nnohk8fcibh2hi");

//         session_start();
//         if ($_SESSION["user"]) {
//             session_regenerate_id();
//             session_destroy();
//             echo json_encode(array ("log_out" => "Cerrada sesion en la API"));
//         } else {
//             echo json_encode(array ("log_out" => "No existe sesion en la API"));
//         }
//     } catch (PDOException $e) {
//         echo json_encode(array ("error" => $e->getMessage()));
//     }
//     $conn = null;
// });