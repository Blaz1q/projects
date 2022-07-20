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
     <div class="top no-color">
      <div class="logo">
      <img src="./imgs/FastShop.svg" alt="FastShop" class='logo img'/>
      </div>
      <div class="top-item">
        <?php include("navbar.php");?>
    </div>
     </div>
     <div class="main">
         <div class="content">
           <div class="grid login">
                <div class='grid-item center'>
                    <h2>rejestracja</h2>
                    <form method="POST" action="Rejestracja.php">
                    <input type="text" name='login' placeholder='login' />
                    <input type="password" name='haslo' placeholder='hasło' /><br>
                    <input type="password" name='phaslo' placeholder='powtórz hasło' /><br>
                    <input type="submit" value="zarejestruj" />
                    <?php zarejestruj(); ?>    
                    </form>
                    
                </div>
           </div>
         </div>
     </div>
    </body>
</html>