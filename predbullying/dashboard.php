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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/dashboard.css">
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
                    <a href="dashboard.php">
                        <img src="./assets/dashboard.png" alt="" class="icon">
                        <span class="description">Dashboard</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="user_list.php">
                        <img src="./assets/userlist.png" alt="" class="icon">
                        <span class="description">User List</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="add_user.php">
                        <img src="./assets/add.png" alt="" class="icon">
                        <span class="description">Add New User</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="about_system.php">
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
        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Data Training</div>
                        <div class="number">6000</div>
                    </div>
                    <img src="./assets/dtr.png" alt="#">
                </div>
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Data Testing</div>
                        <div class="number">2000</div>
                    </div>
                    <img src="./assets/dts.png" alt="#">
                </div>
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Total Data</div>
                        <div class="number">8.000</div>
                    </div>
                    <img src="./assets/dtt.png" alt="#">
                </div>
            </div>
        </div>
        <div class="model">
            <div class="model-box">
                <div class="judul">Model Performance</div>
                <table class="table table-bordered text-center">
                    <tr class="table-head">
                        <th class="text-center">Sensitivity</th>
                        <th class="text-center">Specificity</th>
                        <th class="text-center">Accuracy</th>
                        <th class="text-center">Balance Accuracy</th>
                        <th class="text-center">Precision</th>
                        <th class="text-center">F-1 Score</th>
                        <th class="text-center">MCC</th>
                    </tr>
                    <tr>
                        <th class="text-center">90.5%</th>
                        <th class="text-center">77.6%</th>
                        <th class="text-center">84%</th>
                        <th class="text-center">84%</th>
                        <th class="text-center">80.2%</th>
                        <th class="text-center">85%</th>
                        <th class="text-center">68.7%</th>
                    </tr>
                </table>
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