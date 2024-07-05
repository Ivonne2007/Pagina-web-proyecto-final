<?php  require_once ('fuctiones.php');  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conectemos Base de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .parallax {
        /* The image used */
        background-image: url("imagenes/R.jpg");
      
        /* Set a specific height */
        min-height: 500px;
      
        /* Create the parallax scrolling effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      </style>
      
</head>
<body>
<div class="parallax">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-md">
            <a class="navbar-brand" href="#">Solicita tu presupuesto!!</a>
          </div>
          <br><br>
          </nav>
<?php
      // Conexion a la base de datos "Vidrieria
      $username_con="root";
      $password_con ="";
      $hostname_con="localhost";
      $database_con="vidrieria";
      $con=mysqli_connect($hostname_con, $username_con, $password_con, $database_con);
      mysqli_set_charset($con, 'utf8');

//Consulta un registro de la tabla autor
$query_DatosConsultaU = sprintf("SELECT*FROM clientes WHERE NA=2");
$DatosConsultaU = mysqli_query($con, $query_DatosConsultaU) or die(mysqli_error($con));
$row_DatosConsultaU = mysqli_fetch_assoc($DatosConsultaU);
$totalRow_DatosConsultaU = mysqli_num_rows($DatosConsultaU);

      //Consulta a la base de datos
      $query_DatosConsulta = sprintf("SELECT*FROM clientes");
      $DatosConsulta = mysqli_query($con, $query_DatosConsulta) or die(mysqli_error($con));
      $row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
      $totalRow_DatosConsulta = mysqli_num_rows($DatosConsulta);
      
     
     
     //Mostrar la informacion de la clientes
      if($totalRow_DatosConsulta > 0 )
      {
       
      do { 
        echo $row_DatosConsulta["NA"];
        echo " ";
        echo $row_DatosConsulta["Nombre"];
        echo " ";
        echo $row_DatosConsulta["Telefono"];
        echo " ";
        echo $row_DatosConsulta["Lugar"];
        echo"";
        echo $row_DatosConsulta["Trabajo"];
        echo"<br>";
      } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta));
    }
    //if para insertar informacion
    if((isset ($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formInsertar")) {
      $insertSQL = sprintf("INSERT INTO clientes (Nombre, Telefono, Lugar, Trabajo) VALUES (%s, %s, %s, %s)",
                  GetSQLValueString($_POST["strNombre"], "text"),
                  GetSQLValueString($_POST["intTel"], "int"),
                  GetSQLValueString($_POST["strLugar"], "text"),
                  GetSQLValueString($_POST["strTrabajo"], "text"));
      $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
      $insertGoto = "form.php";
      header(sprintf("Location: %s", $insertGoto));
    }  

    //if para borrarr información
    if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "formBorrar")) {
      $query_Delete = sprintf("DELETE FROM clientes WHERE NA = %s",
        GetSQLValueString( 2, "text"));
      $Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));
      $insertGoTo = "form.php";
      header(sprintf("Location: %s", $insertGoTo));
    }
    //if para actualizar infromación
    if ((isset($_POST["MM_Actualizar"])) && ($_POST["MM_Actualizar"] == "formActualizar")) {
      $updateSQL = sprintf("UPDATE clientes SET Nombre=%s, Telefono=%s, Lugar=%s, Trabajo=%s WHERE NA = %s",
      GetSQLValueString($_POST["strNombre"], "text"),
      GetSQLValueString($_POST["intTel"], "int"),
      GetSQLValueString($_POST["strLugar"], "text"),
      GetSQLValueString($_POST["strTrabajo"], "text"),
      GetSQLValueString(1, "text"));
     $Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));
     $insertGoto = "form.php";
      header(sprintf("Location: %s", $insertGoto));
     }  

    
    ?>
    <br>
    <form action="form.php" method="post" id="formInsertar" role="form" name="formInsertar">
      <div clase="form-ground">
        <label >Nombre:</label>
        <input name="strNombre" class="form-control" id="strNombre" placeholder="Escriba su Nombre" >
      </div>
       <br>
      <div clase="form-ground">
      <label >Tel:</label>
        <input name="intTel" class="form-control" id="intTel" placeholder="Telefono" >
      </div>
      <br>
      <div clase="form-ground">
      <label >Lugar:</label>
        <input name="strLugar" class="form-control" id="strLugar" placeholder="Localidad a la que pretenece" >
      </div>
      <div clase="form-ground">
      <label >Trabajo:</label>
        <input name="strTrabajo" class="form-control" id="strTrabajo" placeholder="Trabajo que necesita" >
      </div>
      <input name="MM_insert" type="hidden" id="MM_insert" value="formInsertar">
      <br>
      <button type="submit" class="btn btn-success">Añadir</button>
    </form>
<br><br>
    <!--Borrar -->
    <form action= "form.php" method="post" id="formBorrar" role="form" name="formBorrar">
     <input name="MM_delete" type="hidden" id="MM_delete" value="formBorrar">
     <button type="submit" class="btn btn-success">Borrar</button>
    </form>
    <!--Formulario para actualizar registros-->
    <form action="form.php" method="post" id="formActualizar" role="form" name="formActualizar">
      <div clase="form-group">
        <label >Nombre:</label>
        <input name="strNombre" class="form-control" id="strNombre"  placeholder="Cambiar nombre" VALUE=  "<?php echo$row_DatosConsultaU["Nombre"]; ?>" >
      </div>
      <div clase="form-group">
      <label >Tel:</label>
        <input name="intTel" class="form-control" id="intTel" placeholder="Cambiar el Telefono"VALUE= "<?php echo$row_DatosConsultaU["Telefono"]; ?>" >
      </div>
      <div clase="form-ground">
      <label >Lugar:</label>
        <input name="strLugar" class="form-control" id="strLugar" placeholder="Cambiar Localidad"VALUE= "<?php echo$row_DatosConsultaU["Lugar"]; ?>" >
      </div>
      <div clase="form-ground">
      <label >Trabajo:</label>
        <input name="strTrabajo" class="form-control" id="strTrabajo" placeholder="Cambiar el trabajo"VALUE= "<?php echo$row_DatosConsultaU["Trabajo"]; ?>" >
      </div>
      <input name="MM_Actualizar" type="hidden" id="MM_Actualizar" value="formActualizar">
      <br>
      <button type="submit" class="btn btn-success">Actualizar</button>
      </form>
    <?php mysqli_close($con); ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
  </body>
</html>