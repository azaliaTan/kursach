


    <div class="container">
        <div class="news">
            <p class="Name">Новости</p>

           


            <div class="kategory">
                <p>Категории:</p>
                <a href="?page=news">показать все</a>
             <?php 
              $l = $link->query("SELECT * FROM cat_news")->fetchAll(PDO::FETCH_ASSOC);
              foreach($l as $lo){?>
           
           <a href="?page=news&kat=<?=$lo['id']?>"><?=$lo['name']?></a>

           <?}

             
             ?>
            </div>

            <div class="kat_mobile">
                <div class="form-group">
                    <label for="mySelect">Категория:</label>
                    <select id="mySelect" onchange="window.location.href=this.options[this.selectedIndex].value">
                        <option value="">выберите</option>
                       
                        <?php 
                         $l = $link->query("SELECT * FROM cat_news")->fetchAll(PDO::FETCH_ASSOC);
                         foreach($l as $lo){?>
                            <option value="?page=news&kat=<?=$lo['id']?>"><?=$lo['name']?></option>
                         <?}?>
                         <option value="?page=news">показать все</option>
              
                    
                    </select>
                </div>
            </div>

            <div class="news_block">

            <?php 
   $limit= 6;
   $pages=isset($_GET['p']) ? (int) $_GET['p']:1;
   if($pages<1){
    $pages=1;
   }

   $offset=($pages-1) * $limit;
   $sql = "SELECT COUNT(*) FROM `news`";
   $rows=$link->query($sql)->fetchColumn();
   $total= ceil($rows/$limit);
   ?>

           <?php 
$dop_sql = ''; 
if(isset($_GET['kat'])) {
    $get_id = $_GET['kat'];

    $sql = "SELECT * FROM cat_news WHERE id='$get_id'";
    $result = $link->query($sql);
    $temp_kat = $result->fetch();

    if($temp_kat != false) {
        $dop_sql = "WHERE kat_id='$get_id'"; 
    } else {
        echo '<script>document.location.href="?page=news"</script>'; 
    }
} 

$sql = "SELECT * FROM news $dop_sql LIMIT $limit OFFSET $offset";
$result = $link->query($sql)->fetchAll(PDO::FETCH_ASSOC);
               

              
                foreach($result as $new){?>

              
                <div class="new">
                    <img src="<?=$new['img']?>" alt="">
                    <div class="new_mobile">
                    <p><?=$new['name']?></p>
                    <a href="?page=one_news&id=<?=$new['id']?>">подробнее</a>
                    <?php 
                
                $id_cat = $new['kat_id'];
                $cat = $link->query("SELECT * FROM cat_news WHERE `id`='$id_cat'")->fetch(2);
               ?>
                    <a href="?page=one_news&id=<?=$new['id']?>"><button><?=$cat['name']?></button></a>
                </div>
                </div>


                    <?}



                    ?>

            </div>


            
<div class="pagi">
<?php
  for($i=1; $i<=$total; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
      echo '<a href="?page=news&p='.$i.'">'.$i.'</a> '; 
    }
  }
?>
</div>


        </div>
