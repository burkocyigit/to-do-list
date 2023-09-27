<?php
include 'dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];

    $email = $_POST["email"];

    $password = $_POST["password"];
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';


        // ERROR HANDLERS

        $errors = [];

        if (is_input_empty($email, $password, $name)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (!is_email_valid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }
        if (is_email_registered($db, $email)) {
            $errors["registered_email"] = "Email is already registered!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../register.php");
            die();
        }

        create_user($db, $name, $email, $password_hashed);

        require_once 'config_session.inc.php';

        $_SESSION["user_email"] = $email;
        $_SESSION["user_name"] = $name;
        $_SESSION["user_id"] = 2;

        header("Location: ../login.php");

        $db = null;

        die();

    } catch (PDOException $e) {
        die("Signup failed: " . $e->getMessage());
    }


} else {
    header("Location: ../register.php");
    die();
}