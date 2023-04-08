<?php
    include("./index.php");

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