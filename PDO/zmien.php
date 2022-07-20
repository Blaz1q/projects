<?php
session_start();
if((isset($_POST['KOD'])||isset($_POST['IDZ']))&&isset($_POST['akcja'])){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=sklep','root','');
        if($_POST['akcja']=="zmien"){
            if($_POST['tabela']=="Produkty"){
                $zap = $pdo->prepare("UPDATE produkty_szczegoly INNER JOIN produkty ON produkty_szczegoly.KOD = produkty.KOD SET produkt_nazwa = :nazwa_itemu, firma_ID = :ID_firmy, sklep_ID = :ID_Sklepu, cena= :Cena, ilosc=:Ilosc WHERE produkty.ID = :IDZ");
                $data = [
                    'nazwa_itemu' => $_POST['Item'],
                    'ID_firmy' => $_POST['ID_Firmy'],
                    'ID_Sklepu' => $_POST['ID_Sklepu'],
                    'Cena' => $_POST['Cena'],
                    'Ilosc' => $_POST['Ilosc'],
                    'IDZ' => $_POST['IDZ'], //ID_Zmiany
                ];
                $zap->execute($data);
            }
            if($_POST['tabela']=="firma"){
                $zap = $pdo->prepare("UPDATE firma SET firma_nazwa = :nazwa, miejsce = :miejsce WHERE ID = :IDZ");
                $data = [
                    'nazwa' => $_POST['nazwa'],
                    'miejsce' => $_POST['miejsce'],
                    'IDZ' => $_POST['IDZ'], //ID_Zmiany
                ];
                $zap->execute($data);
            }
            if($_POST['tabela']=="sklep"){
                $zap = $pdo->prepare("UPDATE sklep SET sklep_nazwa = :nazwa, miejsce = :miejsce WHERE ID = :IDZ");
                $data = [
                    'nazwa' => $_POST['nazwa'],
                    'miejsce' => $_POST['miejsce'],
                    'IDZ' => $_POST['IDZ'], //ID_Zmiany
                ];
                $zap->execute($data);
            }
            
        }
        if($_POST['akcja']=="kasuj"){
            if($_POST['tabela']=="Produkty"){
            $zap = $pdo->prepare("DELETE FROM produkty WHERE KOD = ?;");
            $zap->execute([$_POST['KOD']]);
            $zap = $pdo->prepare("DELETE FROM produkty_szczegoly WHERE KOD = ?");
            $zap->execute([$_POST['KOD']]);
            }
            if($_POST['tabela']=="sklep"){
            $zap = $pdo->prepare("DELETE FROM sklep WHERE ID = ? ;");
            $zap->execute([$_POST['IDZ']]);
            }
            if($_POST['tabela']=="firma"){
            $zap = $pdo->prepare("DELETE FROM firma WHERE ID = ? ;");
            $zap->execute([$_POST['IDZ']]);
            }
        }
        echo "zostaniesz przekierowany do index.php";
        echo $_POST['tabela'];
        //echo $_POST['IDZ'];
        //print_r($dane);
        header("Location:index.php");
    }catch(PDOException $e){
        $msg = "error: ".$e->getMessage();
        echo $msg;
        die();
    }
}
?>