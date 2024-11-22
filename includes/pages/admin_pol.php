<?
if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}?>
<div class="user_admin" id="table_user">

<form method="POST" name="search" id="ww">
    <input type="text" name="name" placeholder="введите запрос">
    <input type="submit" name="search" value="найти" class="ree">
</form>

<?php


if (isset($_POST['search'])) {
   
   $searchName = $_POST['name'];
   $searchName = $link->quote("%$searchName%"); 
   $sql .= " AND `surname` LIKE $searchName";
}
?>

<table class="panel-table adaptive-table">
<thead>
    <tr>
       
        <th>Фамилия</th>
        <th>Имя</th>
        <th>ID</th>
        <th>Группа</th>
        <th>Роль</th>
        <th>Действия</th>
    </tr>
</thead>

<tbody>


<?php 
$sql="SELECT * FROM `user` " ;

$result = $link->query($sql);
if ($result && $result->rowCount() > 0)

foreach($result as $user){?>



    <tr>
      
        <td  data-label="фамилия"><?=$user['name']?></td>
        <td  data-label="Имя"><?=$user['surname']?></td>
        <td  data-label="id"><?=$user['id']?></td>
        <td  data-label="группа"><?=$user['student_group']?></td>
        <?php 
        if($user['role']==1){
            echo ' <td  data-label="роль">Студент</td>';
        } elseif($user['role']==2){
            echo ' <td  data-label="роль">админ</td>';
        }elseif($user['role']==0){
            echo ' <td  data-label="роль">в блоке</td>';
        }elseif($user['role']==3){
            echo ' <td  data-label="роль">препод</td>';
        }
        
        
        ?>
      
        <td   data-label="Действия">
            <div class="icons_pan">
                
                <a href="?page=red_user&id=<?=$user['id']?>"><img src="assets/img/edit.png" alt="del"></a>
                <a href="?page=admin_kontent&id=<?=$user['id']?>&block"><img src="assets/img/del.png" alt="red"></a>
               
            </div>
        </td>

    </tr>

  <?}?>

  <?php 

  if(isset($_GET['block'])){
    $id=$_GET['id'];
    $sql="UPDATE  user SET `role`=0 WHERE id='$id'";
    $link->query($sql);
   
  }
  
  
  
  
  ?>
  

</tbody>
</table>

         





</div>

