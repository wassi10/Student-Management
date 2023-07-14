<?php
include 'db.php';

session_start();



if (!isset($_SESSION['user_name'])) {  
    header('location:login.php');
}
if (!isset($_SESSION['id'])) {  
    header('location:login.php');
}


### Insert Course Information
$courseCode = "";
$courseTitle = "";
$credit = "";
$batch = "";
$section = "";


$errorMassage = "";
$successMassage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $courseCode = $_POST["courseCode"];
    $courseTitle = $_POST["courseTitle"];
    $credit = $_POST["credit"];
    $batch = $_POST["batch"];
    $section = $_POST["section"];

    do {
        if (empty($courseCode) || empty($courseTitle) || empty($credit) || empty($batch) || empty($section)) {

            $errorMassage = "All the fields are required";
            break;
        }

        //Insert new client to database
        $id = $_SESSION['id'];
        
        $sql = "INSERT INTO `$id`(`courseCode`, `courseTitle`, `credit`, `section`, `batch`) VALUES ('$courseCode','$courseTitle','$credit','$section', '$batch')";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMassage  = "Invalid Query: " . $conn->error;
            break;
        }

        $courseCode = "";
        $courseTitle = "";
        $credit = "";
        $batch = "";
        $section = "";

        $successMassage = "Student added correctly";

        // TO ALLOW USER TO REDIRECT TO view_student_info.PHP FILE
        header("location: view_stu_info.php");
        exit;
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== Bootstrap ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!--=============== ICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="style/sidebar.css">

    <title>Add Courses</title>
</head>

<body>
    <!-- Sidebar bg -->

    <img src="image/background.jpg" alt="sidebar img" class="bg-image">

    <!-- Menu Button -->
    <header class="header header__container container">
        <div class="header__toggle" id="header-toggle">
            <i class="ri-menu-line"></i>
        </div>
    </header>

    <!--=============== SIDEBAR ===============-->
    <div class="sidebar" id="sidebar">
        <nav class="sidebar__container">


            <div class="sidebar__content">

                <!-- =====Home==== -->
                <div class="sidebar__list">

                    <a href="student_dashboard.php" class="sidebar__link active-link">
                        <i class="ri-home-5-line"></i>
                        <span class="sidebar__link-name">Home</span>
                        <span class="sidebar__link-floating">Home</span>
                    </a>

                </div>


                <h3 class="sidebar__title">
                    <span>Student</span>
                </h3>


                <div class="sidebar__list">

                    <a href="add_courses.php" class="sidebar__link">
                        <i class="ri-add-line"></i>
                        <span class="sidebar__link-name">Add Courses</span>
                        <span class="sidebar__link-floating">Add Courses</span>
                    </a>

                    <a href="view_stu_info.php" class="sidebar__link">
                        <i class="ri-information-line"></i>
                        <span class="sidebar__link-name">View Admit</span>
                        <span class="sidebar__link-floating">View Admit</span>
                    </a>
                </div>


                <h3 class="sidebar__title">
                    <span>General</span>
                </h3>

                <div class="sidebar__list">
                    <!-- Logout Button -->
                    <a href="logout.php" class="sidebar__link">
                        <i class="ri-logout-box-r-line"></i>
                        <span class="sidebar__link-name">Logout</span>
                        <span class="sidebar__link-floating">Logout</span>
                    </a>

                </div>

            </div>

            <!-- =======Accounts and  -->
            <div class="sidebar__account">
                <img src="image/profile.png" alt="sidebar image" class="img-profile">

                <div class="sidebar__names">
                    <h3 class="sidebar__name"><span><?php echo $_SESSION['user_name'] ?></span></h3>
                </div>

                <i class="ri-arrow-right-s-line"></i>
            </div>


        </nav>
    </div>

    <!--=============== Main Container ===============-->
    <main class="main container" id="main">


        <div class="mb-5">
            <h3>Add Courses</h3>
        </div>



        <?php
        if (!empty($errorMassage)) {
            echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMassage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
        }
        ?>

        <form method="post">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="courseCode" value="<?php echo $courseCode; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="courseTitle" value="<?php echo $courseTitle; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Credit</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="credit" value="<?php echo $credit; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Section</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="section" value="<?php echo $section; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Batch</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="batch" value="<?php echo $batch; ?>">
                </div>
            </div>

            <!-- Add php -->
            <?php

            if (!empty($successMassage)) {
                echo "
                <div class='row mb-3>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMassage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <!-- Button -->
            <div class="row mb-3">

                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="view_stu_info.php" role="button">Cancel</a>
                </div>

            </div>
        </form>

    </main>

    <!-- js connect -->
    <script src="js/main.js"></script>

</body>

</html>