<?php
try {
    $db = new PDO('sqlite:C:\xampp\htdocs\todolist\db\user_database.db');
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}