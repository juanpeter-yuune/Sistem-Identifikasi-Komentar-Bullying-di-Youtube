<?php
include("./logic/config.php");
include("./logic/firebaseRDB.php");

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cyberbullying Prediction</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body class="body">
    <div class="sidebar">
        <div class="header">
            <div class="list-item">
                <a href="#">
                    <img src="./assets/logo.png" alt="" class="icon">
                    <span class="description-header">Predbullying</span>
                </a>
            </div>
            <div class="illustration">
                <img src="./assets/ilustrasi.png" alt="">
            </div>
            <div class="main">
                <div class="list-item">
                    <a href="home.php">
                        <img src="./assets/home.png" alt="" class="icon">
                        <span class="description">Home</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="report.php">
                        <img src="./assets/analytic.png" alt="" class="icon">
                        <span class="description">Analytics Results</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="tablepred.php">
                        <img src="./assets/table.png" alt="" class="icon">
                        <span class="description">Table Prediction</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="about.php">
                        <img src="./assets/about.png" alt="" class="icon">
                        <span class="description">About</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <div id="menu-button">
            <input type="checkbox" id="menu-checkbox">
            <label for="menu-checkbox" id="menu-label">
                <div id="humberger"></div>
            </label>
        </div>
        <div class="headbar">
            <div class="menu-profile">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="./assets/user.png" alt="" class="icon">
                    <?php echo "{$_SESSION['user']['firstName']} {$_SESSION['user']['lastName']}"; ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./logic/logout_action.php"><img src="./assets/logout.png"
                                alt="">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="input">
            <div class="row px-2 py-8 col-md-4 col-lg-6 col-xl-8 offset-2 p-4">
                <h2 class="text-center py-5">Parameter Input System</h2>
                <div class="col"> <br>
                    <label>Download Comments From Youtube</label>
                </div>
                <label for="basic-url"> Input Link Youtube:</label>
                <div class="mb-4">
                    <input type="text" class="form-control rounded" id="basic-url" aria-describedby="basic-addon3">
                </div>
                <div class="mb-4">
                    <label>Number of Comments to Scrap (Min - 50):</label>
                    <input type="number" class="form-control rounded" id="max-sample-size" min="50" max="200">
                </div>
                <div class="text-center">
                    <button id="btn-predict" class="btn btn-primary mb-1 float-end" data-backdrop="static"
                        data-keyboard="false">Start Identification</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Message Dialog -->
    <div class="modal fade" id="message-dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 id="title-modal" class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="body-modal"></div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Progress Bar -->
    <!-- Modal -->
    <div class="modal fade" id="static-progress-bar-dialog" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Progressing...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="progress" style="height:30px">
                        <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated"
                            style="width:100%;height:30px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancel-predict" class="btn btn-primary" data-bs-dismiss="modal">Cancel
                        Prediction</button>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal Login-->
    <div class="modal" id="modal-contact-us">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Log Out</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body text-center">
                    Are you sure you want to log out?
                    </br></br>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <a href="./logic/logout.php"><button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">Log out</button></a>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->

    <script src="temp/js/custom.min.js"></script>
    <script src="./js/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/func_actions.js"></script>
</body>

</html>