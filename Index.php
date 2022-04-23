<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>

    <div class="vh-100 row m-0 align-items-center justify-content-center">
        <div class="col-auto p-5 bg-white shadow-lg rounded">
            <?php
                session_start();
                include('MySql/Config.php');
 
                if (isset($_POST['login'])) {
 
                    $username = $_POST['usuario'];
                    $password = $_POST['password'];
 
                    $query = $conn->prepare("SELECT * FROM usuarios WHERE username=:username");
                    $query->bindParam("username", $username, PDO::PARAM_STR);
                    $query->execute();
 
                    $result = $query->fetch(PDO::FETCH_ASSOC);
 
                    if (!$result) {
                        header("location: Index.php");
                        echo '<p class="error">Convinacion Incorrecta!</p>';
                    } else {
                        if (password_verify($password, $result['password'])) {
                            $_SESSION['user_id'] = $result['id'];
                            header("location: Principal.php");
                            echo '<p class="success">Ingresaste!</p>';
                        } else {
                            header("location: Index.php");
                            echo '<p class="error">Convinacion Incorrecta!</p>';
                        }
                    }
                }
            ?>
            <div class="container">
                <h3 class="text-center">Iniciar Sesion</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input id="usuario" class="form-control" type="text" name="usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" type="password" name="password">
                    </div>

                    <div style="margin-top: 2rem; margin-left: 4rem; margin-right: 4rem; margin-bottom: 1rem;">
                        <a href="#">Ha olvidado su contraseña?</a>
                    </div>
                    <br>
                    <div class="d-grid gap-2 d-md-block text-center">
                        <a href="AgregarUsuario.php" class="btn btn-secondary col-4" type="submit">Resgistrarse</a>
                        <button class="btn btn-primary col-4" name="login" type="submit">Acceder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>