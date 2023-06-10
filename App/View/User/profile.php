<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'User') {
    // El usuario no ha iniciado sesión o no tiene el rol de User
    header('Location: ../../../App/View/User/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../../Public/Css/Includes/all.css" type="text/css">
    <link href="../../../Public/Css/Home/Landigpage/hamburgers.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../Public/Css/System/User/user.css">
    <title>Panel User</title>
</head>

<body>
    <div class="sidebar active">
        <div class="logo_content">
            <div class="logo">
                <img class="logoHeader" src="../../../Public/Assets/Img/headerLogo.svg" alt="header logo">
            </div>
            <!-- <i class='bx bx-menu-alt-right' id="btn" style="font-size: 25px;"></i> -->
            <button id="btn" class="hamburger hamburger--arrow is-active" type="button" aria-label="Menu"
                aria-controls="navigation">
                <span class="hamburger-box boxNav">
                    <span class="hamburger-inner barsNav"></span>
                </span>
            </button>
        </div>
        <ul class="nav_list">
            <li>

                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_names">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-user'></i>
                    <span class="link_names">User</span>
                </a>
                <span class="tooltip">User</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-chat'></i>
                    <span class="link_names">Messages</span>
                </a>
                <span class="tooltip">Messages</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_names">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-folder'></i>
                    <span class="link_names">Files</span>
                </a>
                <span class="tooltip">Files</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cart-alt'></i>
                    <span class="link_names">Orders</span>
                </a>
                <span class="tooltip">Orders</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-heart'></i>
                    <span class="link_names">Liked</span>
                </a>
                <span class="tooltip">Liked</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_names">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="../../../<?php echo $_SESSION['profileImage']; ?>" alt="image profile">
                    <div class="name_job">
                        <div class="name">
                            <?php echo $_SESSION['name']; ?>
                        </div>
                        <div class="job">
                            <?php echo $_SESSION['role']; ?>
                        </div>
                    </div>
                </div>
                <i class='bx bx-log-out' id="log_out"></i>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="text">Home Content Here...</div>
    </div>
    <script src="../../../Public/Js/System/User/user.js"></script>

</body>

</html>