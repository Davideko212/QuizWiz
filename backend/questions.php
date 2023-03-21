<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $db = new PDO("mysql:host=localhost; dbname=quiz; charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // reads out the parameter(s) passed through the fetch body
    $json = file_get_contents('php://input');
    //$data = json_decode($json)->select;

    $sql = "SELECT * FROM frage WHERE (Schwierigkeit BETWEEN 1 AND 10) AND (FK_KategorieID ) IN (1, 2, 3, 4)";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $arr = [];

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($arr, $row);
        }
    }

    echo json_encode($arr);
?>