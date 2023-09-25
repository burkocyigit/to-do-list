<?php

declare(strict_types=1);
function is_input_empty(string $password, string $email)
{
    return empty($email) || empty($password);
}

function is_user_exists(object $db, string $email, string $password)
{

    $query = "SELECT * FROM user WHERE email = :email;";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $numOfEntries = count($rows);

    $password_hashed = $rows[0]["password"];

    return $numOfEntries > 0 && password_verify($password, $password_hashed);
}