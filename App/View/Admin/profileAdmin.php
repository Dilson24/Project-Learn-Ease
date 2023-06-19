<?php
require_once '../../../App/Controller/Admin/adminController.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    // El usuario no ha iniciado sesión o no tiene el rol de administrador
    header('Location: ../../../App/View/User/login.php');
    exit();
}
// Crear una instancia de AdminController
$adminController = new AdminController($conn);
$users = $adminController->read();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../../Public/Css/Includes/all.css" type="text/css">
    <link href="../../../Public/Css/Home/Landigpage/hamburgers.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../Public/Css/System/Admin/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Panel Admin</title>
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
        <div class="showData">
            <h1 class="userRegister">Usurios Registrados</h1>
            <div class="viewData">
                <div class="showRow">
                    <label class="formLabel" for="cantidad">Seleccione la cantidad de datos a mostrar:</label>
                    <select class="formControl">
                        <option value="5" selected="selected">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="searchRow">
                    <label class="formLabel">Espacio para filtrar datos</label>
                    <input class="formControl" type="text" name="search" placeholder="Introduzca la palabra clave">
                </div>
            </div>
            <table id="table">
                <thead>
                    <tr class="myHead">
                        <th>#</th>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de nacimiento</th>
                        <th>telefono</th>
                        <th>Tipo de estudiante</th>
                        <th>País</th>
                        <th>Ciudad</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <?php echo $user['User_ID']; ?>
                            </td>
                            <td>
                                <?php echo $user['Name']; ?>
                            </td>
                            <td>
                                <?php echo $user['Last_Name']; ?>
                            </td>
                            <td>
                                <?php echo $user['Date_of_Birth']; ?>
                            </td>
                            <td>
                                <?php echo $user['Phone_Number']; ?>
                            </td>
                            <td>
                                <?php echo $user['Student_Type_ID']; ?>
                            </td>
                            <td>
                                <?php echo $user['Country']; ?>
                            </td>
                            <td>
                                <?php echo $user['City']; ?>
                            </td>
                            <td>
                                <?php echo $user['Email']; ?>
                            </td>
                            <td>
                                <?php echo $user['Role_ID']; ?>
                            </td>
                            <td class="iconsO">
                                <i class="fa-solid fa-pen-to-square" data-id="<?php echo $user['User_ID']; ?>"></i>
                                <i class="fa-solid fa-trash" data-id="<?php echo $user['User_ID']; ?>"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="controller">
                <ul class="pager">
                    <li><a href="javascript:void(0)" class="prev">Previous</a></li>
                    <li>
                        <ul class="pagination"></ul>
                    </li>
                    <li><a href="javascript:void(0)" class="next">Next</a></li>
                </ul>
            </div>
        </div>
        <div class="addNewAdmin">
            <h2>Agregar un nuevo administrador</h2>
            <p class="textP">Al hacer clic en el botón 'Crear administrador', se desplegará un formulario para crear un
                nuevo usuario
                con el rol de administrador.
                Es importante tener en cuenta que otorgar el rol de administrador conlleva importantes privilegios y
                responsabilidades.
                Por tanto, es crucial ejercer precaución al asignar este rol, ya que una gestión inadecuada de los
                administradores puede comprometer
                tanto la seguridad como la fiabilidad de la aplicación.</p>
            <button class="btnAddAdmin">
                <span class="iconContainer">
                    <i class="fa-solid fa-user-shield"></i>
                </span>
                <p class="text">Add new Admin</p>
            </button>
        </div>

    </div>
    <script src="../../../Public/Js/System/Admin/admin.js"></script>

</body>

</html>