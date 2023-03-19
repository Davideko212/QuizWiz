<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $db = new PDO("mysql:host=localhost; dbname=quiz; charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // reads out the parameter(s) passed through the fetch body
    $json = file_get_contents('php://input');
    $data = json_decode($json)->select;

    if ($data == "Fragestellung") {
        $sql = "SELECT JSON_OBJECT('ID', PK_FrageId, 'Fragestellung', Fragestellung) FROM frage";
    } else {
        $sql = "SELECT JSON_OBJECT('ID', PK_AntwortID, 'Antwortmoeglichkeit', Antwortmoeglichkeit) FROM ANTWORT";
    }
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