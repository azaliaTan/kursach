
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
<a href="?page=admin_kontent"> <button class="tab">посты</button>
   <a href="?page=admin_kontent_otz"><button class="tab">отзывы</button></a>
    <a href="?page=admin_kontent_news"><button class="tab">новости</button></a>
    <a href="?page=admin_kontent_polz"><button class="tab">пользователи</button></a>
    <a href="?page=admin_kontent_sob"><button class="tab">события</button></a>
</div>



<div class="sob_list" id="sob_list">
    <div class="sob">

    <?php 
   $limit = 6;
   $pages=isset($_GET['p']) ? (int) $_GET['p']:1;
   if($pages<1){
    $pages=1;
   }

   $offset=($pages-1) * $limit_post;
   $sql = "SELECT COUNT(*) FROM `sob`";
   $rows=$link->query($sql)->fetchColumn();
   $total= ceil($rows/$limit);
   ?>
        <?php 

        $sql="SELECT * FROM sob LIMIT $limit OFFSET $offset";
        $result=$link->query($sql);
        foreach($result as $sob){?>
            <div class="one_sob_l">
            <h5 class="hqw"><?=$sob['data']?></h5>
            <p><?=$sob['name']?></p>
            <div class="icons_pan_s">
                
                <a href="?page=red_sob&id=<?=$sob['id']?>">  <img src="assets/img/redd.png" alt="del"></a>
                <a href="#" onclick="confirmDelete(<?=$sob['id']?>); return false;"><img src="assets/img/delKR.png" alt="red"></a>
               
            </div>
        </div>
      <?  }
        ?>

                  

<?php 

if (isset($_GET['del'])) {
    $id = $_GET['id'];

    $id = intval($id); 
    $sql = "DELETE FROM sob WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent_sob"</script>';
    } else {
        echo 'Ошибка при удалении события.';
    }
}

?>



<script type="text/javascript">
function confirmDelete(sobId) {
    var confirmation = confirm("Вы уверены, что хотите удалить это событие?");
    if (confirmation) {
       
        window.location.href = "?page=admin_kontent_sob&id=" + sobId + "&del";
    }
}
</script>


      
        </div>

        <div class="pagi">
<?php
  for($i=1; $i<=$total; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
      echo '<a href="?page=admin_kontent_sob&p='.$i.'">'.$i.'</a> '; 
    }
  }
?>
</div>
       

    
<div class="new_add_b">
<a href="?page=add_sob"><button>добавить cобытие</button></a>
</div>
    </div>

    
</div>
