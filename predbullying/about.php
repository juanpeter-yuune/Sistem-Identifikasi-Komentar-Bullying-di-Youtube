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
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/about.css">
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
        <div class="big-card ">
            <div class="about">
                <div class="card ">
                    <div class="content">
                        <div class="imgBox">
                            <img src="./assets/me.jpg" alt="">
                        </div>
                        <div class="contentBox">
                            <h4>Juan Peter Timothy Yuune</h4>
                            <h5>Developer</h5>
                            <p class="text-center">
                                I praise you because I am fearfully and wonderfully made;
                                your works are wonderful,
                                I know that full well. (Psalm 139 : 14)
                            </p>
                        </div>
                        <div class="sci">
                            <a href="https://www.instagram.com/juanpetert._" target="_blank">
                                <i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/in/juan-peter-timothy-yuune/" target=_blank>
                                <i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="mailto:juanpetert77@gmail.com">
                                <i class="fa-regular fa-envelope" target=_blank></i></a>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pt-8 offset-xl-1 col-md-8 p-2 text-center">
                    <div class="head-log">
                        <h2><img src="./assets/logo2.png" class="img-logo p-3" alt="Sample image">
                            Cyberbullying Prediction System
                        </h2>
                    </div>
                    <h4 class="pt-8">
                        Sentiment analysis is used to identify, and extract information from a particular text source
                        and help understand the sentiments that exist in products or services provided to users.
                        The cyberbullying identification system is a system that can help identify comments
                        automatically whether these comments are bullying or non-bullying comments in the content on
                        Youtube social media. From the identification results, the system will provide presentation
                        information on the quality of the content you have. This identification system is designed using
                        machine learning algorithms and natural language processing to determine whether data is
                        bullying or non-bullying data.
                    </h4>
                    <h4 class="version p-5 pt-8">Version 1.0</h4>
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

    <!-- The Modal Login/Logout-->
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