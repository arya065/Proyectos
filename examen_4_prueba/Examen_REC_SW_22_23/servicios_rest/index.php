<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->get('/login', function ($request) {
    try {
        $conn = createConn();
        $sql = "SELECT * FROM usuarios WHERE usuario=? and clave=?";
        $stmt = $conn->prepare($sql);
        $usuario = $request->getParam('usuario');
        $clave = $request->getParam('clave');
        //-----------------------------------
        $usuario = "profesor1";
        $clave = "123456";
        //-------------------------------------
        $stmt->execute([$usuario, md5($clave)]);
        // $stmt->debugDumpParams();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //session params
        session_start();
        $_SESSION["api_session"] = session_id();
        $_SESSION["user"] = $usuario;
        $_SESSION["pass"] = $clave;
        echo json_encode($res[0] == "" ? array("mensaje" => "Usuario no se encuentra regis. en la BD") : array("usuario" => $res[0], "api_session" => $_SESSION["api_session"]));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});

$app->get('/logueado', function ($request) {
    try {
        $api_session = $request->getParam('api_session');
        // session_id($api_session);
        session_id("39u5c5k1hdgp2cphb6nnohk8fcibh2hi");
        session_start();
        if ($_SESSION["user"]) {
            $usuario = $_SESSION["user"];
            $clave = $_SESSION["pass"];
        }
        $conn = createConn();
        $sql = "SELECT * FROM usuarios WHERE usuario=? and clave=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, md5($clave)]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($res[0] == "" ? array("mensaje" => "Usuario no se encuentra logueado") : array("usuario" => $res[0]));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});

$app->get('/salir', function ($request) {
    try {
        $api_session = $request->getParam('api_session');
        // session_id($api_session);
        session_id("39u5c5k1hdgp2cphb6nnohk8fcibh2hi");

        session_start();
        if ($_SESSION["user"]) {
            session_regenerate_id();
            session_destroy();
            echo json_encode(array("log_out" => "Cerrada sesion en la API"));
        } else {
            echo json_encode(array("log_out" => "No existe sesion en la API"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});

$app->get('/usuario/{id_usuario}', function ($request) {
    try {
        $api_session = $request->getParam('api_session');
        // session_id($api_session);
        session_id("39u5c5k1hdgp2cphb6nnohk8fcibh2hi");

        session_start();
        if ($_SESSION["user"]) {
            $id = $request->getAttribute("id_usuario");
        }
        $conn = createConn();
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($res[0] == "" ? array("mensaje" => "Usuario no se encuentra logueado") : array("usuario" => $res[0]));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});


$app->get('/usuariosGuardia/{dia}/{hora}', function ($request) {
    try {
        $api_session = $request->getParam('api_session');
        // session_id($api_session);
        session_id("39u5c5k1hdgp2cphb6nnohk8fcibh2hi");

        session_start();
        if ($_SESSION["user"]) {
            $dia = $request->getAttribute("dia");
            $hora = $request->getAttribute("hora");
        }
        $conn = createConn();
        $sql = "SELECT id_usuario, nombre, usuarios.usuario, clave, email from usuarios join horario_guardias on horario_guardias.usuario = usuarios.id_usuario WHERE dia = ? and hora = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dia, $hora]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($res[0] == "" ? array("mensaje" => "Usuario no se encuentra logueado") : array("usuarios" => $res));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});
$app->get('/usuariosGuardia/{dia}/{hora}/{id_usuario}', function ($request) {
    try {
        $api_session = $request->getParam('api_session');
        // session_id($api_session);
        session_id("39u5c5k1hdgp2cphb6nnohk8fcibh2hi");

        session_start();
        if ($_SESSION["user"]) {
            $dia = $request->getAttribute("dia");
            $hora = $request->getAttribute("hora");
            $id = $request->getAttribute("id_usuario");
        }
        $conn = createConn();
        $sql = "SELECT id_usuario, nombre, usuarios.usuario, clave, email from usuarios join horario_guardias on horario_guardias.usuario = usuarios.id_usuario WHERE dia = ? and hora = ? and id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dia, $hora, $id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $res[0];
        echo json_encode($stmt->rowCount() == 0 ? array("de_guardia" => false) : array("de_guardia" => true));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});
$app->run();
