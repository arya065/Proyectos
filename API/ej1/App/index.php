<?php
    define("DIR_SERV", "http://proyectos/API/Teor_Servicios_Web/primera_api");

    function consumir_servicios_REST($url, $metodo, $datos = null)
    {
        $llamada = curl_init();
        curl_setopt($llamada, CURLOPT_URL, $url);
        curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
        if (isset($datos)) {
            curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
        }

        // Добавим следующую строку для вывода дополнительной информации
        curl_setopt($llamada, CURLOPT_VERBOSE, true);

        $respuesta = curl_exec($llamada);

        // Добавим следующие строки для вывода ошибок, если они есть
        if ($respuesta === false) {
            echo 'cURL error: ' . curl_error($llamada);
        }

        curl_close($llamada);
        return $respuesta;
    }
