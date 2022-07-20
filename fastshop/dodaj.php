<?php session_start();?>
<?php
if(isset($_SESSION['uprawnienia'])){
    if($_SESSION['uprawnienia']!=1) header("Location:index.php");
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
           <div class="grid" style='grid-template-columns: repeat(3,1fr); gap: 1em;'>
                <div class='grid-item center'>
                    <h2>dodaj przedmiot</h2>
                    <form method="POST" action="dodaj.php">
                    <input type="text" name='produkt' placeholder='produkt_id' />
                    <input type="text" name='opis' placeholder='opis' /><br>
                    <input type="text" name='zdj' placeholder='zdj' /><br>
                    <input type="text" name='kat' placeholder='kategoria' /><br>
                    <input type="submit" value="dodaj" />
                    <?php dodajprzedmiot();?>
                    </form>
                </div>
                <div class='grid-item center'>
                    <h2>usuń przedmiot</h2>
                    <form action='dodaj.php' method='POST'>
                    <select name='delete'>
                    <?php getitemsv2();?>
                    </select>
                      <hr/>
                    <input type="submit" value="Usuń">
                    <?php usunprzedmiot();?>
                    </form>
                </div>
                <div class='grid-item center' style="height: fit-content;">
                    <h2>dodaj/odbierz</h2>
                    <h2>uprawnienia</h2>
                    <form method="POST" action="dodaj.php">
                    <?php selectuzytkownicy();?>
                    <input type="submit" class='center' value="Wykonaj" />
                    </form>
                    <?php dodajadmin();?>
                </div>
                
           </div>
        </div>
     </div>
    </body>
</html>