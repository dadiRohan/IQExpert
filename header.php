<?php
session_start();

if(isset($_SESSION['username'])){
    $username =   $_SESSION['username'];
}

//    $username = 'ZAFAR';

if(!isset($_SESSION['username'])){
   header("Location:index.php"); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Title Page-->
    <title>Dashboard</title>

    <link rel="shortcut icon" href="images/icon/ICO.jpg" />
    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">


    <!--PAGINATION-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://gyrocode.github.io/jquery-datatables-alphabetSearch/1.2.4/css/dataTables.alphabetSearch.css"> -->
    <!--PAGINATION-->
    <style type="text/css">
       .navbar-sidebar .navbar__list li a{
            text-decoration: none;
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="dashboard.php">
                            <img src="images/icon/LOGO1.png" alt="CoolAdmin" class="img-fluid" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="active has-sub">
                        <a class="js-arrow" href="#">
                        <li>
                            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Home</a>
                        </li>
                        </li>
                        <li>
                            <a href="userDetails.php"><i class="zmdi zmdi-account"></i>Members</a>
                        </li>
                        <li>
                            <a href="Transaction.php"><i class="fas fa-chart-bar"></i>Transaction</a>
                        </li>
                        <li>
                            <a href="liveStatusPlay.php"><i class="fas fa-table"></i>Live Status</a>
                        </li>
                        <li>
                            <a href="liveTransaction.php"><i class="zmdi zmdi-shopping-cart"></i>Live Bidding</a>
                        </li>
                        <li>
                            <a href="GameTransaction.php"><i class="zmdi zmdi-map"></i>Game Transaction</a>
                        </li>
                        <li>
                            <a href="PayUMoneyWithdraw.php"><i class="fas fa-check-square"></i>PayUMoney Withdraw</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </header>

        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="dashboard.php">
                    <img src="images/icon/LOGO2.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                        <a class="js-arrow" href="#">
                        <li>
                            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Home</a>
                        </li>
                        </li>
                        <li>
                            <a href="userDetails.php"><i class="zmdi zmdi-account"></i>Members</a>
                        </li>
                        <li>
                            <a href="Transaction.php"><i class="fas fa-chart-bar"></i>Transaction</a>
                        </li>
                        <li>
                            <a href="liveStatusPlay.php"><i class="fas fa-table"></i>Live Status</a>
                        </li>
                        <li>
                            <a href="liveTransaction.php"><i class="zmdi zmdi-shopping-cart"></i>Live Bidding</a>
                        </li>
                        <li>
                            <a href="GameTransaction.php"><i class="zmdi zmdi-map"></i>Game Transaction</a>
                        </li>
                        <li>
                            <a href="PayUMoneyWithdraw.php"><i class="fas fa-check-square"></i>PayUMoney Withdraw</a>
                        </li>
                        <!-- <li>
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.php">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="map.php">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li> -->
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                
                            </form>
                            <div class="header-button">
                                
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/admin.jpg" alt="Admin" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">
                                                <!-- Admin -->
                                                <?php echo $username; ?>
                                            </a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/admin.jpg" alt="Admin" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">
                                                            <!-- Admin -->
                                                            <?php echo $username; ?>
                                                        </a>
                                                    </h5>
                                                    <!-- <span class="email">johndoe@example.com</span> -->
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="changePassword.php">
                                                    <i class="zmdi zmdi-settings"></i>Change Password</a>
                                                
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
