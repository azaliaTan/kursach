<?php 

try{
$link=new PDO("mysql:host=localhost;dbname=portal",'root','root');
}catch(PDOException $e){
echo '$e';
}


?>