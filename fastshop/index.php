<?php session_start();?>
<!DOCTYPE html>
<html lang='pl'>
   <head>
     <title>FastShop</title>
     <meta charset='utf-8'>
     <link type='text/css' href='style.css' rel='stylesheet'>
     <script src='script.js'></script>
   </head>
   <?php
    include("funkcje.php");
   ?>
   <body>
     <div class="top">
      <div class="logo">
        <img src="./imgs/FastShop.svg" alt="FastShop" class='logo img'/>
      </div>
      <div class="top-item">
        <?php include('navbar.php');?>
      </div>
     </div>
     <div class="main">
         <div class="content">
           <h1>nasze oferty</h1>
           <div class="grid">
             <?php getitems(4,false); ?>
           </div>
            <div class='grid center'><a href='produkty.php' class='show-all'>Zobacz wszystko</a></div>
         </div>
         <hr>
     </div>
    </body>
</html>