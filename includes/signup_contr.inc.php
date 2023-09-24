<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email)
{
    return empty($username) || empty($pwd) || empty($email);
}

function is_email_valid(string $email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_email_registered(object $db, string $email)
{
    return get_email($db, $email);
}