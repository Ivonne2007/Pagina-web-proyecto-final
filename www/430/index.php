<?php  require_once ('functiones.php');  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coneccion Base de Datos</title>
   
</head>
<body>
<?php
      // Conexion a la base de datos "biblioteca".
      $username_con="root";
      $password_con ="";
      $hostname_con="localhost";
      $database_con="biblioteca";
      $con=mysqli_connect($hostname_con, $username_con, $password_con, $database_con);
      mysqli_set_charset($con, 'utf8');

      //Consulta a la base de datos, en especifico a la tabla autor
      $query_DatosConsulta = sprintf("SELECT*FROM autor");
      $DatosConsulta = mysqli_query($con, $query_DatosConsulta) or die(mysqli_error($con));
      $row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
      $totalRow_DatosConsulta = mysqli_num_rows($DatosConsulta);
      

     //Mostrar la informacion de la tabla autor 
      if($totalRow_DatosConsulta > 0 )
      {
       
      do { 
        echo $row_DatosConsulta["NA"];
        echo " ";
        echo $row_DatosConsulta["Nombre"];
        echo " ";
        echo $row_DatosConsulta["PaisOrigen"];
        echo " ";
        echo $row_DatosConsulta["Genero"];
        echo"<br>";
      } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta));
    }
    
    if((isset ($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formInsertar")) {
      $insertSQL = sprintf("INSERT INTO autor(Nombre, PaisOrigen, Genero) VALUES (%s, %s, %s)",
                  GetSQLValueString($_POST["strNombre"], "text"),
                  GetSQLValueString($_POST["strPaisOrigen"], "text"),
                  GetSQLValueString($_POST["strGenero"], "text"));
      $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
      $insertGoto = "index.php";
      header(sprintf("Location: %s", $insertGoto));
    }  



    if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "formBorrar")) {
      $query_Delete = sprintf("DELETE FROM autor WHERE NA = %s",
        GetSQLValueString( 2, "text"));
      $Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));
      $insertGoTo = "index.php";
      header(sprintf("Location: %s", $insertGoTo));
    }


    
    ?>
    <br>
    <form action="index.php" method="post" id="formInsertar" role="form" name="formInsertar">
      <div clase="form-ground">
        <label >Nombre:</label>
        <input name="strNombre" class="form-control" id="strNombre"   placeholder="Escribir el nombre" >
      </div>
       <br>
      <div clase="form-ground">
      <label >PaisOrigen:</label>
        <input name="strPaisOrigen" class="form-control" id="strPaisOrigen"   placeholder="Escribir el pais de Origen" >
      </div>
      <br>
      <div clase="form-ground">
      <label >Genero:</label>
        <input name="strGenero" class="form-control" id="strGenero"   placeholder="Escribir el Genero" >
      </div>
      <input name="MM_insert" type="hidden" id="MM_insert" value="formInsertar">
      <br>
      <button type="submit" class="btn btn-success">Añadir</button>
    </form>


    <form action= "index.php" method="post" id="formBorrar" role="form" name="formBorrar">
     <input name="MM_delete" type="hidden" id="MM_delete" value="formBorrar">
     <button type="submit" class="btn btn-success">Borrar</button>
    </form>

    <?php mysqli_close($con); ?>  
</body>
</html>