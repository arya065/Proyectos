<?php
if (isset($_GET["name"]) && $_GET["name"] != "") {
    echo json_encode(array('html' => $_GET["name"]));
} else {
    echo json_encode(array("html" => 'No info recieved'));
}