<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-sm-between">
                <a href="index.php" class="main-page">
                    <h1>My Todo List</h1>
                </a>

                <?php

                if (!isset($_SESSION['user_email'])) { ?>
                    <form action="login.php"><button type="submit" class="btn btn-outline-light me-2">
                            Login
                        </button></form>
                <?php } ?>

                <?php

                if (isset($_SESSION['user_email'])) { ?>
                    <form action="includes/logout.inc.php"><button type="submit" class="btn btn-outline-light me-2 ml-30">
                            Logout
                        </button></form>
                <?php } ?>
                <div class="text-end">

                    <form action="register.php"><button type="submit" class="btn btn-warning">Sign-up</button></form>
                </div>
            </div>
        </div>
    </header>
</body>

</html>