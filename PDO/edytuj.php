<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Projekt PDO</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
    function uprawnienia(){
        if(isset($_POST['user'])){
            if($_POST['user']!="admin") header("Location:index.php");
        }
    }
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
    function zab(){
        if(isset($_SESSION['user'])&&isset($_POST['ide'])){
            if($_SESSION['user']=="user"||$_SESSION['user']=="admin"){ 
                return true;
            }
        }
        return false;
    }
    function conn(){
        if(zab()==true){
                try{
                $pdo = new PDO('mysql:host=localhost;dbname=sklep','root','');
                if($pdo) conslog("'Connected'");
                    if($_POST['tabela']=="przedmioty"){
                    $zap = $pdo->prepare("SELECT produkty.ID,firma.firma_nazwa,sklep.sklep_nazwa,produkty_szczegoly.produkt_nazwa,cena,ilosc,produkty.KOD FROM produkty_szczegoly INNER JOIN produkty ON produkty_szczegoly.KOD = produkty.KOD INNER JOIN sklep ON produkty_szczegoly.sklep_ID = sklep.ID INNER JOIN firma ON produkty_szczegoly.firma_ID = firma.ID WHERE produkty.ID =?");
                    $zap2 = "SELECT firma.ID,firma.firma_nazwa FROM firma;";
                    $zap3 = "SELECT sklep.ID,sklep.sklep_nazwa FROM sklep;";
                    
                    echo "<input type='hidden' name='tabela' value='Produkty' />";
                    echo "<table>";
                    echo "<tr><th>ID</th>\n<th>Firma</th>\n<th>Sklep</th>\n<th>Nazwa</th>\n<th>Cena [pln]</th>\n<th>Ilość [szt]</th>\n<th>KOD</th>\n";
                    if($_SESSION['user']=="admin") echo "<th colspan=2 style='background-color: var(--color6);'>Admin</th>";
                    echo "</tr>";
                    $zap->execute([$_POST['ide']]); //id edycji [ide]
                    $row = $zap->fetchAll();
                    $row2 = $pdo->query($zap2)->fetchAll();
                    $row3 = $pdo->query($zap3)->fetchAll();
                    text($row,$row2,$row3);
                    echo "</table>";
                    }
                    if($_POST['tabela']=="firma"){
                        echo "<form action='zmien.php' method='POST' >";
                        echo "<input type='hidden' name='tabela' value='firma'>";
                        echo "<input type='hidden' name='IDZ' value={$_POST['ide']} />";
                        $zap = $pdo->prepare("SELECT * FROM firma WHERE ID = ?");
                        $zap->execute([$_POST['ide']]); //id edycji [ide]
                        $row = $zap->fetchAll();
                        echo "<table>";
                            echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>Firma</th>";
                                echo "<th>Miejsce</th>";
                                if($_SESSION['user']=="admin") echo "<th colspan=2 style='background-color: var(--color6);'>Admin</th>";
                            echo "</tr>";
                            echo "<tr>"; 
                                foreach($row as $val){
                                    echo "<td>{$val[0]}</td>";
                                    echo "<td><input type='text' placeholder={$val[1]} name='nazwa' /></td>";
                                    echo "<td><input type='text' placeholder={$val[2]} name='miejsce' /></td>";
                                    if($_SESSION['user']=="admin") echo "<td class='admin'><input type='submit' name='akcja' value='zmien' /></td><td class='admin'><input name='akcja' type='submit' value='kasuj' /></td>";
                                }                        
                            echo "</tr>";
                        echo "</table>";
                        echo "</form>";
                    }
                    if($_POST['tabela']=="sklep"){
                        echo "<form action='zmien.php' method='POST' >";
                        echo "<input type='hidden' name='tabela' value='sklep'>";
                        echo "<input type='hidden' name='IDZ' value={$_POST['ide']} />";
                        $zap = $pdo->prepare("SELECT * FROM sklep WHERE ID = ?");
                        $zap->execute([$_POST['ide']]); //id edycji [ide]
                        $row = $zap->fetchAll();
                        echo "<table>";
                            echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>Firma</th>";
                                echo "<th>Miejsce</th>";
                                if($_SESSION['user']=="admin") echo "<th colspan=2 style='background-color: var(--color6);'>Admin</th>";
                            echo "</tr>";
                            echo "<tr>"; 
                                foreach($row as $val){
                                    echo "<td>{$val[0]}</td>";
                                    echo "<td><input type='text' placeholder={$val[1]} name='nazwa' /></td>";
                                    echo "<td><input type='text' placeholder={$val[2]} name='miejsce' /></td>";
                                    if($_SESSION['user']=="admin") echo "<td class='admin'><input type='submit' name='akcja' value='zmien' /></td><td class='admin'><input name='akcja' type='submit' value='kasuj' /></td>";
                                }                        
                            echo "</tr>";
                        echo "</table>";
                        echo "</form>";
                    }
                    $pdo = null; //zamknięcie
                } catch(PDOException $e){
                    $msg = "error: ".$e->getMessage();
                    echo $msg;
                    die();
                }
            }
        }
    function text($row,$row2,$row3){
        foreach($row as $val){
            echo "<tr>";
            echo "<form action='zmien.php' method='POST'>";
            echo "<td>".$val[0]."</td>";
            echo "<td><select name='ID_Firmy'/>";
            foreach($row2 as $val2) echo "<option value={$val2[0]}>{$val2[1]}</option>";
            echo "</select></td>";
            echo "<td><select name='ID_Sklepu'/>";
            foreach($row3 as $val3) echo "<option value={$val3[0]}>{$val3[1]}</option>";
            echo "</select></td>";
            echo "<td><input type='text' name='Item' placeholder='{$val[3]}' required /></td>";
            echo "<td><input type='number' name='Cena' step='0.01' placeholder={$val[4]} required /></td>";
            echo "<td><input type='number' name='Ilosc' placeholder={$val[5]} required /></td>";
            echo "<td>".$val[6]."</td>";
            echo "<input type='hidden' name='IDZ' value={$_POST['ide']} />";
            echo "<input type='hidden' name='KOD' value={$val[6]} />";
            if($_SESSION['user']=="admin") echo "<td class='admin'><input type='submit' name='akcja' value='zmien' /><td class='admin'></form><form action='zmien.php' method='POST'><input name='akcja' type='submit' value='kasuj' /><input type='hidden' name='tabela' value='Produkty' /><input type='hidden' name='KOD' value={$val[6]} /></form></td>";
            echo "</tr>";
    }
}
    function main(){
        session_start();
        uprawnienia();
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