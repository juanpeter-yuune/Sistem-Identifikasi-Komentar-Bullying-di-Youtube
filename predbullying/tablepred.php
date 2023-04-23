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
            <div class="container mt-3 mb-5 col-sm-12">
                <div class="row mt-4">
                    <div class="d-flex mb-2 ms-auto">
                        <input type="text" id="txt-input-search" class="form-control me-sm-2"
                            placeholder="Input Keywords">
                        <button type="button" id="btn-search-table" class="btn btn-primary">Search</button>
                    </div>
                    <div class="table-responsive-sm">
                        <?php

                        $file_to_read = fopen('./data/output_final_data.csv', 'r');

                        if ($file_to_read !== FALSE) {
                            $flag = true;
                            $row_number = 1;
                            $columns = array(2, 11, 12, 13);
                            echo "<table class='table table-bordered table-hover table-striped'>\n";
                            echo "<thead class='table-head'>";
                            echo "  <tr>";
                            echo "	<th class='text-center'>Comments</th>";
                            echo "	<th class='text-center'>Predicted</th>";
                            echo "	<th class='text-center'>Non-Bullying</th>";
                            echo "	<th class='text-center'>Bullying</th>";
                            echo "  </tr>";
                            echo "</thead>";
                            echo "<tbody id='myTable'>";
                            while (($data = fgetcsv($file_to_read, 1000, ',')) !== FALSE) {
                                if ($flag) {
                                    $flag = false;
                                    continue;
                                }
                                echo "<tr>";
                                //echo "<td class='text-center align-middle'>".$row_number."</td>";
                                for ($i = 0; $i < count($data); $i++) {
                                    if (in_array($i + 1, $columns)) {
                                        if ($i + 1 == 3) {
                                            echo "<td class='align-middle'><b><sup>[" . $row_number . "]</sup></b> " . $data[$i] . "</td>";

                                        } else {
                                            echo "<td class='text-center align-middle'>" . $data[$i] . "</td>";
                                        }
                                    }
                                }
                                echo "</tr>\n";
                                $row_number++;
                            }
                            echo "</tbody>";
                            echo "</table>\n";

                            fclose($file_to_read);
                        }
                        ?>
                    </div>
                </div>
            </div>

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