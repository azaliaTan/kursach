<?php

if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}


?>

<div class="container">

<div class="p-class">
    <div class="panel">
        <p>панель администратора</p>
    </div>
    <div class="href_a">
       <a href="?page=admin" >заявки на публикацию</a>

        <a href="?page=admin_kontent" id="l">контент портала</a>
    </div>
</div>

<div class="admin_vkladki">
   <a href="?page=admin_kontent"><button class="tab">посты</button></a>
   <a href="?page=admin_kontent_otz"><button class="tab">отзывы</button></a>
    <a href="?page=admin_kontent_news"><button class="tab">новости</button></a>
    <a href="?page=admin_kontent_polz"><button class="tabb">пользователи</button></a>
    <a href="?page=admin_kontent_sob"><button class="tab">события</button></a>
</div>


<div class="user_admin" id="table_user">
<?php
$search=''; 
?>
<form method="POST" name="search" id="ww">
    <input type="text" name="name" placeholder="введите запрос" id="ew" value="<?=$search?>">
    <input type="submit" name="search" value="найти" class="ree">
</form>

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


if (isset($_GET['block']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = $link->quote($id); 
    $sql = "UPDATE `user` SET `role` = 0 WHERE id = $id";
    
    
$link->query($sql);
}


if (isset($_GET['unblock']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = $link->quote($id); 
    $sql = "UPDATE `user` SET `role` = 1 WHERE id = $id";
    
    
$link->query($sql);
}
    
    


   $limit = 10;
   $pages=isset($_GET['p']) ? (int) $_GET['p']:1;
   if($pages<1){
    $pages=1;
   }

   $offset=($pages-1) * $limit;
   $sql = "SELECT COUNT(*) FROM `user`";
   $rows=$link->query($sql)->fetchColumn();
   $total= ceil($rows/$limit);
  








    if (isset($_POST['search'])) {
        $searchName = $_POST['name'];
        $searchName = $link->quote("%$searchName%"); 
    
        $sql = "SELECT * FROM `user` WHERE `surname` LIKE $searchName 
                OR `name` LIKE $searchName 
                OR `id` LIKE $searchName 
                OR `student_group` LIKE $searchName 
                LIMIT $limit OFFSET $offset"; 
    } else {

        $sql = "SELECT * FROM `user` LIMIT $limit OFFSET $offset";
      
    }




$result = $link->query($sql);
if ($result && $result->rowCount() > 0) {
    foreach($result as $user) {
?>

    <tr>
        <td data-label="фамилия"><?=$user['surname']?></td>
        <td data-label="Имя"><?=$user['name']?></td>
        <td data-label="id"><?=$user['id']?></td>
        <td data-label="группа"><?=$user['student_group']?></td>
        <td data-label="роль">
            <?php 
            if($user['role'] == 1) {
                echo 'Студент';
            } elseif($user['role'] == 2) {
                echo 'Админ';
            } elseif($user['role'] == 0) {
                echo 'В блоке';
            } elseif($user['role'] == 3) {
                echo 'Преподаватель';
            }
            ?>
        </td>
        <td data-label="Действия">
            <div class="icons_pan">
                <a href="?page=red_user&id=<?=$user['id']?>"><img src="assets/img/edit.png" alt="Редактировать"></a>
                <?php 
if ($user['role'] == 0) {
    echo '<a href="?page=admin_kontent_polz&id=' . $user['id'] . '&unblock"><img src="assets/img/del.png" alt="Удалить"></a>';
} else {
    echo '<a href="?page=admin_kontent_polz&id=' . $user['id'] . '&block"><img src="assets/img/del.png" alt="Удалить"></a>';
}}
?>
            </div>
        </td>
    </tr>

<?php 
    
} else {
    echo "<tr><td colspan='6'>Пользователей не найдено</td></tr>";
}
?>



</tbody>
</table>


<div class="pagi">
<?php
  for($i=1; $i<=$total; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
      echo '<a href="?page=admin_kontent_polz&p='.$i.'">'.$i.'</a> '; 
    }
  }

?>
</div>
</div>
</div>