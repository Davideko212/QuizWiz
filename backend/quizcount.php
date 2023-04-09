<?php
    include("./index.php");

    $userID = $data->userIDValue;

    $sql = "UPDATE benutzer SET QuizCount = QuizCount + 1 WHERE PK_BenutzerID = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $userID, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    echo json_encode($row);
?>