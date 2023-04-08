<?php
    include("./index.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $answers = $data->answersValue;
    $array = get_object_vars($answers);
    $questions = array_keys($array);

    $sql = "SELECT FK_FrageID, FK_AntwortID FROM antwortzuordnung WHERE Richtig = TRUE AND FK_FrageID IN ('" . implode("', '", $questions) . "')";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    // 0 -> correct
    // 1 -> wrong
    // 2 -> unanswered
    $arr = [0, 0, 0];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $temp = (string)$row["FK_FrageID"];
        $answer = $answers->$temp;

        if ($answer == $row["FK_AntwortID"]) {
            $arr[0]++;
        } else if ($answer == -1) {
            $arr[2]++;
        } else {
            $arr[1]++;
        }
    }

    echo json_encode($arr);
?>