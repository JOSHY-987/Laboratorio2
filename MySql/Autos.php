<?php
class Autos
{
    private $DB;

    function __construct($conn)
    {
        $this -> DB = $conn;
    }

    //Mostrar Todos Los Pacientes
    public function MostrarAutos($consulta)
    {
        $establecer = $this -> DB -> prepare($consulta);
        $establecer -> execute() > 0;
         
        while($columna = $establecer -> fetch(PDO::FETCH_ASSOC))
        {
            ?> 
            <tr>
            <td><?php echo $columna['autoid']?></td>
            <td><?php echo $columna['matricula']?></td>
            <td><?php echo $columna['marca']?></td>
            <td><?php echo $columna['modelo']?></td>
            <td><?php echo $columna['color']?></td>
            <td><?php echo $columna['precio']?></td>
            <td>
                <a href="ModificarAuto.php?EditId=<?php echo $columna['autoid']?>" class="btn btn-warning">
                    <i class="fa-solid fa-pencil"></i>
                </a>

                <a href="EliminarAuto.php?ElimId=<?php echo $columna['autoid']?>" class="btn btn-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>
        </tr>
            
        <?php
        } 
    }

    public function Actualizar($id, $matricula, $marca, $modelo, $color, $precio)
    {
        try
        {
            $establecer = $this -> DB -> prepare("UPDATE automovil SET matricula=:matricula,
            marca=:marca, modelo=:modelo, color=:color, precio=:precio
            WHERE autoid=:autoid");
            $establecer->bindParam(":matricula", $matricula);
            $establecer->bindParam(":marca", $marca);
            $establecer->bindParam(":modelo", $modelo);
            $establecer->bindParam(":color", $color);
            $establecer->bindParam(":precio", $precio);
            $establecer->bindParam(":autoid", $id);
            $establecer->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }

    public function Eliminar($id)
    {
        try
        {
            $establecer = $this -> DB -> prepare("DELETE FROM automovil WHERE autoid=:autoid");
            $establecer->bindParam(":autoid", $id);
            $establecer->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }
}