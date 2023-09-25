<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';
        require_once 'login_view.inc.php';

        // ERROR HANDLERS

        $errors = [];

        if (is_input_empty($email, $password)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (!is_user_exists($db, $email, $password)) {
            $errors["no_user"] = "No user found.";
        }

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../login.php?login=failed");
            die();
        }

        $result = get_user($db, $email, $password);

        require_once 'config_session.inc.php';


        $_SESSION["user_email"] = $result[0]["email"];
        $_SESSION["user_name"] = $result[0]["name"];

        header("Location: ../index.php?login=success");
    } catch (Exception $e) {
        die("Login Failed: " . $e->getMessage());
    }

} else {
    header("Location: ../login.php");
    die();
}