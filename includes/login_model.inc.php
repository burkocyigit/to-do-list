<?php

declare(strict_types=1);

function get_user(object $db, string $email, string $password)
{

    $query = "SELECT * FROM user WHERE email = :email;";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    return $result;
}