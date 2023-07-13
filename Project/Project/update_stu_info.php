<?php
include 'db.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}


### update Student Information

$Name = "";
$Stu_id = "";
$Dept = "";
$Batch = "";
$Sec = "";
$Credit = "";
$Fee = "";


$errorMassage = "";
$successMassage = "";

if( $_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET Method: Show the data of student

    if(!isset($_GET["id"])){
        header("location: /Project/view_stu_info.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM `info_form` WHERE id=$id";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /Project/view_stu_info.php");
        exit;
    }

    $Name = $row["name"]; //database row name
    $Stu_id = $row["student_id"];
    $Dept = $row["department"];
    $Batch = $row["batch"];
    $Sec = $row["sec"];
    $Credit = $row["credit"];
    $Fee = $row["fee"];


}else{
    //POST Method: Update the data of the client

    $id = $_POST["id"];
    $Name = $_POST["name"];
    $Stu_id = $_POST["student_id"];
    $Dept = $_POST["department"];
    $Batch = $_POST["batch"];
    $Sec = $_POST["section"];
    $Credit = $_POST["credit"];
    $Fee = $_POST["fee"];

    do{
        if( empty($id) || empty($Name) || empty($Stu_id) || empty($Dept) || empty($Batch) || empty($Sec) || empty($Credit) || empty($Fee)){

            $errorMassage = "All the fields are required";
            break;
        }

        //Update

        $sql = "UPDATE `info_form`" . "SET `name`='$Name',`student_id`='$Stu_id',`department`='$Dept',`batch`='$Batch',`sec`='$Sec',`credit`='$Credit',`fee`='$Fee'" . " WHERE id = $id";


        $result = $conn->query($sql);

        if(!$result){
            $errorMassage  = "Invalid Query: ". $conn->error;
            break;
        }
       
        $successMassage = "Student updated correctly";

        // TO ALLOW USER TO REDIRECT TO view_stu_info.php FILE
        header("location: /Project/view_stu_info.php");
        exit;

    }while(false);
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

    <title>Add Information</title>
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

                    <a href="add_stu_info.php" class="sidebar__link">
                        <i class="ri-add-line"></i>
                        <span class="sidebar__link-name">Add Info</span>
                        <span class="sidebar__link-floating">Add Info</span>
                    </a>

                    <a href="view_stu_info.php" class="sidebar__link">
                        <i class="ri-information-line"></i>
                        <span class="sidebar__link-name">View Info</span>
                        <span class="sidebar__link-floating">All Info</span>
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
            <h3>Update Information</h3>
        </div>

       
        
        <?php
            if(!empty($errorMassage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMassage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }

        ?>

        <form method="post">
            
            <input type="hidden" name = "id" value="<?php echo $id; ?>">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Full Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $Name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Student ID</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="student_id" value="<?php echo $Stu_id; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="department" value="<?php echo $Dept; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Batch</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="batch" value="<?php echo $Batch; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Section</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="section" value="<?php echo $Sec; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Total Credit</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="credit" value="<?php echo $Credit; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Total Fee</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="fee" value="<?php echo $Fee; ?>">
                </div>
            </div>

            <!-- Add php -->
            <?php

                    if(!empty($successMassage)){
                         echo "
                        <div class='row mb-3>
                            <div class='offset-sm-3 col-sm-6'>
                                <div class='alert alert-success alert-dismissible fade show'        role='alert'>
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
                    <button type="submit" class="btn btn-primary">Update</button>
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