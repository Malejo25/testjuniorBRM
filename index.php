<?php include('BDconect.php');?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Test Junior BRM</title>

<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/sticky-footer-navbar.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

<script>
function myFunction() {

  var input, filter, table, tr, td, td2, td3, i, txtValue, txtValue2, txtValue3;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");


  for (i = 0; i < tr.length; i++) {
	td = tr[i].getElementsByTagName("td")[0];
	td2 = tr[i].getElementsByTagName("td")[1];
	td3 = tr[i].getElementsByTagName("td")[2];
    if (td || td2 || td3) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2.textContent || td2.innerText;
      txtValue3 = td3.textContent || td3.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } 
       else if (txtValue2.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } 
       else if (txtValue3.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } 
      else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".content").fadeOut(1500);
    },3000);

});
</script>
</head>

<body>
<header> 
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <a class="navbar-brand" href="#">ELABORADOR POR: MARIO ALEJANDRO SALAZAR TOLEDO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"> <a class="nav-link" href="index.php">INICIO<span class="sr-only">(current)</span></a> </li>
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar Contacto">
      </form>
    </div>
  </nav>
</header>

<!-- Begin page content -->

<div class="container">
<?php
    
if(isset($_POST['eliminar'])){

////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `tbl_personal` WHERE `id`=:id";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':id', $id, PDO::PARAM_INT);
$id=trim($_POST['id']);

$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo "<div class='content alert alert-primary' > 
Gracias: $count Contacto ha sido eliminado  </div>";
}
else{
    echo "<div class='content alert alert-danger'> No se pudo eliminar el Contacto  </div>";

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>

<?php
    
if(isset($_POST['insertar'])){
///////////// Informacion enviada por el formulario /////////////
$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$profesion=$_POST['profesion'];
$estado=$_POST['estado'];
$fregis = $_POST['fregis'];
///////// Fin informacion enviada por el formulario /// 

////////////// Insertar a la tabla la informacion generada /////////
$sql="insert into tbl_personal(nombres,apellidos,profesion,estado,fregis) values(:nombres,:apellidos,:profesion,:estado,:fregis)";
    
$sql = $connect->prepare($sql);
    
$sql->bindParam(':nombres',$nombres,PDO::PARAM_STR, 25);
$sql->bindParam(':apellidos',$apellidos,PDO::PARAM_STR, 25);
$sql->bindParam(':profesion',$profesion,PDO::PARAM_STR,25);
$sql->bindParam(':estado',$estado,PDO::PARAM_STR,25);
$sql->bindParam(':fregis',$fregis,PDO::PARAM_STR);
    
$sql->execute();

$lastInsertId = $connect->lastInsertId();
if($lastInsertId>0){

echo "<div class='content alert alert-primary' > Gracias .. Tu Nombre es : $nombres  </div>";
}
else{
    echo "<div class='content alert alert-danger'> No se pueden agregar datos, comunÃ­quese con el administrador  </div>";

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>

<?php
    
if(isset($_POST['actualizar'])){
///////////// Informacion enviada por el formulario /////////////
$id=trim($_POST['id']);
$nombres=trim($_POST['nombres']);
$apellidos=trim($_POST['apellidos']);
$profesion=trim($_POST['profesion']);
$estado=trim($_POST['estado']);
$fregis = $_POST['fregis'];
///////// Fin informacion enviada por el formulario /// 

////////////// Actualizar la tabla /////////
$consulta = "UPDATE tbl_personal
SET `nombres`= :nombres, `apellidos` = :apellidos, `profesion` = :profesion, `estado` = :estado, `fregis` = :fregis
WHERE `id` = :id";
$sql = $connect->prepare($consulta);
$sql->bindParam(':nombres',$nombres,PDO::PARAM_STR, 25);
$sql->bindParam(':apellidos',$apellidos,PDO::PARAM_STR, 25);
$sql->bindParam(':profesion',$profesion,PDO::PARAM_STR,25);
$sql->bindParam(':estado',$estado,PDO::PARAM_STR,25);
$sql->bindParam(':fregis',$fregis,PDO::PARAM_STR);
$sql->bindParam(':id',$id,PDO::PARAM_INT);

$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo "<div class='content alert alert-primary' > 

  
Gracias: $count Contacto ha sido actualizado  </div>";
}
else{
    echo "<div class='content alert alert-danger'> No se pudo actulizar el Contacto  </div>";

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>
  <h3 class="mt-5">AGENDA DE CONTACTOS</h3>
  <hr>
  <div class="row">
  
  <!-- Insertar Contactos-->
  <?php 
if (isset($_POST['formInsertar'])){?>
    <div class="col-12 col-md-12"> 
<form action="" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombres">Nombre</label>
      <input name="nombres" type="text" class="form-control" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
      <label for="edad">Telefono</label>
      <input name="apellidos" type="text" class="form-control" id="edad" placeholder="Telefono">
    </div>
  </div>
<div class="form-row">  
    <div class="form-group col-md-6">
      <label for="profesion">Direccion</label>
      <input name="profesion" type="text" class="form-control" id="profesion" placeholder="Direccion">
    </div>

  <div class="form-group col-md-6">
    <label for="Estado">Correo</label>
    <input name="estado" type="text" class="form-control" id="Estado" placeholder="Correo">
  </div>
  
  <div class="form-group col-md-6">
	    <label for="Estado">Fecha de Nacimiento</label>
		<input name="fregis" type="date" class="form-control"  id="fregis">
  </div>

</div>
<div class="form-group">
  <button name="insertar" type="submit" class="btn btn-primary  btn-block">Guardar</button>
</div>

  
</form>
    </div> 
<?php }  ?>
<!-- Fin Insertar Contactos-->


<?php 
if (isset($_POST['editar'])){
$id = $_POST['id'];
$sql= "SELECT * FROM tbl_personal WHERE id = :id"; 
$stmt = $connect->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT); 
$stmt->execute();
$obj = $stmt->fetchObject();
 
?>

    <div class="col-12 col-md-12"> 

<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <input value="<?php echo $obj->id;?>" name="id" type="hidden">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nombres">Nombre</label>
      <input value="<?php echo $obj->nombres;?>" name="nombres" type="text" class="form-control" placeholder="Nombres">
    </div>
    <div class="form-group col-md-6">
      <label for="edad">Telefono</label>
      <input value="<?php echo $obj->apellidos;?>" name="apellidos" type="text" class="form-control" id="edad" placeholder="Apellidos">
    </div>
  </div>
<div class="form-row">  
    <div class="form-group col-md-6">
      <label for="profesion">Direccion</label>
      <input value="<?php echo $obj->profesion;?>" name="profesion" type="text" class="form-control" id="profesion" placeholder="Profesion">
    </div>

  <div class="form-group col-md-6">
    <label for="Estado">Correo</label>
     <input value="<?php echo $obj->estado;?>" name="estado" type="text" class="form-control" id="Estado" placeholder="Estado">
  </div>
  
  <div class="form-group col-md-6">
	    <label for="Estado">Fecha de Nacimiento</label>
		<input value="<?php echo $obj->fregis; ?>"  name="fregis" type="date" class="form-control"  id="$fregis">
  </div>
</div>
<div class="form-group">
  <button name="actualizar" type="submit" class="btn btn-primary  btn-block">Actualizar Contacto</button>
</div>
</form>
    </div>  
<?php }?>
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->


<div style="float:right; margin-bottom:5px;">

<form action="" method="post"><button class="btn btn-primary" name="formInsertar">Nuevo Contacto</button>  <a href="index.php"><button type="button" class="btn btn-primary">Cancelar</button></a></form></div>

<div class="table-responsive">
<table class="table table-bordered table-striped" id="myTable">
<thead class="thead-dark">
    <th width="18%">Nombre</th>
    <th width="15%">Telefono</th>
    <th width="14%">Correo</th>
    <th width="15%">Direccion</th>
    <th width="13%">Fecha Nacimiento</th>
    <th width="13%">Edad</th>
    <th width="13%" colspan="2"></th>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM tbl_personal"; 
$query = $connect -> prepare($sql); 
$query -> execute(); 
$results = $query -> fetchAll(PDO::FETCH_OBJ); 



if($query -> rowCount() > 0)   { 
foreach($results as $result) 
{ 
$fecha_nacimiento = $result -> fregis;
$dia_actual = date("Y-m-d");
$edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
echo "<tr>
<td>".$result -> nombres."</td>
<td>".$result -> apellidos."</td>
<td>".$result -> estado."</td>
<td>".$result -> profesion."</td>
<td>".$result -> fregis."</td>
<td>".$edad_diff->y."</td>
<td>
<form method='POST' action='".$_SERVER['PHP_SELF']."'>
<input type='hidden' name='id' value='".$result -> id."'>
<button name='editar'>Editar</button>
</form>
</td>

<td>
<form  onsubmit=\"return confirm('Realmente desea eliminar el Contacto?');\" method='POST' action='".$_SERVER['PHP_SELF']."'>
<input type='hidden' name='id' value='".$result -> id."'>
<button name='eliminar'>Eliminar</button>
</form>
</td>
</tr>";

   }
 }
?>
</tbody>
</table>
</div>
   </div>  
  </div>
 

      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 
  
</div>
<!-- Fin container -->
<footer class="footer">
  <div class="container"> <span class="text-muted">
    <p>Test Prueba Junior <a href="https://www.brm.com.co/" target="_blank">Creado para BRM</a></p>
    </span> </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<script src="dist/js/bootstrap.min.js"></script> 
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
