<!DOCTYPE html>
<html>
    <head>
        <title>sortowanie</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <?php
    
    function echo_table($arr,$sizex,$sizey,$size,$lpierwsze){
        $z=0;
        $b= sizeof($lpierwsze);
        echo "<table cellspacing=0 cellpadding=10>";
                for($i=0;$i<$sizey;$i++){
                    echo "<tr>";
                    for($j=0;$j<$sizex;$j++){
                        $skipnext = false;
                        for($k=0;$k<$b;$k++){
                            if($lpierwsze[$k]==$arr[$z]){
                            echo "<td class='prime' >".$arr[$z]."</td>";
                            $k=$b;
                            $skipnext=true;
                            }
                        }
                        if($skipnext==false)
                        echo "<td>".$arr[$z]."</td>";
                        $z++;
                    }
                    echo "</tr>";
                }
        echo "</table>";
    }
        function bubbel($tab,$ascdsc,$size){
            for($i=0;$i<$size;$i++){
                for($j=$i+1;$j<$size;$j++){
                    switch($ascdsc){
                        case "asc": 
                        if($tab[$j]<$tab[$i]){ 
                            $temp = $tab[$j];
                            $tab[$j] = $tab[$i];
                            $tab[$i] = $temp;
                        }
                        break;
                        case "dsc": 
                            if($tab[$j]>$tab[$i]){ 
                                $temp = $tab[$j];
                                $tab[$j] = $tab[$i];
                                $tab[$i] = $temp;
                            }
                            break;
                    }
                }
            }
            return $tab;
        }
        function insertion($tab,$ascdsc,$size){
            for($i=0;$i<$size;$i++){
                for($j=0;$j<$i;$j++){
                    switch($ascdsc){
                        case "asc": 
                        if($tab[$i]<$tab[$j]){ 
                            $temp = $tab[$i];
                            $tab[$i] = $tab[$j];
                            $tab[$j] = $temp;
                        }
                        break;
                        case "dsc": 
                            if($tab[$j]>$tab[$i]){ 
                                $temp = $tab[$j];
                                $tab[$j] = $tab[$i];
                                $tab[$i] = $temp;
                            }
                            break;
                    }
                }
            }
            return $tab;
        }
        function selection($tab,$ascdsc,$size,$range){
            $index;
            for($i=0;$i<$size;$i++){
                switch($ascdsc){
                case "asc": $minmax = $range[1]; break;
                case "dsc": $minmax = $range[0]; break;
                }
                for($j=$i+1;$j<$size;$j++){
                    switch($ascdsc){
                        case "asc":
                        if($tab[$j]<$minmax){
                            $minmax = $tab[$j];
                            $index = $j;
                        }
                        break;
                        case "dsc":
                            if($tab[$j]>$minmax){
                                $minmax = $tab[$j];
                                $index = $j;
                            }
                            break;
                    }
                }
                $temp = $tab[$index];
                $tab[$index] = $tab[$i];
                $tab[$i] = $temp;
            }
            return $tab;  
        }
        function output(){
            $sort = $_POST['sortowanie'] ?? false;
            $asc_dsc = $_POST['asc_dsc'] ?? false;
            if(!$sort||$sort=="none"){

            }
            else{
                $lpierwsze = array();
                $tab = array();
                $size = 200;
                $sizex = 20;
                $sizey= 10;
                $range = array(0,99);
                $z=0;
                $zs=0;
                for($i=2;$i<$size;$i++){
                    $booll=true;
                    for($j=2;$j<$i*$i;$j++){
                        if($i%$j==0&&$j!=$i){
                            $booll=false;
                        }
                    }
                    if($booll==true){
                        $lpierwsze[$zs]=$i;
                        $zs++;
                    }
                }
                while($z<$size){
                    $tab[$z] = rand($range[0],$range[1]);
                    $z++;
                }
                echo "<div class='nonsorted'>";
                echo "<div class='holder'><h4>Przed</h4>";
                echo_table($tab,$sizex,$sizey,$size,$lpierwsze);
                echo "</div>";
                echo "</div>";
                switch($sort){
                    case 'bubel':
                        echo "<div class='holder'><h4>bąbelkowo</h4>";
                        $tab = bubbel($tab,$asc_dsc,$size);
                        echo_table($tab,$sizex,$sizey,$size,$lpierwsze);
                    break;
                    case 'insert':
                        echo "<div class='holder'><h4>przez wstawianie</h4>";
                        $tab = insertion($tab,$asc_dsc,$size);
                        echo_table($tab,$sizex,$sizey,$size,$lpierwsze);
                    break;
                    case 'select':
                        echo "<div class='holder'><h4>przez wybór</h4>";
                        $tab = selection($tab,$asc_dsc,$size,$range);
                        echo_table($tab,$sizex,$sizey,$size,$lpierwsze);
                    break;
                }
                echo "</div>";
            }
        }
    ?>
    <body>
        <form action="index.php" method="post">
            <select name="sortowanie">
                <option value="bubel">bąbelkowe</option>
                <option value="insert">przez wstawianie</option>
                <option value="select">przez wybór</option>
                <option value='none'>-</option>
            </select>
            <select name='asc_dsc'>
                <option value='asc'>rosnąco</option>
                <option value='dsc'>malejąco</option>
            </select>
            <input type="submit" value="Sortuj">
        </form>
        <div class='output'>
                <?php output();?>
        </div>
    </body>
</html>