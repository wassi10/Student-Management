<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_regex = "/^\S+@\S+\.\S+$/";


    if (!preg_match($email_regex, $email)) {
        echo "<script>alert('Invalid email address.')</script>";
    } else {

        include 'db.php';

        $select = "SELECT * FROM `register_form` WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($conn, $select);


        if ($email == 'admin@gmail.com' && $password == 'admin123') {

            // $_SESSION['admin_name'] = $row['name'];
            header('location:admin_dashboard.php');

        } 
        elseif (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_array($result);

            if ($email == $row['email'] && $password == $row['password']) {

                $_SESSION['user_name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header('location:student_dashboard.php');
            }
        } 
        else {
            echo "<script>alert('Incorrect Email or Password')</script>";
        }



        // Close the database connection
        mysqli_close($conn);
    }
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
                    <h3 class="mb-4 text-center fs-1">Login Form</h3>

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                        <div class="class-floating mb-3">
                            <input type="email" name="email" id="floatingInput" class="form-control rounded-0 bg-light" placeholder="name@example.com" required>
                        </div>


                        <div class="class-floating mb-3">
                            <input type="password" name="password" id="floatingPassword" class="form-control rounded-0 bg-light" placeholder="Password" required>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" name="submit" class="btn btn-dark  border-0 rounded-0">Login</button>
                        </div>

                        <div>
                            <p>Don't have an Account? <a href="index.php" class="text-decoration-none">Register Here</a></p>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </section>
</body>

</html>