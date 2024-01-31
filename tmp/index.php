<?php
function createConn()
{
    try {
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        ];
        $conn = new PDO("mysql:host=localhost;dbname=test", "jose", "!Adminadmin1", $opt);
        return $conn;
    } catch (PDOException $e) {
        echo "Not possible to realize connection: " . $e->getMessage();
    }
}
$conn = createConn();
try {
    $sql = "select * from test_table";
    $result = $conn->query($sql);
    echo $result;
} catch (PDOException $e) {
    echo "Not possible to realize sql" . $e->getMessage();
}