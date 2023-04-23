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
    <link rel="stylesheet" href="./css/report.css">

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
        <div class="container mt-3 mb-5 col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Content Quality</h5>
                            <p class="card-text">
                                <img src="./image/pie.png" class="rounded">
                            </p>
                            <button type="button" class="btn btn-primary col-xl-6 offset-3"
                                id="btn-preview-pie">Preview</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bullying Keywords</h5>
                            <p class="card-text">
                                <img src="./image/neg_sentiment.png" class="rounded">
                            </p>
                            <button type="button" class="btn btn-primary col-xl-6 offset-3 "
                                id="btn-preview-pos">Preview</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Non-Bullying Keywords</h5>
                            <p class="card-text">
                                <img src="./image/pos_sentiment.png" class="rounded">

                            </p>
                            <button type="button" class="btn btn-primary col-xl-6 offset-3"
                                id="btn-preview-neg">Preview</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-button">
            <a href="tablepred.php"><button type="button" class="btn btn-primary col-xl-6 offset-3"
                    id="btn-preview-pie">View Table Prediction Result</button></a>
        </div>

        <!-- Modal Preview Dialog -->
        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Preview Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="" class="imagepreview" style="display: block; max-width: 100%; height: auto;">

                    </div>
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
    <script src="./js/report.action.js"></script>
</body>

</html>