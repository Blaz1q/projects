<?php
    session_start();
    function gen($ile_liczb){
        $i=0;
        $txt = "";
        while($i<$ile_liczb){
            $i++;
            $txt .= strval(rand(0,9));
        }
        return $txt;
    }
    try{
        if(isset($_POST['tabela'])){
            $pdo = new PDO('mysql:host=localhost;dbname=sklep','root','');
            if($_POST['tabela']=="firma"){
                $zap = $pdo->prepare("INSERT INTO firma VALUES (NULL,?,?)");
                $zap->execute([$_POST['Nazwa'],$_POST['Miejsce']]);
                $pdo->query("INSERT INTO ostatnio_dodane VALUES (NULL,1,(SELECT ID FROM firma ORDER BY ID DESC LIMIT 1))");
                header("Location:index.php");
            }
            if($_POST['tabela']=="sklep"){
                $zap = $pdo->prepare("INSERT INTO sklep VALUES (NULL,?,?)");
                $zap->execute([$_POST['Nazwa'],$_POST['Miejsce']]);
                $pdo->query("INSERT INTO ostatnio_dodane VALUES (NULL,0,(SELECT ID FROM sklep ORDER BY ID DESC LIMIT 1))");
                header("Location:index.php");
            }
            if($_POST['tabela']=="produkty"){
                do{
                $txt = gen(6);
                $zap = $pdo->query("SELECT COUNT(*) FROM produkty WHERE KOD = '{$txt}'");
                foreach($zap as $row);
                $num_rows = $row[0];
                }while($num_rows!=0);
                $zap = $pdo->prepare("INSERT INTO produkty VALUES (NULL,?)");
                $zap->execute([$txt]);
                $zap = $pdo->prepare("INSERT INTO produkty_szczegoly VALUES (:kod,:nazwa,:ilosc,:cena,:firma,:sklep)");
                $dane = [
                    'kod' => $txt,
                    'nazwa' => $_POST['Item'],
                    'ilosc' => $_POST['Ilosc'],
                    'cena' => $_POST['Cena'],
                    'firma' => $_POST['ID_Firmy'],
                    'sklep' => $_POST['ID_Sklepu'],
                ];
                $zap->execute($dane);
                $pdo->query("INSERT INTO ostatnio_dodane VALUES (NULL,2,(SELECT ID FROM produkty ORDER BY ID DESC LIMIT 1))");
                header("Location:index.php");
            }
            $pdo = null;
        }
            

    }catch(PDOException $e){
        $msg = "error: ".$e->getMessage();
        echo $msg;
        die();
    }
?>