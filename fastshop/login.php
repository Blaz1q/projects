<?php
session_start();
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
      function uzytkownik(){
        $conn = mysqli_connect("localhost","root","","baza_sklep");
        if(!$conn) die(mysqli_connect_error());
        else{
          $login = $_POST['login'] ?? null;
          $haslo = $_POST['haslo'] ?? null;
          if($login==null||$haslo==null){
            
          }
          else{
            $zap = "SELECT nazwa,haslo,uprawnienia FROM uzytkownicy WHERE haslo='".$haslo."' AND nazwa='".$login."'";
            $res = mysqli_query($conn,$zap);
            if(!$res){
              header("Location:login.php");
            }
            else{
            while($row=mysqli_fetch_array($res)){
              $_SESSION['login'] = $row['nazwa'];
              $_SESSION['haslo'] = $row['haslo'];
              $_SESSION['uprawnienia'] = $row['uprawnienia'];
              $_SESSION['koszyk'] = array();
              header("Location:index.php");
            }
          }
          }
          mysqli_close($conn);
        }
      }
   ?>
   <body>
     <div class="top no-color">
      <div class="logo">
        <img src="./imgs/FastShop.svg" alt="FastShop" class='logo img'/>
      </div>
      <div class="top-item">
        <?php include('navbar.php');?>
      </div>
     <div class="main">
         <div class="content">
           <div class="grid login">
                <div class='grid-item center'>
                    <h2>Zaloguj</h2>
                    <form method="POST" action="login.php">
                    <input type="text" name='login' placeholder='login' />
                    <input type="password" name='haslo' placeholder='hasło' /><br>
                    <input type="submit" value="zaloguj" />
                    <h6 style='margin-top: 1em;'>Nie masz konta?</h6>
                    <a style='margin:auto;' href="rejestracja.php">Zajerestruj się</a>
                    </form>
                    <?php uzytkownik();?>
                </div>
           </div>
         </div>
     </div>
    </body>
</html>