<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $section = $_POST['section'];
    $batch = $_POST['batch'];
    $department = $_POST['dept_type'];
    $birthdate = $_POST['birthdate'];
    $password = $_POST['password'];
   

    // Validation using regex
    $name_regex = "/^[a-zA-Z ]+$/";
    $email_regex = "/^\S+@\S+\.\S+$/";
    $password_regex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/";

    if (!preg_match($name_regex, $name)) {
        echo "<script>alert('Invalid name. Only alphabets and spaces are allowed.')</script>";
    } elseif (!preg_match($email_regex, $email)) {
        echo "<script>alert('Invalid email address.')</script>";
    
    } elseif (!preg_match($password_regex, $password)) {
        echo "<script>alert('Invalid password. It should contain at least 5 characters, including at least one letter and one digit.')</script>";
    } else {

        // Connect to the db
        include 'db.php';


        $select_sql = "SELECT * FROM `register_form` WHERE email = '$email'";

        $result = mysqli_query($conn, $select_sql);


        if (mysqli_num_rows($result) > 0) {

            echo "<script>alert('User Already Exist!')</script>";
        } else {
            // registration info insert query
            $insert_query = "INSERT INTO `register_form`(`name`, `email`, `id`, `section`, `batch`, `dept`, `birthdate`, `password`) VALUES ('$name','$email','$id','$section','$batch','$department','$birthdate','$password')";

            // new table creation query for new student
            $create_table_query = "CREATE TABLE `$id` (
                courseCode VARCHAR (200) NOT NULL,
                courseTitle VARCHAR (200) NOT NULL,
                credit INT (200) NOT NULL,
                section VARCHAR (50) NOT NULL,
                batch VARCHAR (50) NOT NULL
            )";

            mysqli_query($conn, $insert_query);
            mysqli_query($conn, $create_table_query);
            header('location:admin_dashboard.php');
        }
    }



    mysqli_close($conn);
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
            <h3>Add Information</h3>
        </div>



        <form method="post">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="floatingName" class="form-control rounded-0 bg-light" placeholder="Your Name" required>
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" id="floatingInput" class="form-control rounded-0 bg-light" placeholder="dept_id@lus.ac.bd" required>
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="floatingName" class="form-control rounded-0 bg-light" placeholder="Your ID" required>
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Section</label>
                <div class="col-sm-6">
                    <input type="text" name="section" id="floatingName" class="form-control rounded-0 bg-light" placeholder="Your Section" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Batch</label>
                <div class="col-sm-6">
                    <input type="text" name="batch" id="floatingName" class="form-control rounded-0 bg-light" placeholder="Your Batch" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-6">
                    <select name="dept_type" class="form-control rounded-0 bg-light" required>
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
                    <input type="date" name="birthdate" id="floatingInput" class="form-control rounded-0 bg-light" placeholder="" required>
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" name="password" id="floatingPassword" class="form-control rounded-0 bg-light" placeholder="Password" required>
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

<!-- CREATE TABLE info_form (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (200) NOT NULL,
    student_id INT (200) NOT NULL UNIQUE,
    department VARCHAR (200) NOT NULL,
    batch VARCHAR (50) NOT NULL,
    sec VARCHAR (50) NOT NULL,
    credit INT (200) NOT NULL,
    fee INT (200) NOT NULL
); -->

<!-- CREATE TABLE info_form (
    courseCode VARCHAR (200) NOT NULL,
    courseTitle VARCHAR (200) NOT NULL,
    credit INT (200) NOT NULL,
    section VARCHAR (50) NOT NULL,
    batch VARCHAR (50) NOT NULL
); -->