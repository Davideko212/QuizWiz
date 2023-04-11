<?php
    include("./index.php");

    $userID = $data->userIDValue;
    $accuracy = $data->accuracy;
    $accuracy = $accuracy * 100;

    $sql = "UPDATE benutzer SET QuizCount = QuizCount + 1, AccuracySum = AccuracySum + :acc WHERE PK_BenutzerID = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $userID, PDO::PARAM_STR);
    $stmt->bindValue(':acc', $accuracy, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    echo json_encode($row);
?>