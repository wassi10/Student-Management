<?php
include 'db.php';


$Name = "";
$Email = "";
$id = "";
$section = "";
$batch = "";
$department = "";
$birthdate = "";
$password = "";

$errorMassage = "";
$successMassage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //GET Method: Show the data of the client

    if (!isset($_GET["id"])) {
        header("location: admin_dashboard.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM `register_form` WHERE id=$id";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: admin_dashboard.php");
        exit;
    }

    $Name = $row["name"]; //database row name
    $Email = $row["email"];
    $id = $row["id"]; 
    $section = $row["section"]; 
    $batch = $row["batch"]; 
    $department = $row["dept"]; 
    $birthdate = $row["birthdate"]; 
    $password = $row["password"]; 
} else {
    //POST Method: Update the data of the client

    $Name = $_POST["name"];
    $Email = $_POST["email"];
    $id = $_POST["id"];
    $section = $_POST["section"];
    $batch = $_POST["batch"];
    $department = $_POST["dept_type"];
    $birthdate = $_POST["birthdate"];
    $password = $_POST["password"];

 
    do {
        if (empty($Name) || empty($Email) || empty($id) || empty($section) || empty($batch)  || empty($birthdate) || empty($password)) {
            
            $errorMassage = "All the fields are required";
            break;
        }

        //Insert new client to database

        $sql = "UPDATE `register_form`" . "SET `name`= $Name',`email`='$Email',`id`='$id',`section`='$section',`batch`='$batch',`dept`='$department', `birthdate`='$birthdate',`password`='$password'" . "WHERE id = $id";
        

        $result = $conn->query($sql);

        if (!$result) {
            $errorMassage  = "Invalid Query: " . $conn->error;
            break;
        }

        $successMassage = "Updated correctly";

        // TO ALLOW USER TO REDIRECT TO I
        header("location: admin_dashboard.php");
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

                    <a href="admin_dashboard.php" class="sidebar__link active-link">
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
                        <i class="ri-user-add-line"></i>
                        <span class="sidebar__link-name">Add Student</span>
                        <span class="sidebar__link-floating">Add Student</span>
                    </a>

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
                    <h3 class="sidebar__name">Admin: Khadiza</h3>
                </div>

                <i class="ri-arrow-right-s-line"></i>
            </div>


        </nav>
    </div>

    <!--=============== Main Container ===============-->
    <main class="main container" id="main">


        <div class="mb-5">
            <h3>Update Student Information</h3>
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
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="floatingName" class="form-control rounded-0 bg-light" value="<?php echo $Name; ?>">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" id="floatingInput" class="form-control rounded-0 bg-light" value="<?php echo $Email; ?>">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="floatingName" class="form-control rounded-0 bg-light" value="<?php echo $id; ?>">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Section</label>
                <div class="col-sm-6">
                    <input type="text" name="section" id="floatingName" class="form-control rounded-0 bg-light" value="<?php echo $section; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Batch</label>
                <div class="col-sm-6">
                    <input type="text" name="batch" id="floatingName" class="form-control rounded-0 bg-light" value="<?php echo $batch; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-6">
                    <select name="dept_type" class="form-control rounded-0 bg-light" value="<?php echo $department; ?>">
                        <option value="">Select Department</option>
                        <option value="cse">CSE</option>
                        <option value="eee">EEE</option>
                        <option value="bba">BBA</option>
                        <option value="law">Law</option>
                        <option value="english">English</option>
                        <option value="architecture">Architecture</option>
                        <option value="Bangla">Bangla</option>
                        <option value="civil">Civil Engineering</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Birth Date</label>
                <div class="col-sm-6">
                    <input type="date" name="birthdate" id="floatingInput" class="form-control rounded-0 bg-light" value="<?php echo $birthdate; ?>">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" name="password" id="floatingPassword" class="form-control rounded-0 bg-light" value="<?php echo $password; ?>">
                </div>
            </div>



            <!-- Button -->
            <div class="row mb-3">

                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="admin_dashboard.php" role="button">Cancel</a>
                </div>
            </div>

        </form>

    </main>

    <!-- js connect -->
    <script src="js/main.js"></script>

</body>

</html>