<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $db = new PDO("mysql:host=localhost; dbname=quiz; charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $amount = $data->amount;
    $categories = $data->categoriesSelected;
    $diff = $data->diff;

    $sql = "SELECT DISTINCT KategorienName FROM frage JOIN kategorie k on k.PK_KategorieId = frage.FK_KategorieID";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $arr = [];

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($arr, implode($row));
        }
    }

    echo json_encode($arr);
?>