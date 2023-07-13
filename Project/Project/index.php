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
    $confirm_password = $_POST['confirm_password'];




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
    } elseif ($password != $confirm_password) {
        echo "<script>alert('Passwords do not match.')</script>";
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
            header('location:login.php');
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
    <title>Student Register</title>
    <link rel="stylesheet" href="style/login.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
    <!-- Font Awesome Icon -->
    <script src="https://kit.fontawesome.com/3f65800a99.js" crossorigin="anonymous"></script>


</head>

<body>
    <section class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="box shadow bg-light p-4 form-container">
                    <h3 class="mb-4 text-center fs-1">Register Form</h3>

                    <form class="mb-3" action="" method="post">

                        <div class="class-floating mb-3">
                            <input type="text" name="name" id="floatingName" class="form-control rounded-0 bg-light" placeholder="Your Name" required>
                        </div>

                        <div class="class-floating mb-3">
                            <input type="email" name="email" id="floatingInput" class="form-control rounded-0 bg-light" placeholder="dept_id@lus.ac.bd" required>
                        </div>

                        <div class="class-floating mb-3">
                            <input type="text" name="id" id="floatingName" class="form-control rounded-0 bg-light" placeholder="Your ID" required>
                        </div>

                        <div class="class-floating mb-3">
                            <input type="text" name="section" id="floatingName" class="form-control rounded-0 bg-light" placeholder="Your Section" required>
                        </div>

                        <div class="class-floating mb-3">
                            <input type="text" name="batch" id="floatingName" class="form-control rounded-0 bg-light" placeholder="Your Batch" required>
                        </div>

                        <div class="class-floating mb-3">
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

                        <div class="class-floating mb-3">
                            <input type="date" name="birthdate" id="floatingInput" class="form-control rounded-0 bg-light" placeholder="name@example.com" required>
                        </div>


                        <div class="class-floating mb-3">
                            <input type="password" name="password" id="floatingPassword" class="form-control rounded-0 bg-light" placeholder="Password" required>
                        </div>

                        <div class="class-floating mb-3">
                            <input type="password" name="confirm_password" id="floatingConPassword" class="form-control rounded-0 bg-light" placeholder="Confirm Password" required>
                        </div>

                        <!-- No need to select user type -->
                        <!-- <div class="class-floating mb-3">
                            <select name="user_type" class="form-control rounded-0 bg-light" required>
                                <option value="">User Type</option>
                                <option value="student">Student</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div> -->

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" name="submit" class="btn btn-dark border-0 rounded-0">Register</button>
                        </div>



                        <div>
                            <p>Already have an account? <a href="login.php" class="text-decoration-none">Login</a></p>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </section>
</body>

</html>