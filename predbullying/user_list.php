<?php
include("./logic/config.php");
include("./logic/firebaseRDB.php");

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    exit;
}

$db = new firebaseRDB($databaseURL);

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
        <div class="user-list p-5">
            <h2 class="text-center">User List to Manage</h2>
            <div class="button-add  mb-3">
                <button class="btn btn-primary">
                    <a class="fa-solid fa-user-plus fa-lg " style="color: #ffffff;" href="add_user.php"></a>
                </button>
            </div>
            <table class="table table-bordered text-center">
                <tr class="table-head">
                    <th class="text-center">ID User</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Email Adderess</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>
                <?php
                $data = $db->retrieve("user");
                $data = json_decode($data, 1);
                $i = 1;
                if (is_array($data)) {
                    foreach ($data as $id => $user) {
                        echo "
                                <tr>
                                <td class='text-center'> {$id} </td>
                                <td class='text-center'> {$user['firstName']} </td>
                                <td class='text-center'> {$user['lastName']} </td>
                                <td class='text-center'> {$user['email']} </td>
                                <td class='text-center'> <a class='fa-solid fa-pen-to-square' style='color: #111827;' href='edit_user.php?id=$id'></a></td>
                                <td class='text-center'> <a class='fa-solid fa-trash' style='color: #ff0000;' href='./logic/delete_action.php?id=$id'></a></td>
                                </tr>
                                ";
                    }
                }
                ?>
            </table>
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