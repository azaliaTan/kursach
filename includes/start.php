
<div class="banner">
        <div class="text_banner">
            <p>онлайн-портал
            </p>
            <p>
                коммуникации </p>
                <div class="text">
                <p id="text1">студентов   <p id="text2">мцк-ктитс</p></p></div>
            <img src="assets/img/logoBOL.png" alt="">
        </div>

    </div>

    <div class="banner_2">
        <div class="banner_inner">
            <div class="text_inner">
            <p>Добро пожаловать на лучший  </p>
            <p id="tee">студенческий портал!</p>
        </div>
        <img src="assets/img/meg.png" alt="">
                  
        </div>

       
            <div class="banner_inner_two">
                <div class="text_inner_two">
                <p> Забудь о беспокойстве за данные, мы обеспечим 
                    полную безопасность и анонимность. 
                    Вся информация у тебя под рукой – 
                    оставайся в курсе и будь в центре студенческой жизни!</p>
            </div>

        <p id="tex">Делись. публикуй. обсуждай</p>
 
                      
            </div>

    </div>
    
    <div class="help_section">
        <p id="how"> как это работает?</p>
     
        <div class="text_help">
            <p>Здесь приоритеты ясны: безопасность, анонимность и удобство пользования </p>
            <p>Публикуй посты, участвуй в обсуждениях и находи единомышленников с лёгкостью</p>
            <p> Всё интуитивно и понятно – начни прямо сейчас и будь в центре событий!</p>
        </div>
        
        <div class="sec_1">

            <div class="sec_kart">
                <div class="img_sec">
                    <img src="assets/img/katVEC.png" alt="category">
                    <p>вечеринка</p>
                </div>

                <div class="text_sec">
                    <p id="zagolovok">ищу компанию сходить в кино </p>
                    <p id="opis">давно хотела сходить на дедпула или чужого, ищу с кем можно пойти</p>
                    <p id="more">подробнее...</p>
                    <p id="otkl">откликнуться!</p>
                </div>
            </div>

            <div class="sec_2">
                <p>все посты  разделены на категории: вечеринка, учеба, работа, поездка и т.д.
                </p>
                <p>выбирай категорию, читай описание события и жми  кнопку откликнуться!</p>
            </div>
        </div>

        <div class="sec_3">

            <div class="sec_kart">
                <div class="img_sec">
                    <img src="assets/img/katVEC.png" alt="category">
                    <p>вечеринка</p>
                </div>

                <div class="text_sec">
                    <p id="zagolovok">ищу компанию сходить в кино </p>
                    <p id="opis">давно хотела сходить на дедпула или чужого, ищу с кем можно пойти</p>
                    <p id="more">подробнее...</p>
                    <p id="otkl2">ура!</p>
                </div>
            </div>

            <div class="sec_2">
                <p>все посты  разделены на категории: вечеринка, учеба, работа, поездка и т.д.
                </p>
                <p>выбирай категорию, читай описание события и жми  кнопку откликнуться!</p>
            </div>
        </div>

         

    </div>
    </div>

    <div class="slider">
        <div class="container">
        <p id="slider_h">Важные новости</p>
        <div class="slider__body">
            <div class="slider__arrow left">
                <img src="assets/img/оы.png" alt="">
            </div>
            <div class="slider__images">
                <div class="slider__item active">

                    <img src="images\2581_n2347023_big.jpg" alt="#">
                    <div class="text_sl">
                      
                       
                    </div>
                </div>
                <div class="slider__item">
                    <img src="assets\img\845.jpg" alt="#">
                    <div class="text_sl">
                      
                     
                    </div>
                </div>
                <div class="slider__item">
                    <img src= "assets\img\ks.jpg" alt="#">
                    <div class="text_sl">
                        <!-- <h4>Экологическая инициатива</h4> -->
                        
                    </div>
                </div>
                <div class="slider__item">
                    <img src="assets\img\453.png" alt="#">
                    <div class="text_sl">
                       
                        
                    </div>
                </div>
                <div class="slider__item">
                    <img src="assets\img\34324242.png" alt="#">
                    <div class="text_sl">
                      
                       
                    </div>
                </div>
            </div>
            <div class="slider__arrow right">
                <img src="assets/img/оы.png" alt=""></div>
        </div>
        <div class="slider__nav">
            <div data-index="0" class="slider__dot active"></div>
            <div data-index="1" class="slider__dot"></div>
            <div data-index="2" class="slider__dot"></div>
            <div data-index="3" class="slider__dot"></div>
            <div data-index="4" class="slider__dot"></div>
        </div>

       <a href="?page=news"><p id="slider_hh">открыть все новости</p></a> 
    </div>
    </div>

    <div class="container" id="pagi">
        <p id="s">календарь событий</p>

        <div class="sob">

        <?php 
   $limit= 6;
   $pages=isset($_GET['p']) ? (int) $_GET['p']:1;
   if($pages<1){
    $pages=1;
   }

   $offset=($pages-1) * $limit;
   $sql = "SELECT COUNT(*) FROM `sob`";
   $rows=$link->query($sql)->fetchColumn();
   $total= ceil($rows/$limit);
   ?>
            <?php 

            $sql="SELECT * FROM sob LIMIT $limit OFFSET $offset";
            $result=$link->query($sql);
            foreach($result as $sob){?>
 <div class="one_sob" >
                <h5><?=$sob['data']?></h5>
                <p><?=$sob['name']?></p>
            </div>
           <? }

            
            
            
            ?>
           

            
        </div>

        <div class="pagi">
<?php
  for($i=1; $i<=$total; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
        echo '<a href="?&p=' . $i . '#pagi">' . $i . '</a> ';
    }
  }
?>
</div>


    </div>

 <script src="assets/js/slider.js"></script>