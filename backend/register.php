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
    $date = $data->date;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = "SELECT * FROM Benutzer WHERE Benutzername LIKE :u";
    $stmt = $db->prepare($check);
    $stmt->bindValue(':u', $user, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(-1);
    } else {
        $sql = "INSERT INTO Benutzer (Benutzername, Passwort, Anmeldedatum, QuizCount) VALUES (:u, :p, :d, 0)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':u', $user, PDO::PARAM_STR);
        $stmt->bindValue(':p', $hashed_password, PDO::PARAM_STR);
        $stmt->bindValue(':d', $date, PDO::PARAM_STR);
        $stmt->execute();
        echo json_encode(0);
    }
?>