<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Projekt PDO</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
    function conslog($text){
        echo "<script>console.log(".$text.")</script>\n";
    }
    function getSession(){
        if(isset($_SESSION['user'])){
            conslog("'".$_SESSION['user']."'");
        }
        else{
            conslog("'Sesja nie istnieje'");
        }
    }
    function conn(){
        if(isset($_SESSION['user'])){
            if($_SESSION['user']=="user"||$_SESSION['user']=="admin"){ 
                try{
                $pdo = new PDO('mysql:host=localhost;dbname=sklep','root','');
                if($pdo) conslog("'Connected'");
                    if($_SESSION['user']=="admin") $i=8;
                    else $i=7;
                    $zap = "SELECT produkty.ID,firma.firma_nazwa,sklep.sklep_nazwa,produkty_szczegoly.produkt_nazwa,cena,ilosc,produkty.KOD FROM produkty_szczegoly INNER JOIN produkty ON produkty_szczegoly.KOD = produkty.KOD INNER JOIN sklep ON produkty_szczegoly.sklep_ID = sklep.ID INNER JOIN firma ON produkty_szczegoly.firma_ID = firma.ID";
                    $zap2 = "SELECT firma.ID,firma.firma_nazwa FROM firma;";
                    $zap3 = "SELECT sklep.ID,sklep.sklep_nazwa FROM sklep;";
                    $row = $pdo->query($zap)->fetchAll();
                    $row2 = $pdo->query($zap2)->fetchAll();
                    $row3 = $pdo->query($zap3)->fetchAll();
                    produkty($row,$row2,$row3,$i);
                    firmy($pdo);
                    sklepy($pdo);
                    co_dodano($pdo);
                    $pdo = null; //zamknięcie
                } catch(PDOException $e){
                    $msg = "error: ".$e->getMessage();
                    echo $msg;
                    die();
                }
            }
        }
    }
    function firmy($pdo){
        $zap = "SELECT * FROM firma;";
        $row = $pdo->query($zap)->fetchAll();
        $i=3;
        if($_SESSION['user']=="admin") $i=4;
        echo "<table>";
            echo "<tr>";
                echo "<th colspan={$i}>Firmy</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nazwa</th>";
                echo "<th>Adres</th>";
                if($i==4) echo "<th>Admin</th>";
            echo "</tr>";
            foreach($row as $val){
                echo "<tr>";
                echo "<form action='edytuj.php' method='POST'>";
                echo "<td>{$val[0]}</td>";
                echo "<td>{$val[1]}</td>";
                echo "<td>{$val[2]}</td>";
                if($_SESSION['user']=="admin") echo "<td class='admin'><input type='hidden' name='tabela' value='firma' /><input type='hidden' name='ide' value={$val[0]}><input type='submit' value='edytuj' ></td>";
                
                echo "</form>";
                echo "</tr>";
            }
            if($_SESSION['user']=="admin"){
                echo "<form action='dodaj.php' method='POST'>";
                    echo "<tr class='admin'>";
                        echo "<td>x</td>";
                        echo "<td><input type='text' name='Nazwa' placeholder='Nazwa' required /></td>";
                        echo "<td><input type='text' name='Miejsce' placeholder='Miejscowosc' required /></td>";
                        echo "<input type='hidden' name='tabela' value='firma' />";
                        echo "<td class='admin' ><input type='submit' value='dodaj' /></td>";
                    echo "</tr>";
                echo "</form>";
            }
        echo "</table>";
    }
    function sklepy($pdo){
        $zap = "SELECT * FROM sklep;";
        $row = $pdo->query($zap)->fetchAll();
        $i=3;
        if($_SESSION['user']=="admin") $i=4;
        echo "<table>";
            echo "<tr>";
                echo "<th colspan={$i}>Sklepy</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nazwa</th>";
                echo "<th>Adres</th>";
                if($i==4) echo "<th>Admin</th>";
            echo "</tr>";
            foreach($row as $val){
                echo "<tr>";
                echo "<form action='edytuj.php' method='POST'>";
                echo "<td>{$val[0]}</td>";
                echo "<td>{$val[1]}</td>";
                echo "<td>{$val[2]}</td>";
                if($_SESSION['user']=="admin") echo "<td class='admin'><input type='hidden' name='tabela' value='sklep' /><input type='hidden' name='ide' value={$val[0]}><input type='submit' value='edytuj' ></td>";
                
                echo "</form>";
                echo "</tr>";
            }
            if($_SESSION['user']=="admin"){
                echo "<form action='dodaj.php' method='POST'>";
                    echo "<tr class='admin'>";
                        echo "<td>x</td>";
                        echo "<td><input type='text' name='Nazwa' placeholder='Nazwa' required /></td>";
                        echo "<td><input type='text' name='Miejsce' placeholder='Miejscowosc' required /></td>";
                        echo "<input type='hidden' name='tabela' value='sklep' />";
                        echo "<td class='admin'><input type='submit' value='dodaj'  /></td>";
                    echo "</tr>";
                echo "</form>";
            }
        echo "</table>";
    }
    function produkty($row,$row2,$row3,$i){
        echo "<table>";
                    echo "<tr><th colspan={$i}>Produkty</th></tr>";
                    echo "<tr><th>ID</th>\n<th>Firma</th>\n<th>Sklep</th>\n<th>Nazwa</th>\n<th>Cena [pln]</th>\n<th>Ilość [szt]</th>\n<th>KOD</th>\n";
                    if($_SESSION['user']=="admin") echo "<th>Admin</th>";
                    echo "</tr>";
                    
                    foreach($row as $val){
                        if($_SESSION['user']=="admin") echo "<form action='edytuj.php' method='POST'>";
                            echo "<tr >";
                                echo "<td>".$val[0]."</td>";
                                echo "<td>".$val[1]."</td>";
                                echo "<td>".$val[2]."</td>";
                                echo "<td>".$val[3]."</td>";
                                echo "<td>".$val[4]."</td>";
                                echo "<td>".$val[5]."</td>";
                                echo "<td>".$val[6]."</td>";
                                if($_SESSION['user']=="admin") echo "<td class='admin'><input type='hidden' name='tabela' value='przedmioty' /><input type='hidden' name='ide' value={$val[0]} /><input type='submit' value='edytuj' ></td>";
                            echo "</tr>";
                        if($_SESSION['user']=="admin") echo "</form>";
                        
                            
                        
                    }
                    if($_SESSION['user']=="admin") {
                        echo "<tr class='admin'>";
                        echo "<td>x</td>";
                        echo "<form action='dodaj.php' method='POST'>";
                        echo "<td><select name='ID_Firmy'/>";
                        foreach($row2 as $val2) echo "<option value={$val2[0]}>{$val2[1]}</option>";
                        echo "</select></td>";
                        echo "<td><select name='ID_Sklepu'/>";
                        foreach($row3 as $val3) echo "<option value={$val3[0]}>{$val3[1]}</option>";
                        echo "</select></td>";
                        echo "<td><input type='text' name='Item' placeholder='Przedmiot' required /></td>";
                        echo "<td><input type='number' step='0.01' min='0' name='Cena' placeholder='Cena' required /></td>";
                        echo "<td><input type='number' name='Ilosc' min='0' placeholder='Ilość' required /></td>";
                        echo "<td>x</td>";
                        echo "<input type='hidden' name='tabela' value='produkty' />";
                        echo "<td class='admin'><input type='submit' value='dodaj' /></td></form>";
                        echo "</tr>";
                }
                    echo "</table>";
    }
    function co_dodano($pdo){
        $zap = $pdo->query("SELECT ID_dodania,ID_rzeczy FROM ostatnio_dodane ORDER BY ID DESC LIMIT 1");
        foreach($zap as $row){
        $IDD = $row[0];
        $IDR = $row[1];
        }
        switch($IDD){
            case 1: 
                $zap2 = "SELECT * FROM firma where ID = {$IDR}"; 
                $res = $pdo->query($zap2)->fetchAll();
                echo "<table>";
                echo "<tr><th colspan=3>Ostatnio dodane: Firma</th></tr>";
                echo "<tr>";
                foreach($res as $val){
                        echo "<td>{$val[0]}</td>";
                        echo "<td>{$val[1]}</td>";
                        echo "<td>{$val[2]}</td>";
                }
                echo "</tr>";
                echo "</table>";
                break;
            case 0: 
                $zap2 = "SELECT * FROM sklep where ID = {$IDR}"; 
                $res = $pdo->query($zap2)->fetchAll();
                echo "<table>";
                echo "<tr><th colspan=3>Ostatnio dodane: Sklep</th></tr>";
                echo "<tr>";
                foreach($res as $val){
                        echo "<td>{$val[0]}</td>";
                        echo "<td>{$val[1]}</td>";
                        echo "<td>{$val[2]}</td>";
                }
                echo "</tr>";
                echo "</table>";
            break;
            case 2: 
                $zap2 = "SELECT produkty.ID,firma.firma_nazwa,sklep.sklep_nazwa,produkty_szczegoly.produkt_nazwa,cena,ilosc,produkty.KOD FROM produkty_szczegoly INNER JOIN produkty ON produkty_szczegoly.KOD = produkty.KOD INNER JOIN sklep ON produkty_szczegoly.sklep_ID = sklep.ID INNER JOIN firma ON produkty_szczegoly.firma_ID = firma.ID where produkty.id = {$IDR}"; 
                $res = $pdo->query($zap2)->fetchAll();
                echo "<table>";
                echo "<tr><th colspan=7>Ostatnio dodane: Produkty</th></tr>";
                echo "<tr>";
                foreach($res as $val){
                        echo "<td>{$val[0]}</td>";
                        echo "<td>{$val[1]}</td>";
                        echo "<td>{$val[2]}</td>";
                        echo "<td>{$val[3]}</td>";
                        echo "<td>{$val[4]}</td>";
                        echo "<td>{$val[5]}</td>";
                        echo "<td>{$val[6]}</td>";
                }
                echo "</tr>";
                echo "</table>";
            break;
        }
        
        
        
    }
    function main(){
        session_start();
        getSession();
        conn();
    }
?>
<body>
    <div class="web-content">
        <nav>
            <a href="index.php">home</a>
            <a href="destroy.php">destroy</a>
            <a href="admin.php">admin</a>
            <a href="user.php">user</a>
        </nav>
        
        <section>
            <?php main();?>
        </section>
    </div>
</body>
</html>