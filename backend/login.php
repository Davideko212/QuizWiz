<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    $db = new PDO("mysql:host=localhost; dbname=quiz; charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    // reads out the parameter(s) passed through the fetch body
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $user = $data->user;
    $password = $data->password;
    $answer = 0;

    $sql = "SELECT * FROM benutzer WHERE Benutzername LIKE :u";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':u', $user, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (password_verify($password, $row["Passwort"])) {
            $answer = $row["PK_BenutzerID"];
        } else {
            $answer = -1;
        }
    }

    echo json_encode($answer);
?>