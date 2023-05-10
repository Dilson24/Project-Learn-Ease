<!-- En este ejemplo, el controlador UserController utiliza los métodos del modelo UserModel para realizar operaciones CRUD en la tabla de usuarios.

El método index() llama al método getAllUsers() del modelo para obtener una lista de todos los usuarios en la tabla de usuarios y luego muestra la lista en una vista.

El método create() muestra un formulario de creación de usuario en una vista.

El método store() guarda un nuevo usuario en la base de datos llamando al método createUser() del modelo y luego redirige al usuario a la página de vista de usuario recién creado.

El método show() muestra un usuario específico de la tabla de usuarios llamando al método getUserById() del modelo y luego muestra los detalles en una vista.

El método edit() muestra un formulario de edición de usuario en una vista, rellenando los campos con los detalles del usuario llamando al método getUserById() del modelo.

El método update() actualiza un usuario específico en la tabla de usuarios llamando al método updateUser() del modelo y luego redirige al usuario a la página de vista del usuario actualizado.

El método delete() elimina un usuario específico de la tabla de usuarios llamando al método deleteUserById() del modelo y luego redirige al usuario a la página de lista de usuarios actualizada. -->
<?php

require_once('../Models/UserModel.php');

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Mostrar todos los usuarios
    public function index() {
        $users = $this->userModel->getAllUsers();
        require('../Views/User/list.php');
    }

    // Mostrar el formulario de creación de usuario
    public function create() {
        require('../Views/User/create.php');
    }

    // Guardar un nuevo usuario en la base de datos
    public function store() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $newUserId = $this->userModel->createUser($name, $email, $password);

        header("Location: /user/show?id=$newUserId");
    }

    // Mostrar un usuario por su ID
    public function show() {
        $id = $_GET['id'];
        $user = $this->userModel->getUserById($id);
        require('../Views/User/show.php');
    }

    // Mostrar el formulario de edición de usuario
    public function edit() {
        $id = $_GET['id'];
        $user = $this->userModel->getUserById($id);
        require('../Views/User/edit.php');
    }

    // Actualizar un usuario existente en la base de datos
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $rowsAffected = $this->userModel->updateUser($id, $name, $email, $password);

        header("Location: /user/show?id=$id");
    }

    // Eliminar un usuario por su ID
    public function delete() {
        $id = $_POST['id'];
        $rowsAffected = $this->userModel->deleteUserById($id);

        header("Location: /user");
    }
}
