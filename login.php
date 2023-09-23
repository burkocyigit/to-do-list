<?php 

    include 'configure.php';

    

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        try {
            $username = $_POST["email"];
            $password = $_POST["password"];


            $qry = $db->query("SELECT * FROM user WHERE (username='$username')");
            $rows = $qry->fetchAll(PDO::FETCH_ASSOC);

            $numOfEntries = count($rows);
            $password_hashed = $rows[0]["password"];

            if ($numOfEntries > 0 && password_verify($password, $password_hashed)) {
                echo "<script>alert('Success'); window.location.href='index.php'</script>";
            } else {
                echo "<script>alert('Failed'); window.location.href='login.php'</script>";

            }
        } catch (Exception $e) {
            echo "Error:", $e->getMessage(), "\n";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0b9f70fb92.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,500&display=swap" rel="stylesheet" />
    <title>To-Do List</title>
</head>

<body>
    <?php  
    include "header.php";
    ?>

    <div class="container pt-5">
        <form action="#" method="post">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>