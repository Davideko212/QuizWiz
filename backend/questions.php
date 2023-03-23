<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $db = new PDO("mysql:host=localhost; dbname=quiz; charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // reads out the parameter(s) passed through the fetch body
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $amount = $data->amount;
    $categories = $data->categoriesSelected;
    $diff = $data->diff;

    $questions = "SELECT * FROM frage 
        JOIN kategorie k on k.PK_KategorieId = frage.FK_KategorieID
        WHERE (Schwierigkeit BETWEEN 0 AND " . $diff . ") AND (KategorienName) IN ('" . implode("', '", $categories) . "')";
    $answers = "SELECT FK_AntwortID, Antwortmoeglichkeit FROM antwortzuordnung 
        JOIN antwort a on a.PK_AntwortID = antwortzuordnung.FK_AntwortID
        WHERE FK_FrageID = ";
    $stmt = $db->prepare($questions);
    $stmt->execute();

    $arr = [];

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["PK_FrageId"];
            $answersArr = [];

            $stmtAns = $db->prepare($answers . $id);
            $stmtAns->execute();

            while ($rowAns = $stmtAns->fetch(PDO::FETCH_ASSOC)) {
                array_push($answersArr, $rowAns);
            }

            array_push($row, $answersArr);
            array_push($arr, $row);
        }
    }

    echo json_encode($arr);
?>