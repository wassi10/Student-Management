<?php
include 'db.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login.php');
}
if (!isset($_SESSION['id'])) {
   header('location:login.php');
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

   <title>View All Information</title>
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

               <a href="" class="sidebar__link">
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

      <section id="courses-table">
         <div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt quaerat voluptatem nam, eius molestias nihil illo libero, dolorem labore officiis alias, tenetur suscipit provident perferendis aspernatur quos aut aliquam facere!</p>
         </div>
         <div class="table-responsive">

            <table class="table table-bordered table-hover">
               <thead class="table-info">
                  <tr>
                     <th>Course Code</th>
                     <th>Course Title</th>
                     <th>Credit</th>
                     <th>Section</th>
                     <th>Batch</th>
                     <!-- <th>Total Credit</th>
                     <th>Total Fee</th>
                     <th>Operation</th> -->
                  </tr>
               </thead>

               <tbody>

                  <?php

                  include 'db.php';

                  //Read all row from database table
                  $id = $_SESSION['id'];
                  $sql = "SELECT * FROM `$id`";
                  $result = $conn->query($sql);

                  if (!$result) {
                     die("Invalid Query: " . $conn->error);
                  }

                  //read data of each row
                  while ($row = $result->fetch_assoc()) {
                     echo "
                        <tr>
                           <td>$row[courseCode]</td>
                           <td>$row[courseTitle]</td>
                           <td>$row[credit]</td>
                           <td>$row[section]</td>
                           <td>$row[batch]</td>
                        </tr>
                     ";
                  }
                  ?>


               </tbody>


            </table>
         </div>


      </section>
      <div id="btn-div">
         <button id="download-admit" type="submit" class="btn btn-primary" disabled>Download</button>
      </div>
   </main>

   <!-- approve js -->
   <script src="js/approve.js"></script>
   <!-- get admit js -->
   <script src="js/getAdmit.js"></script>
   <!-- js connect -->
   <script src="js/main.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
   <script src="http://cdn.jsdelivr.net/g/filesaver.js"></script>
   <script>
      console.log(document.getElementById('download-admit').disabled = false);
   </script>
</body>

</html>