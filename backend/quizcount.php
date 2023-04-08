<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $db = new PDO("mysql:host=localhost; dbname=quiz; charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // reads out the parameter(s) passed through the fetch body
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $userID = $data->userIDValue;

    $sql = "UPDATE benutzer SET QuizCount = QuizCount + 1 WHERE PK_BenutzerID = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $userID, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    echo json_encode($row);
?>