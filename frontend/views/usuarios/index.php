<?php
use yii\helpers\Html;
use frontend\views\usuarios;



 if(Yii::$app->user->identity->admin > 0):
require '../../common/config/mysqli.config.php';
?>
<head>
  <script type="text/javascript">
    document.title = 'GRAYAP | Usuarios';
  </script>


</head>
<?php
if(!empty($getKey)):
  switch ($getKey):
    case 'userEdit':
      $userdata = $mysqli->query("SELECT * FROM ga_nutriologo WHERE id='{$getValue}' LIMIT 1");
      $userdata = $userdata->fetch_assoc();

    ?>
    <form id="formEdit" action="http://nutriologadelgado.com/frontend/web/action2.php" method="POST" class="col-md-4" enctype="multipart/form-data">      
      <div class="form-group">        
        <input type="hidden" id="userEdit_id" name="id" value="<?php echo $userdata['id'];?>" >
        <label for="nombre">Nombre(s): </label>
        <input type="text" id="userEdit_nombres" name="nombre" value="<?php echo $userdata['nombres'];?>" class="form-control" required autofocus/>
      </div>
      <div class="form-group">
        <label for="nombre">Apellido(s): </label>
        <input type="text" id="userEdit_apellidos" name="apellido" value="<?php echo $userdata['apellidos'];?>" class="form-control" required/>   
      </div>
      <div class="form-group">
        <label for="nombre">Email: </label>
        <input type="email" id="userEdit_email" name="email" value="<?php echo $userdata['email'];?>" class="form-control" required/>    
      </div>
      <div class=form-group>
        <label for="nombre">Genero: </label>
        <select id="userEdit_sexo" name="sexo" class="form-control">
          <?php
            $genero = $userdata['sexo'];

            if($genero == 0):
              $options = '
              <option value="0">Mujer</option>
              <option value="1">Hombre</option>
              ';
            elseif($genero == 1):
              $options = '
              <option value="1">Hombre</option>
              <option value="0">Mujer</option>
              ';
            endif;

            echo $options;
           ?>

          </select>      
      </div>
      <div class="form-group">
        <label for="nombre">Nueva contraseña: </label>
        <input type="password" id="userEdit_password" name="password" value="" class="form-control"/>
      </div>
      
      <div class="form-group">
        <label for="imagenUpdate">Actualizar Foto:</label>
        <input type="file" id="imagenUpdate" name="imagen" class="form-control"/>
      </div>
      
      <div class="form-group">
        <a href="/frontend/web/usuarios" class="btn btn-danger">Regresar</a> <input type="submit"  name="Modificar" value="Actualizar" class="btn btn-success">
      </div>
    </form>
      <script>

        function updateProfile(){
          var id = $("#userEdit_id").val();
          var nombres = $("#userEdit_nombres").val();
          var apellidos = $("#userEdit_apellidos").val();
          var email = $("#userEdit_email").val();
          var sexo = $("#userEdit_sexo").val();
          var password = $("#userEdit_password").val();
          var generatePasswordHash = 'none';
          

          if(password !== "")
          {
              $.ajax({
                url:'/frontend/web/getPass.php',
                type:'GET',
                dataType:'json',
                data:{'hash':password},
                success: function(data){
                  generatePasswordHash = data.hash;
                  changePassword(id,nombres,apellidos,email,sexo,generatePasswordHash);
                }
              });
          }
          else
          {
            changePassword(id,nombres,apellidos,email,sexo,generatePasswordHash);
          }
        }

        function changePassword(id,nombres,apellidos,email,sexo,pw)
        {
          var datamin = id + ';' + nombres + ';' + apellidos + ';' + email + ';' + sexo + ';' + pw;
          $.ajax({
            url:'http://nutriologadelgado.com/frontend/web/action.php',
            type:'GET',
            dataType:'json',
            data:{'update':datamin},
            success: function(datas){
              alert(datas.response);
                window.location ="http://www.nutriologadelgado.com/frontend/web/usuarios";
            }
          });

        }
      </script>
<?php break; case 'agregar':?>
<form id="formAdd" action="http://nutriologadelgado.com/frontend/web/action2.php" method="POST" class="col-md-4" enctype="multipart/form-data">
  <div class="form-group">     
    <label for="nombre">Nombre(s): </label>
    <input type="text" id="userAdd_nombres" name="nombre" value="" class="form-control" required autofocus />
  </div>
  <div class="form-group"> 
    <label for="nombre">Apellido(s): </label>
    <input type="text" id="userAdd_apellidos" name="apellido" value="" class="form-control" required/>
  </div>
  <div class="form-group"> 
    <label for="nombre">Email: </label>
    <input type="email" id="userAdd_email" name="email" value="" class="form-control" required/>
  </div>
  <div class="form-group"> 
    <label for="nombre">Genero: </label>
    <select class="form-control" id="userAdd_sexo" name="sexo" >
      <option value="1">Hombre</option>
      <option value="0">Mujer</option>
    </select>
  </div>
  <div class="form-group"> 
    <label for="nombre">Contraseña: </label>
    <input type="password" id="userAdd_password" name="password" value="" class="form-control" required/>
  </div>
  
  <div class="form-group">
    <label for="imagen">Foto de Perfil:</label>
    <input type="file" id="file" name="imagen" class="form-control"/>
  </div>
  
  <div class="form-group"> 
   <a href="/frontend/web/usuarios" class="btn btn-danger">Regresar</a> <input type="submit" name="Agregar" value="Agregar" class="btn btn-success">
  </div>
</form>

<script type="text/javascript">
function addProfile()
{
    var nombres = $("#userAdd_nombres").val();
    var apellidos = $("#userAdd_apellidos").val();
    var email = $("#userAdd_email").val();
    var sexo = $("#userAdd_sexo").val();    
    var password = $("#userAdd_password").val();
    var generatePasswordHash = '';

    $.ajax({
            url:'/frontend/web/getPass.php',
            type:'GET',
            dataType:'json',
            data:{'hash':password},
            success: function(data)
            {

              generatePasswordHash = data.hash;
              var datamin =  nombres + ';' + apellidos + ';' + email + ';' + sexo  +';' + generatePasswordHash;
              $.ajax({
                      url:'http://nutriologadelgado.com/frontend/web/action.php',
                      type:'GET',
                      dataType:'json',
                      data:{'insert':datamin},
                      success: function(datas)
                      {
                          alert(datas.response);
                      }
                    });
            }
          });

}
</script>

<?php break; default:  echo "Error! Script no encontrado(index)";  break; endswitch; else: ?>

  <style>
  
    table {
      background-color: white;
      border-collapse: collapse;
      border:1px solid #F2F2F2;
      margin-top:30px;
    }
    th {
      padding: 15px;
    }
    td {
      padding-left: 15px;
      padding-top: 10px;
      padding-bottom: 10px;
    }
    tr {
      text-align: center;
    }
    .gray {
      background-color: #E6E6E6;
    }
    .lightgray {
      background-color: #F2F2F2;
    }
    .pos-left {
      text-align: right;
    }

  </style>
<section class="content-header">
  <h1>Usuarios</h1>
  </br>
  <ul class="breadcrumb">
    <li><a href="/">Inicio</a></li>
    <li><i class="fa fa-user"></i> Usuarios</li>
  </ul>
  
  <a href="?agregar" class="btn btn-success"><i class="fa fa-plus"></i> Agregar Usuario</a>  
<table id="prueba">
  <tbody>
    <tr>
      <th>Nombre</th>
      <th>Control</th>
      <th>Editar</th>
      <th>Eliminar</th>
    </tr>
<?php

  $users = $mysqli->query("SELECT * FROM ga_nutriologo WHERE enable = 1");
  $i = 0;

  while($usersData = $users->fetch_assoc()):

    if($i == 0):
       $color = "gray";
       $i++;
    else:
      $color = "lightgray";
      $i--;
    endif;

    $checked = ($usersData['admin'] > 0) ? "checked='checked'" : '';
    $nombres = $usersData['nombres'];
    $apellidos = $usersData['apellidos'];
    $userid = $usersData['id'];
    echo "<tr id='table$userid' class='$color'>
      <td class='pos-left'>$nombres $apellidos</td>
      <td><input type='checkbox' id='$userid' $checked onclick='actionAdmin(this);'/></td>
      <td><a href='?userEdit=$userid'><span class='glyphicon glyphicon-pencil'></span></a></td>
      <td><a href='#' id='$userid' class='user$userid' value='$nombres $apellidos' onclick='deleteUser(this);'><span class='glyphicon glyphicon-trash'></span></a></td>
    </tr>";
  endwhile;
?>
  </tbody>
</table>

</section>
<script>
  function userCheck(userid){

    myid = '<?php echo Yii::$app->user->identity->id; ?>';
    if(myid == userid){
      alert('No es posible realizar esta acción!');
      return false;
    }
    else {
      return true;
    }
  }
  function actionAdmin(div){
    if(userCheck(div.id)){
      if(div.checked == true){
        $.ajax("http://nutriologadelgado.com/frontend/web/action.php?control=" + div.id + ";1");
        alert('Autorización concedida con éxito!');
      }else {
        $.ajax("http://nutriologadelgado.com/frontend/web/action.php?control=" + div.id + ";0");
        alert('Autorización retirada con éxito!');
      }
    }
    else{
      div.checked = true;
    }
  }

  function deleteUser(div){
    if(userCheck(div.id)){
      nombre = $(".user" + div.id).attr('value');
      if(confirm('¿Está seguro que desea eliminar a ' + nombre + '?')) {
        $.ajax("http://nutriologadelgado.com/frontend/web/action.php?delete=" + div.id);
        //$("#table" + div.id).fadeOut();
        window.location ="http://www.nutriologadelgado.com/frontend/web/usuarios";
      }
    }
  }

</script>
<?php endif; else: echo '<h1>Acceso denegado!'; endif; ?>
