<?php
echo "<a href='index.php'>Strona Główna</a>";
      echo "<a href='produkty.php'>Produkty</a>";
      if(isset($_SESSION['uprawnienia'])){
        if($_SESSION['uprawnienia']==1){
          echo "<a href='dodaj.php'>Zarządzaj</a>";
        }
      }
      if(isset($_SESSION['login'])){
        echo "<a href='koszyk.php'>Koszyk</a>";
        echo "<a href='wyloguj.php'>zalogowano jako: ".$_SESSION['login']."</a>";
      } //wypisanie użytkownika
      else{
        echo '<a href="login.php">Logowanie</a>';
      }//jeśli użytkownik nie jest zalogowany wypisuje stronę loginu
?>