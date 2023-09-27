<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="index.php" class="main-page">
                        <h1>My Todo List</h1>
                    </a>
                </div>
                <div class="d-flex col-md-auto align-items-center">
                    <?php

                    if (!isset($_SESSION['user_email'])) { ?>

                        <form action="login.php"><button type="submit" class="btn btn-outline-light me-2">
                                Login
                            </button></form>

                    <?php } ?>

                    <?php

                    if (isset($_SESSION['user_email'])) { ?>
                        <form action="includes/logout.inc.php"><button type="submit"
                                class="btn btn-outline-light me-2 ml-30">
                                Logout
                            </button></form>
                    <?php } ?>
                </div>
                <div class="d-flex col col-lg-2 align-items-center">
                    <form action="register.php"><button type="submit" class="btn btn-warning">Sign-up</button></form>
                </div>
            </div>
        </div>
    </header>
</body>

</html>