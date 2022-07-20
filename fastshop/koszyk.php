<?php session_start();?>
<?php
if(!isset($_SESSION['login'])){
    header("Location:index.php");
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
           <h1>Twój koszyk:</h1>
           <form action='koszyk.php' method='POST'>
           <div class="grid">
             <?php
                @getkoszykitems($_SESSION['koszyk']);
             ?>
           </div>
             </form>
           <h1>Zamów:</h1>
            <form action='koszyk.php' method='POST'>
            <div class='grid login'>
              <div class='grid-item center'>
                <input type="text" name="imie" placeholder='imie' />
                <input type="text" name="nazwisko" placeholder='nazwisko' />
                <input type="adress" name="adres" placeholder='adres' />
                <input type="text" name="miasto" placeholder='miasto' />
                <input type="text" name="kodpocz" placeholder='kod-pocztowy' />
                <input type="email" name="email" placeholder='email' /><br>
                <input type="submit" value="Zamów" />
              </div>
              <?php zamow();?>
            </div>
            </form>
         </div>
         <hr>
     </div>
    </body>
</html>