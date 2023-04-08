<?php
    include("./index.php");

    // reads out the parameter(s) passed through the fetch body
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $userID = $data->userIDValue;

    $sql = "SELECT Anmeldedatum, Benutzername, QuizCount FROM benutzer WHERE PK_BenutzerID = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $userID, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    echo json_encode($row);
?>