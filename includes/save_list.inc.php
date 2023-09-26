<?php
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['dataArray'])) {
        $jsonData = $_POST['dataArray'];

        $dataArray = json_decode($jsonData, true);

        if ($dataArray !== null) {
            require_once 'dbh.inc.php';

            foreach ($dataArray as $task) {
                $qry = $db->prepare('INSERT INTO todolist (name, status, user_id) VALUES (?, ?, ?)');
                $qry->execute(array($task['taskName'], $task['taskNo'], $_SESSION["user_id"]));
            }
            print_r($dataArray);
        } else {
            echo "Error decoding JSON data.";
        }
    }
} else {
    echo "This is not a POST request.";
}
?>