<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['dataArray'])) {
        $jsonData = $_POST['dataArray'];

        $dataArray = json_decode($jsonData, true);

        if ($dataArray !== null) {


            $stmnt = $db->prepare('DELETE FROM todolist WHERE user_id=(?)')->execute(array($_SESSION["user_id"]));

            foreach ($dataArray as $task) {
                $qry = $db->prepare('INSERT INTO todolist (name, status, user_id) VALUES (?, ?, ?)');
                $qry->execute(array($task['taskName'], $task['taskStatus'], $_SESSION["user_id"]));
            }
        } else {
            echo "Error. Json.";
        }
    } else if (isset($_POST['retrieveData']) && isset($_SESSION["user_id"])) {
        $retrieveData = $_POST['retrieveData'];
        if ($retrieveData) {
            $qry = $db->prepare('SELECT * FROM todolist WHERE user_id=(?)');
            $qry->execute(array($_SESSION["user_id"]));
            $result = $qry->fetchAll(PDO::FETCH_ASSOC);

            require_once 'login_view.inc.php';

            echo "let table, newRow, taskNoCell, taskCell, statusCell, editCell, deleteCell;";

            foreach ($result as $row) {
                $taskName = $row["name"];
                $taskStatus = $row["status"];
                output_data($taskName, $taskStatus);
            }



        }
    }
    die();
} else {
    header("Location: ../index.php");
}
function output_data($taskName, $taskStatus)
{

    $status = ["In Progress", "Finished", "Cancelled", "Postponed"];
    $taskStatusName = $status[$taskStatus];

    $str = "
    
    table = document.getElementById(\"todoTable\");
    newRow = table.insertRow(table.rows.length);
    taskNoCell = newRow.insertCell(0);
    taskCell = newRow.insertCell(1);
    statusCell = newRow.insertCell(2);
    editCell = newRow.insertCell(3);
    deleteCell = newRow.insertCell(4);

    taskNoCell.innerHTML = table.rows.length - 1;
    taskCell.innerHTML = `<input type='text' id='tableTask' name='taskName' value='{$taskName}' readonly /> `;
    statusCell.innerHTML = `<span id=\"status\" onclick=\"changeStatus(this)\">{$taskStatusName}</span>`;
    editCell.innerHTML =
    \"<span id=\'edit-btn\' onclick='editTask(this)'>🖋️</span>\";
    deleteCell.innerHTML =
    \"<span id='delete-btn' onclick='deleteTask(this)'>❌</span>\";
    
    ";

    echo $str;
}

?>