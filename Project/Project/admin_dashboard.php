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

      <title>Dashboard</title>
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

                  <a href="#" class="sidebar__link active-link">
                     <i class="ri-home-5-line"></i>
                     <span class="sidebar__link-name">Home</span>
                     <span class="sidebar__link-floating">Home</span>
                  </a>

               </div>


               <h3 class="sidebar__title">
                  <span>User</span>
               </h3>


               <div class="sidebar__list">

                  <a href="#" class="sidebar__link">
                     <i class="ri-user-add-line"></i>
                     <span class="sidebar__link-name">Add User</span>
                     <span class="sidebar__link-floating">Add User</span>
                  </a>

                  <a href="#" class="sidebar__link">
                     <i class="ri-group-line"></i>
                     <span class="sidebar__link-name">All User</span>
                     <span class="sidebar__link-floating">All User</span>
                  </a>
               </div>


               <h3 class="sidebar__title">
                  <span>General</span>
               </h3>

               <div class="sidebar__list">
            
                  <a href="#" class="sidebar__link">
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
                  <h3 class="sidebar__name">Khadiza Wassi</h3>
               </div>

               <i class="ri-arrow-right-s-line"></i>
            </div>


         </nav>
      </div>

      <!--=============== Main Container ===============-->
      <main class="main container" id="main">
         <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Khadiza wassi</td><td>Khadiza wassi</td><td>Khadiza wassi</td>
                </tr>
            </tbody>
         </table>
         
      </main>
      
      <!-- js connect -->
      <script src="js/main.js"></script>

   </body>
</html>