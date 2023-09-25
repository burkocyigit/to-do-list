<?php

declare(strict_types=1);

function check_signup_errors()
{
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<div class="alert alert-danger" role="alert">' .
                $error .
                '</div>';
        }

        unset($_SESSION['errors_signup']);
    }
}