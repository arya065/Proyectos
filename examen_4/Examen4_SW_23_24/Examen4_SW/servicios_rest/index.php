<?php

require "./src/funciones_servicios.php";
// require "../conf.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;



// $app->get('/conexion_PDO', function ($request) {

//     echo json_encode(conexion_pdo());
// });

// $app->get('/conexion_MYSQLI', function ($request) {

//     echo json_encode(conexion_mysqli());
// });
$app->get('/login', function ($request) {
    try {
        $conn = createConn();
        $sql = "SELECT * FROM usuarios WHERE usuario=? and clave=?";
        $stmt = $conn->prepare($sql);
        $usuario = $request->getParam('usuario');
        $clave = $request->getParam('clave');
        $stmt->execute([$usuario, $clave]);
        // $stmt->debugDumpParams();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["api_session"] = "test" . md5("test");
        echo json_encode($res[0] == "" ? array("mensaje" => "Usuario no se encuentra regis. en la BD") : array("usuario" => $res[0], "api_session" => $_SESSION["api_session"]));
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});

$app->get('/logeado', function ($request) {
    try {
        $conn = createConn();
        $sql = "SELECT * FROM usuarios WHERE usuario=? and clave=?";
        $stmt = $conn->prepare($sql);
        $usuario = $request->getParam('usuario');
        $clave = md5($request->getParam('clave'));
        $session = $request->getParam('api_session');
        if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $session) {
            $stmt->execute([$usuario, $clave]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($res[0] == "" ? array("mensaje" => "Usuario no se encuentra regis. en la BD") : array("usuario" => $res[0]));
        }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});

$app->get('/salir', function ($request) {
    try {
        $session = $request->getParam('api_session');
        if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $session) {
            echo json_encode(array("log_out" => "Cerrada sesión en la API"));
        } else {
            echo json_encode(array("log_out" => "No hay session este"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
});

$app->get('/alumnos', function ($request) {
    try {
        $conn = createConn();
        $sql = "SELECT * FROM usuarios WHERE tipo=?";
        $stmt = $conn->prepare($sql);
        $session = $request->getParam('api_session');
        if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $session) {
            $stmt->execute(["alumno"]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(array("alumnos" => $res[0]));
        }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});

$app->get('/notasAlumno/{cod_alu}', function ($request) {
    try {
        $conn = createConn();
        $sql = "SELECT notas.cod_asig,denominacion,nota FROM usuarios
        JOIN notas on usuarios.cod_usu=notas.cod_usu
        JOIN asignaturas on notas.cod_asig=asignaturas.cod_asig
        WHERE usuarios.cod_usu=?";
        $stmt = $conn->prepare($sql);
        $codAlu = $request->getAttribute("cod_alu");
        $session = $request->getParam('api_session');
        // if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $session) {
        $stmt->execute([$codAlu]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("notas" => $res));
        // }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});

$app->get('/NotasNoEvalAlumno/{cod_alu}', function ($request) {
    try {
        $conn = createConn();
        $sql = "SELECT notas.cod_asig,denominacion,nota FROM usuarios
        JOIN notas on usuarios.cod_usu=notas.cod_usu
        JOIN asignaturas on notas.cod_asig=asignaturas.cod_asig
        WHERE usuarios.cod_usu=?";
        $stmt = $conn->prepare($sql);
        $codAlu = $request->getAttribute("cod_alu");
        $session = $request->getParam('api_session');
        // if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $session) {
        $stmt->execute([$codAlu]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("notas" => $res));
        // }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});
$app->get('/quitarNota/{cod_alu}', function ($request) {
    try {
        $conn = createConn();
        $sql = "DELETE FROM notas WHERE cod_usu=? and cod_asig=?";
        $stmt = $conn->prepare($sql);
        $codAlu = $request->getAttribute("cod_alu");
        $session = $request->getParam('api_session');
        $codAsig = $request->getParam('cod_asig');
        // if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $session) {
        $stmt->execute([$codAlu, $codAsig]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("mensaje" => "Asignatura descalificada con éxito"));
        // }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});
$app->get('/ponerNota/{cod_alu}', function ($request) {
    try {
        $conn = createConn();
        $sql = "INSERT INTO notas (cod_asig,cod_usu,nota) VALUES (?,?,0)";
        $stmt = $conn->prepare($sql);
        $codAlu = $request->getAttribute("cod_alu");
        $session = $request->getParam('api_session');
        $codAsig = $request->getParam('cod_asig');
        // if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $session) {
        $stmt->execute([$codAsig, $codAlu]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("mensaje" => "Asignatura calificada con éxito"));
        // }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});
$app->get('/cambiarNota/{cod_alu}', function ($request) {
    try {
        $conn = createConn();
        $sql = "UPDATE notas SET nota=? WHERE cod_asig=? and cod_usu=?";
        $stmt = $conn->prepare($sql);
        $codAlu = $request->getAttribute("cod_alu");
        $session = $request->getParam('api_session');
        $codAsig = $request->getParam('cod_asig');
        $nota = $request->getParam('nota');
        // if (isset($_SESSION["api_session"]) && $_SESSION["api_session"] == $session) {
        $stmt->execute([$nota, $codAsig, $codAlu]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("mensaje" => "Asignatura calificada con éxito"));
        // }
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
    $conn = null;
});
$app->run();
