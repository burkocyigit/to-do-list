<?php

declare(strict_types=1);

function get_email(object $db, string $email)
{
    $query = "SELECT email FROM user WHERE email = :email;";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function create_user(object $db, string $name, string $email, string $password)
{
    $qry = $db->prepare('INSERT INTO user (name, email, password) VALUES (?, ?, ?)');
    $qry->execute(array($name, $email, $password));
}