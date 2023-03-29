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
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO benutzer (Benutzername, Passwort) VALUES (:u, :p)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':u', $user, PDO::PARAM_STR);
    $stmt->bindValue(':p', $hashed_password, PDO::PARAM_STR);
    $stmt->execute();
?>