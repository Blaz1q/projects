<?php
function czyzalogowany(){
    echo "<a href='index.php'>Strona Główna</a>";
    echo "<a href='produkty.php'>Produkty</a>";
    if(isset($_SESSION['login'])){
        echo "<a href='koszyk.php'>Koszyk</a>";
        echo "<a href='wyloguj.php'>zalogowano jako: ".$_SESSION['login']."</a>";
    } //wypisanie użytkownika
    else{
        echo '<a href="login.php">Logowanie</a>';
    }//jeśli użytkownik nie jest zalogowany wypisuje stronę loginu
}
function getitems($number,$check){
      $conn = mysqli_connect("localhost","root","","baza_sklep");
      if(!$conn) die(mysqli_connect_error());
      else{
        if($number==0)
            $zap = "SELECT DISTINCT(id),text,zdj FROM produkty";
        else
            $zap = "SELECT DISTINCT(id),text,zdj FROM produkty ORDER BY RAND() LIMIT ".$number;
        $res = mysqli_query($conn,$zap);
        while($row=mysqli_fetch_array($res)){
        echo "<div class='grid-item'>";
        if (file_exists('./imgs/'.$row['zdj']))
        echo "<div class='zdj' style='background-image:url(./imgs/".$row['zdj'].");' name='".$row['zdj']."'>";
        else{
            echo "<div class='zdj' name='".$row['zdj']."'>";
        }
        if($check==true)
        echo "<input type='checkbox' class='abs' name='checkboxarr[]' value='".$row['id']."'/>";
        echo "</div>";
        echo "<div class='text'>".$row['text']."</div>";
        echo "</div>";
        }
    }
    mysqli_close($conn);
}//pobiera produkty z bazy danych i wyświetla
function getitemsv2(){
    $conn = mysqli_connect("localhost","root","","baza_sklep");
        if(!$conn) die(mysqli_connect_error());
        else{
            $zap = "SELECT id,text FROM produkty";
            $res = mysqli_query($conn,$zap);
            while($row = mysqli_fetch_array($res)){
                echo "<option value='".$row['id']."'>".$row['text']."</option>";
            }
    }
    mysqli_close($conn);
}
function kategoria(){
    $conn = mysqli_connect("localhost","root","","baza_sklep");
    if(!$conn) die(mysqli_connect_error());
    else{
    $zap = "SELECT DISTINCT kategoria FROM produkty";
    $res = mysqli_query($conn,$zap);
    while($row=mysqli_fetch_array($res)){
        echo "<option value='".$row['kategoria']."'>".$row['kategoria']."</option>";
        }
    }
    mysqli_close($conn);
}//pobiera do <select> kategorie
function selectkategoria(){
    $kat = $_POST['kategoria'] ?? null;
    if($kat==null){
        if(!isset($_SESSION['login']))
            getitems(0,false);
        else getitems(0,true);
        
    }//zabezpieczenie
    else{
        $conn = mysqli_connect("localhost","root","","baza_sklep");
        if(!$conn) die(mysqli_connect_error());
        else{
        $zap = "SELECT * FROM produkty WHERE kategoria = '".$kat."'";
        $res = mysqli_query($conn,$zap);
        if(!$res||$kat=='null')
        if(isset($_SESSION['login']))
            getitems(0,true);
        else{
            getitems(0,false);
        }
        else{
            while($row=mysqli_fetch_array($res)){
                echo "<div class='grid-item'>";
                echo "<div class='zdj' style='background-image:url(./imgs/".$row['zdj'].")' name='".$row['zdj']."'>"."</div>";
                //echo "<div class='zdj' style='background-color: #fab;' name='".$row['zdj']."'>"."</div>";
                echo "<div class='text'>".$row['text']."</div>";
                echo "</div>";
                }
            }
        }
        mysqli_close($conn);
    }
}//po wybraniu kategori wyświetla tylko te produkty
function czyistnieje($login){
    $login = $_POST['login'] ?? null;
    if($login!=null){
        $conn = mysqli_connect("localhost","root","","baza_sklep");
        if(!$conn) die(mysqli_connect_error());
        else{
            $zap = "SELECT nazwa FROM uzytkowicy WHERE nazwa = '".$login."'";
            $res = mysqli_query($conn,$zap);
            if(!$res) return false;
            else return true;
        }
        mysqli_close($conn);
    }
}// sprawdza czy istnieje login
function zarejestruj(){
        $login = $_POST['login'] ?? null;
        $haslo = $_POST['haslo'] ?? null;
        $phaslo = $_POST['phaslo'] ?? null;
        if($login==null&&$haslo==null&&$phaslo==null){
            //nic
        }
        else if($login==null)
            echo "<h6>nie podano loginu</h6";
        else if($haslo==null)
            echo "<h6>nie podano hasła</h6>";
        else if($phaslo==null||$phaslo!=$haslo)
            echo "<h6>hasła nie są takie same!</h6>";
        else{
            $conn = mysqli_connect("localhost","root","","baza_sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
            if(czyistnieje($login)==false){ //jeśli login nie istnieje można stworzyć użytkownika
                $zap = "INSERT INTO uzytkownicy VALUES ('$login',0,'$haslo');";
                $res = mysqli_query($conn,$zap);
            if($res){
                echo "<h6>rejestracja udana!</h6>";
                echo "<a href='login.php'>zaloguj</a>";
                }
            else
                echo "<h6>coś poszło nie tak</h6>";
            }
            mysqli_close($conn);
        }
    }
}//dodaje uzytkownika
function dodajprzedmiot(){
    $nazwa = $_POST['produkt'] ?? null;
    $opis = $_POST['opis'] ?? null;
    $zdj = $_POST['zdj'] ?? null;
    $kat = $_POST['kat'] ?? null;
    if($nazwa==null||$opis==null||$zdj==null||$kat==null){

    }
    else{
        $conn = mysqli_connect("localhost","root","","baza_sklep");
        if(!$conn) die(mysqli_connect_error());
        else{
        $zap = "INSERT INTO produkty VALUES(NULL,'$nazwa','$zdj','$opis','$kat');";
        $res = mysqli_query($conn,$zap);
        if($res) echo "<h5>dodano</h5>";
        }
        mysqli_close($conn);
    }
}//dodaje przedmiot -- tylko dostępne dla admina
function usunprzedmiot(){
    $id = $_POST['delete'] ?? null;
    if($id==null){

    }//nic
    $conn = mysqli_connect("localhost","root","","baza_sklep");
    if(!$conn) die(mysqli_connect_error());
    else{
    $zap = "DELETE FROM produkty WHERE id =".$id;
    $res = mysqli_query($conn,$zap);
    if($res) echo "<h5>usunięto</h5>";
    }
    mysqli_close($conn);
}//usuwa przedmiot -- tylko admin
function selectuzytkownicy(){
    $conn = mysqli_connect("localhost","root","","baza_sklep");
        if(!$conn) die(mysqli_connect_error());
        else{
            $zap = "SELECT nazwa,uprawnienia FROM uzytkownicy;";
            $res = mysqli_query($conn,$zap);
            echo "<table>";
            echo "<tr><th>Użytkownicy</th></tr>";
            while($row = mysqli_fetch_array($res)){
                echo "<tr>";
                echo "<td><p>".$row['nazwa']."</p></td>";
                if($row['uprawnienia']==0||$_SESSION['login']==$row['nazwa']) echo "<td><input type='radio' name='arr[".$row['nazwa']."]' value='0' disabled /></td>";
                else echo "<td><input type='radio' name='arr[".$row['nazwa']."]' value='0' /></td>";
                if($row['uprawnienia']==1) echo "<td><input type='radio' name='arr[".$row['nazwa']."]' value='1' disabled /></td>";
                else echo "<td><input type='radio' name='arr[".$row['nazwa']."]' value='1'/></td>";
                echo "<td><input type='reset' value='reset' /></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        mysqli_close($conn);
}//pobiera uzytkowników by zmienić uprawnienia --tylko dostępne dla admina
function dodajadmin(){
    $arr = array();
    $arr = $_POST['arr'] ?? null;
    if(!$arr){

    }
    else{
        $key = array_keys($arr);
        foreach($key as $value){
            $conn = mysqli_connect("localhost","root","","baza_sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
                $zap = "UPDATE uzytkownicy SET uprawnienia = ".$arr[$value]." WHERE nazwa = '".$value."';";
                $res = mysqli_query($conn,$zap);
            }
            mysqli_close($conn);
        }
        header("Location:dodaj.php");
    }
}//dodaje damina
function dodajkoszyk(){
    $arr = array();
    $arr = @$_POST['checkboxarr'];
    if($arr){
        foreach($arr as $val)
        {
            array_push($_SESSION['koszyk'],$val);
        }
    }
}//dodaje do koszyka produkty, mogą się powtarzać
function getkoszykitems($arr){
    if(!$arr){
        echo "<h1>Twój koszyk jest pusty!</h1>";
    }//nic
    else{
        $conn = mysqli_connect("localhost","root","","baza_sklep");
        if(!$conn) die(mysqli_connect_error());
        else{
            foreach($arr as $val){
                $zap = "SELECT id,text,zdj FROM produkty WHERE id = ".$val;
                $res = mysqli_query($conn,$zap);
                while($row=mysqli_fetch_array($res)){
                echo "<div class='grid-item'>";
                if (file_exists('./imgs/'.$row['zdj']))
                echo "<div class='zdj' style='background-image:url(./imgs/".$row['zdj'].");' name='".$row['zdj']."'>";
                else
                echo "<div class='zdj' name='".$row['zdj']."'>";
                echo "</div>";
                echo "<div class='text'>".$row['text']."</div>";
                echo "</div>";
                }
            }
        }
        mysqli_close($conn);
    }
}//wyświetla przedmioty w koszyku
function dodajstr($str1, $str2) {
    $str1 .=$str2;
    return $str1;
}
function zamow(){
    $imie = $_POST['imie'] ?? null;
    $nazwisko = $_POST['nazwisko'] ?? null;
    $adres = $_POST['adres'] ?? null;
    $miasto = $_POST['miasto'] ?? null;
    $kodpocz = $_POST['kodpocz'] ?? null;
    $email = $_POST['email'] ?? null;
    if($imie==null||$nazwisko==null||$adres==null||$miasto==null||$kodpocz==null||$email==null){
        //nic
    }
    else{
    $conn = mysqli_connect("localhost","root","","baza_sklep");
      if(!$conn) die(mysqli_connect_error());
      else{
        if(!$_SESSION['koszyk']){

        }//nie można zamówić pustego koszyka
        else{
          $textt = "";
            foreach($_SESSION['koszyk'] as $val){
                $strr = strval($val);
                $strr .= ",";
                $textt =  dodajstr($textt,$strr);
            }
            $zap = "INSERT INTO zamowienia VALUES ('NULL','$imie','$nazwisko','$adres','$miasto','$kodpocz','$email','$textt')";
            $res = mysqli_query($conn,$zap);
            if($res) {echo "<h3>Dziękujemy za zakupy w naszym sklepie!</h3>"; unset($_SESSION["koszyk"]);}
            else{
                echo "<h3>coś poszło nie tak..</h3>";
            }
        }
      }
    }
}//dodaje to tabeli zamowienia wszystkie wartosci pobrane z formularza
?>