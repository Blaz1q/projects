<!DOCTYPE html>
<html lang="pl">
    <head>
        <link type='text/css' rel='stylesheet' href='style.css' />
        <meta charset="utf-8" />
        <title>Wynik</title>
    </head>
    <body>
        <?php
        define('conlog',true);
        function conslog($message){
            if(conlog==true)
            echo '<script>console.log("'.$message.'")</script>';
            else{}
        }
        function laduj($id){
            $conn = mysqli_connect("localhost","root","","sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
                $j=0;
                $zap = "SELECT nazwa FROM produkty WHERE id = ".$id;
                $res = mysqli_query($conn,$zap);
                while($row=mysqli_fetch_array($res)){
                    return $row['nazwa'];
                }
            }
            mysqli_close($conn);
        }
        function update($ilosc,$id){
            $conn = mysqli_connect("localhost","root","","sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
                $zap = "UPDATE produkty SET ilosc = ilosc - ".$ilosc." WHERE id = ".$id;
                $res = mysqli_query($conn,$zap);
            }
            mysqli_close($conn);
        }
        function zamowienie($uzytkownik,$produkt,$kolor,$rozmiar,$ilosc){
            $conn = mysqli_connect("localhost","root","","sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
                $zap = "INSERT INTO zamowienia VALUES (NULL,'$uzytkownik','$produkt','$kolor','$rozmiar','$ilosc')";
                $res = mysqli_query($conn,$zap);
            }
            mysqli_close($conn);
        }
        function ilosctab($index){
            $conn = mysqli_connect("localhost","root","","sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
                $zap = "SELECT ilosc FROM produkty WHERE id=".$index;
                $res = mysqli_query($conn,$zap);
                while($row=mysqli_fetch_array($res)){
                    return $row['ilosc'];
                }
            }
            mysqli_close($conn);
        }
        function ile_elem(){
            $conn = mysqli_connect("localhost","root","","sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
                $j=0;
                $zap = "SELECT id FROM produkty";
                $res = mysqli_query($conn,$zap);
                while($row=mysqli_fetch_array($res)){
                    $j++;
                }
                return $j;
            }
            mysqli_close($conn);
        }
        function dane($array,$index,$top){
            $string = "";
            $count = 0;
            for($i=0;$i<$top;$i++){
                $string = $array[$index][$i];
                if($string==""){
                $count++;
                }
                $string = "";
            }
            if($count>0) return false;
            else return true;
        }
        function wypisz($arr,$x,$y,$nazwa){
            echo '--'.$nazwa.'--<br>';
            for($i=0;$i<$x;$i++){
                for($j=0;$j<$y;$j++){
                    echo '//index:['.$i." ".$j."] ";
                    if($j==0) echo "kolor:";
                    if($j==2) echo "rozmiar:";
                    if($j==1) echo "ilosc:";
                echo $arr[$i][$j]."<br>";
            }
        }
    }
        ?>
        <div class='center'>
            <div class='s0 container'>
                <h1>Zamówienie</h1>
                <form action='index.php'>
                    <input type='submit' value='powrót' />
                </form><br/>
                <div class='color'>
                    <?php
                        $switch1 = null; $switch2 = null; @$switch1 = $_POST['zamow']; @$switch2 = $_POST['wyslij'];
                        if($switch1=='zamów'){
                            $att = 3;
                            $elem = ile_elem();
                            $nazwa = null; @$nazwa = $_POST['nazwa'];
                            $kolor = array(); @$kolor = $_POST['kolor'];
                            $ilosc = array(); @$ilosc = $_POST['szt'];
                            $rozmiar = array(); @$rozmiar = $_POST['rozm'];
                            $faktura = array(); @$faktura = $_POST['faktura'];
                            $kolor_size = sizeof($kolor);
                            $ilosc_size = sizeof($ilosc);
                            $rozmiar_size = sizeof($rozmiar);
                            $total = 0; $total+=$kolor_size+$ilosc_size+$rozmiar_size;
                            for($i=0;$i<$elem;$i++){
                                for($j=0;$j<($total/$elem);$j++){
                                    if($j==0) @$arr[$i][$j] = $kolor[$i];
                                    if($j==1) @$arr[$i][$j] = $ilosc[$i];
                                    if($j==2) @$arr[$i][$j] = $rozmiar[$i];
                                    //echo $arr[$i][$j]."<br/>";
                                }
                            }
                            //wypisz($arr,$elem,($total/$elem),$nazwa);
                            $count=0;
                            for($i=0;$i<$elem;$i++){
                                if(dane($arr,$i,$att)==false){
                                    $count++;
                                }
                            }
                            if($kolor_size==0||$ilosc_size==0||$rozmiar_size==0){
                                echo "error.1: Form action error";
                            }
                            else if($nazwa==null||$count==$elem){
                                echo "Błędne zamówienie";
                            }
                            else{
                            for($i=0;$i<$elem;$i++){
                            conslog(dane($arr,$i,$att));
                            if(dane($arr,$i,$att)){
                                    echo "<h2 class='color'>zamówienie dla '".$nazwa."' - ".laduj($i+1)."</h2>";
                                    echo "<h3>kolor:".$kolor[$i]."</h3>";
                                    echo "<h3>rozmiar:".$rozmiar[$i]."</h3>";
                                    echo "<h3>ilość:".$ilosc[$i]."</h3>";
                                    if($faktura[$i]==$nazwa[$i])
                                    echo "<h3>faktura:TAK</h3>";
                                    
                                    update($ilosc[$i],$i+1);
                                    zamowienie($nazwa,laduj($i+1),$kolor[$i],$rozmiar[$i],$ilosc[$i]);
                                }
                            }
                        }
                    }
                    else if($switch2=="wyślij"){
                        $nazwa = null; $ilosc = null;
                        @$nazwa = $_POST['nazw'];
                        @$ilosc = $_POST['ilosc'];
                        if($nazwa==null||$ilosc==null){
                            echo 'error';
                        }
                        else{
                            $conn = mysqli_connect("localhost","root","","sklep");
                            if(!$conn) die(mysqli_connect_error());
                            else{
                            $zap = "INSERT INTO produkty VALUES (NULL,'$nazwa','$ilosc')";
                            $res = mysqli_query($conn,$zap);
                            echo 'Wysłano!';
                        }
                        mysqli_close($conn);
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>