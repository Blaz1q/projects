<?php session_start();?>
<?php 
if(isset($_SESSION['login'])){
if(!@$_SESSION['koszyk']) $_SESSION['koszyk'] = array();
}
?>
<!DOCTYPE html>
<html lang='pl'>
   <head>
    <title>FastShop</title>
     <meta charset='utf-8'>
     <link type='text/css' href='style.css' rel='stylesheet'>
     <script src='script.js'></script>
   </head>
   <?php
    include ("funkcje.php");
   ?>
   <body>
     <div class="top">
      <div class="logo">
        <img src="./imgs/FastShop.svg" alt="FastShop" class='logo img'/>
      </div>
      <div class="top-item">
        <?php include ('navbar.php');?>
      </div>
     </div>
     <div class="main">
         <div class="content">
           <h1>Wszystkie oferty</h1>
           <?php
           if(!isset($_SESSION['login'])){
             echo "<h5><a href='login.php'>Zaloguj się</a> by dodać do koszyka!</h5>";
           }
           ?>
           
           <form action="produkty.php" method="POST">
           <fieldset style='width: fit-content;'>
           <legend>Sortuj</legend>
           <select name="kategoria" class='kategoria'>
               <option value='null'>wszystko</option>
               <?php kategoria();?>
           </select>
           <input type="submit" class='kategoria' value="Wybierz"/>
           </fieldset>
           </form>
           <form action="produkty.php" method="POST">
           <div class="grid" style="grid-template-columns: repeat(6,300px);">
             <?php selectkategoria(); ?>
           </div>
           <?php
           if(isset($_SESSION['login'])){
           echo "<input class='show-all grid center' style='margin-bottom: 1em;' type='submit' value='dodaj do koszyka' />"; 
           }
           ?>
           <?php dodajkoszyk();?>
          </div>
          </form>
         
     </div>
    </body>
</html>