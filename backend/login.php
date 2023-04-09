<?php
    include("./index.php");

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