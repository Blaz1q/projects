<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <title>Sklep internete</title>
        <link type="text/css" rel="stylesheet" href="style.css"/>
        <script src="script.js"></script>
    </head>
    <body>
        <div class="baner">

        </div>
        <?php
		function wyswietl(){
			$conn = mysqli_connect("localhost","root","","sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
                $j=0;
                $zap = "SELECT * FROM produkty";
                $res = mysqli_query($conn,$zap);
                while($row = mysqli_fetch_array($res)){
                    if($row['ilosc']<=0) echo "<div class='container-grayscale container'>";

                    else echo "<div class='container'>";
                    if($row['ilosc']<=0) echo "<h1><text style='font-size:75%;' >🔒</text>".$row['nazwa']." <text style='font-size:50%;' >[".$row['ilosc']."]szt</text></h1>";
                    else echo "<h1>".$row['nazwa']." <text style='font-size:50%;' >[".$row['ilosc']."]szt</text></h1>";
                    echo "<select name='kolor[]'>";
                    echo "<option value='0'>-</option>";
                    echo "<option value='blue'>blue</option>";
                    echo "<option value='red'>red</option>";
                    echo "<option value='green'>green</option>";
                    echo "<option value='yellow'>yellow</option>";
                    echo "</select><br/>";
                    echo "<select name='rozm[]'>";
                    echo "<option value='0'>-</option>";
                    echo "<option value='S'>S</option>";
                    echo "<option value='M'>M</option>";
                    echo "<option value='L'>L</option>";
                    echo "<option value='XL'>XL</option>";
                    echo "</select><br/>";
                    echo "<input type='number' class='maxwidth' placeholder='ilość' min='0' max=".$row['ilosc']." name='szt[]' />";
                    echo "<input type='checkbox' class='checkbox' title='faktura' name='faktura[]'>";
                    echo "</div>";
                    $j++;
                }
            }
            mysqli_close($conn);
		}
        function ostatnie_zam(){
        
                $conn = mysqli_connect("localhost","root","","sklep");
                if(!$conn) die(mysqli_connect_error());
                else{
                    $j=0;
                    $zap = "SELECT uzytkownik,produkt,ilosc FROM zamowienia ORDER BY id DESC LIMIT 2";
                    $res = mysqli_query($conn,$zap);
                while($row=mysqli_fetch_array($res)){
                    echo "<h4>".$row['uzytkownik']." - ".$row['ilosc']."*".$row['produkt']."</h4>";
                }
            }
            mysqli_close($conn);
        }
        function wyslij($nazwa,$ilosc){
            $conn = mysqli_connect("localhost","root","","sklep");
            if(!$conn) die(mysqli_connect_error());
            else{
                $zap = "INSERT INTO produkty VALUES (NULL,'$nazwa','$ilosc')";
                $res = mysqli_query($conn,$zap);
                echo $res;
            }
            mysqli_close($conn);
            }
        ?>
        <div class="main">
            <form action="wynik.php" method="post">
                <div class='uzytkownik'>
                    <input type='text' name='nazwa' placeholder='użytkownik' /><br/><br/><br/>
                </div>
                <div class='grid'>
                    <?php wyswietl();?>
                </div>
                <div class='g2 grid'>
                    <div class='s0 container' style='margin-top:50px; text-align:center;'>
                        <h1>zamów</h1>
                        <input type='submit' name='zamow' value='zamów'/>
                    </div>
                    <div class='animated s0 container' style="margin-top:50px; text-align:center;">
                    <h1>Ostatnie zamówienia:</h1>
                        <?php
                            ostatnie_zam();
                        ?>
                    </div>
                    <div class='s0 container' style='margin-top:50px; text-align:center;'>
                        <h1>wyślij</h1>
                        <input type='text' name='nazw' placeholder='produkt' />
                        <input type='number' min='1' name='ilosc' placeholder='ilosc' /><br/>
                        <input type='submit' name='wyslij' value='wyślij'/>
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>