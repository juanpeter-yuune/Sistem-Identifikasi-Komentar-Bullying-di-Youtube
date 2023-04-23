<?php
include("./logic/config.php");
include("./logic/firebaseRDB.php");

$db = new firebaseRDB($databaseURL);
$id = $_GET['id'];
$retrieve = $db->retrieve("user/$id");
$data = json_decode($retrieve, 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cyberbullying Prediction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="./js/func_actions.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css"
        rel="stylesheet">
    <link href="temp/css/style.css" rel="stylesheet">
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
        <div class="big-card ">
            <div class="about">
                <div class="card offset-2">
                    <div class="content">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Edit User Data</h2>
                            <form class="form-valide offset-1" action="./logic/edit_action.php" method="post">
                                <div class="form-group row pb-2">
                                    <label class="col-lg-3 col-form-label">First Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8 mb-2">
                                        <input type="text" class="form-control rounded p-3" name="firstName"
                                            value="<?php echo $data['firstName'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row pb-2">
                                    <label class="col-lg-3 col-form-label">Last Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-8 mb-2">
                                        <input type="text" class="form-control rounded p-3" name="lastName"
                                            value="<?php echo $data['lastName'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row pb-2">
                                    <label class="col-lg-3 col-form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-8 mb-2">
                                        <input type="email" class="form-control rounded p-3" name="email"
                                            placeholder="Enter User Email" value="<?php echo $data['email'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row pb-2">
                                    <label class="col-lg-3 col-form-label">Password <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-8 mb-2">
                                        <input type="password" class="form-control rounded p-3" name="password"
                                            value="<?php echo $data['password'] ?>">
                                    </div>
                                </div>
                                <div class="button-admin offset-2 p-3">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input class="btn btn-primary text-center offset-3" type="submit"
                                        value="Save"></input>
                                    <!-- <input class="btn btn-warning text-center offset-3" type="submit" name="backTo"
                                        value="Back"></input> -->
                                </div>
                            </form>
                        </div>
                    </div>
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