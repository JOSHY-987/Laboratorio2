<?php
session_start();
include('MySql/Config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: Index.php');
    exit;
}

if(isset($_POST['modificar']))
{
    $id = $_GET['EditId'];
    $matricula = $_POST['matricula'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $precio = $_POST['precio'];

    if($llamado -> Actualizar($id, $matricula, $marca, $modelo, $color, $precio))
    {
        $mensaje = "<div class='alert alert-success' role='alert'>
                        Registro Se Ha Actualizado!
                    </div>";
    }
    else
    {
        $mensaje = "<div class='alert alert-danger' role='alert'>
                        Operacion Actualizar Ha Fallado!
                    </div>";
    }
}

if (isset($_GET['EditId']))
{
    $Id = $_GET['EditId'];
    $establecer = $conn -> prepare("SELECT * FROM automovil WHERE autoid = ?");
    $establecer->execute([$Id]);
    $registro = $establecer -> fetch(PDO::FETCH_OBJ);
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <?php require_once "Partes/Menu.php"; ?>
    <title>Modificar Auto</title>
</head>

<body>
    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <?php
                    if(isset($mensaje))
                    {
                        echo $mensaje;
                    }
                ?>
                <h3>Modificar Auto</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="matricula">Matricula</label>
                        <input id="matricula" value="<?php echo $registro->matricula;?>" class="form-control" type="text" name="matricula">
                    </div>

                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input id="marca" value="<?php echo $registro->marca;?>" class="form-control" type="text" name="marca">
                    </div>

                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input id="modelo" value="<?php echo $registro->modelo;?>" class="form-control" type="text" name="modelo">
                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <input id="color" value="<?php echo $registro->color;?>" class="form-control" type="text" name="color">
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input id="precio" value="<?php echo $registro->precio;?>" class="form-control" type="text" name="precio">
                    </div>

                    <br>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="MostrarAutos.php" class="btn btn-secondary" type="submit">Cancelar</a>
                        <button class="btn btn-primary" name="modificar" type="submit">Modificar Auto</button>
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