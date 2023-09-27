<?php

function output_user()
{
    if (isset($_SESSION["user_email"])) {
        echo '<div class="container alert alert-info text-center" role="alert" id="success-alert">' .
            'Welcome ' . $_SESSION['user_name'] .
            '!</div>';
    } else {
        echo '<div class="container alert alert-warning text-center" role="alert" id="success-alert">' .
            'You are not logged in.' .
            '</div>';
    }

}

function check_login_errors()
{
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION['errors_login'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" role="alert">' .
                $error .
                '</div>';
        }

        unset($_SESSION['errors_login']);
    } else if (isset($_GET["login"]) && $_GET["login"] === "failed") {
        echo '<div class="container alert alert-warning text-center" role="alert" id="success-alert">' .
            'No users found. Try again.' .
            '</div>';
    }
}