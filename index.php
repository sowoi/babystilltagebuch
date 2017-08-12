<!DOCTYPE html>
<head>
    <title>Babystilltagebuch</title>
    <link rel="stylesheet" type="text/css" href="responsiveform.css">
<link rel="stylesheet" media="screen and (max-width: 1200px) and (min-width: 601px)" href="responsiveform1.css" />
<link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 351px)" href="responsiveform2.css" />
<link rel="stylesheet" media="screen and (max-width: 350px)" href="responsiveform3.css" />
<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

    <meta charset="utf-8">

  <style>
 #myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 10px;
}

#myBtn:hover {
  background-color: #555;
}
.box2 {
  display: inline-block;
  width: 500px;
  height: 100px;
  margin: 1em;
}

        .bar{
            fill: green;
        }

        .bar:hover{
            fill: brown;
        }

        .axis {
            font: 10px sans-serif;
        }

        .axis path,
        .axis line {
            fill: none;
            stroke: #000;
            shape-rendering: crispEdges;
        }
body {margin: 0;}

ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #173c66;
}

ul.topnav li {float: left;}

ul.topnav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

ul.topnav li a:hover:not(.active) {background-color: #111;}

ul.topnav li a.active {background-color: #a31b1b;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px){
    ul.topnav li.right, 
    ul.topnav li {float: none;}
}
</style>     
</head>

<body>
  <ul class="topnav">
  <li><a class="active" href="index.php">Hauptseite</a></li>
  <li><a href="summary.php">Übersicht über alle Eintragungen</a></li>
  <li><a href="visual.php">Visualisierung: Gewicht und Größe</a></li>
  <li><a href="visual2.php">Visualisierung: eingenommene Menge</a></li>
    <li><a href="automat.php">Automatisch errechnete Werte</a></li>
</ul>  
  <button onclick="topFunction()" id="myBtn" title="Go to top">Nach oben</button>

<script>  
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
    
<?php


if ( isset($_POST['datum']) <> "" )
{
    

        

    $handle = fopen ( "input.txt", "a" );
    $handle2 = fopen ( "json.txt", "a" );
    $handle3 = fopen ( "gewicht.txt", "a" );
    $handle4 = fopen ( "groesse.txt", "a" );
    $handle5 = fopen ("visual.txt", "a");
    



    $data = $_POST['datum'];
    // $datb = $_POST['datec'];
    $nama = $_POST['zeit'];
    $menga = $_POST['menge'];
    $gewichta = $_POST['gewicht'];
    $gewichtd = (int)$gewichta / 10;
    $groessa = $_POST['groesse'];
    $groessaa = (int)$groessa * 10;
    $groessb = $groessaa. PHP_EOL;
    $speicha = $_POST['savel']; 
    $honeypot = $_POST['hp']; 

    $year = substr($data, 6);
    $month = substr($data, 3, -5);
    $day = substr($data, 0, -8);

    $datb = $year.$month.$day;




    $jclgwo = file_get_contents('gewicht.txt');
    $jclgso = file_get_contents('groesse.txt');
    $jclinput = file_get_contents('jsonval.txt');
    $jclgsjo = (json_decode($jclgso, false));
    $jclgwjo = (json_decode($jclgwo, false));
    $jclinputo = (json_decode($jclinput, false));
    $gjwicht = array();
    $gjwdato = array();
    $gjsseo = array();
    $gjwdatso = array();
    $masse = array();
    $gjmmaa = array();
    $gjmmza = array();
    $nulleol = "0". PHP_EOL;




    if (is_array($jclgwjo) || is_object($jclgwjo)){
        foreach ($jclgwjo as $topp) {
            $gjwichto[] = $topp -> Gewicht;
            $lastG = (int)end($gjwichto);
            $gjwdato[] = $topp -> Datum;
            $lastDo = end($gjwdato);
            $yeargw = substr($lastDo, 6);
            $monthgw = substr($lastDo, 3, -5);
            $daygw = substr($lastDo, 0, -8);

            $lastDoCG = $yeargw.$monthgw.$daygw;

        }
    }



    foreach ($jclgsjo as $toppa) {
        $gjsseo[] = $toppa -> Groesse;
        $lastGs = (int)end($gjsseo);
        $lastGss = $lastGs.PHP_EOL;
        $gjsseo[] = $toppa -> Datum;
        $lastDso = end($gjsseo);
        $yeargs = substr($lastDso, 6);
        $monthgs = substr($lastDso, 3, -5);
        $daygs = substr($lastDso, 0, -8);

        $lastDoCGs = $yeargs.$monthgs.$daygs;

    }

    foreach ($jclinputo  as $topping) {
        $masse[] = (int)($topping -> Menge);
        $lastMDo = (int)end($masse);
        $gjmmaa[] = $topping -> Datum;
        $lastMDao = end($gjmmaa);
        $gjmmza[] = $topping -> Zeit;
        $lastMDzo = end($gjmmza);
    }





        if(!empty($honeypot)){
        
         echo '<script>
        setTimeout(function() {
        swal({
            title: "",
            text: "Bitte das unterste Feld leer lassen. Dies verhindert automatisierte Boteinträge!",
            type: "error"
        }, function() {
            window.location = "index.php";
        });
       }, 200);
        </script>';
          exit;
        }
        
       
        

    if(isset($_POST['loeschel'])){
        
        $file16 = 'json.txt';
        $mmurrenta = file_get_contents($file16);
        $phrase = "{\"Datum\":\"$lastMDao\",\"Zeit\":\"$lastMDzo\",\"Menge\":\"$lastMDo\"}";
        $mmurrentb = str_replace (  "$phrase",  "" , $mmurrenta );
        $mmurrentc = file_put_contents($file16, $mmurrentb);
        $file17 = 'input.txt';
        $miurrenta = file_get_contents($file17);
        $phrase2 = "Menge|$lastMDao|$lastMDzo|$lastMDo";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );

        $miurrentc = file_put_contents($file17, $miurrentb);
        
    }
    
    
        if(isset($_POST['loeschelgw'])){
        
        $file16 = 'gewicht.txt';
        $mmurrenta = file_get_contents($file16);
        $phrase = ",{\"Datum\":\"$lastDo\",\"Gewicht\":\"$lastG\"}";
        $mmurrentb = str_replace (  "$phrase",  "" , $mmurrenta );
        $mmurrentc = file_put_contents($file16, $mmurrentb);
        $file17 = 'input.txt';
        $miurrenta = file_get_contents($file17);
        $phrase2 = "Gewicht|$lastDo|$lastG";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );
        $miurrentc = file_put_contents($file17, $miurrentb);
        
    }
    
    
            if(isset($_POST['loeschelgs'])){
        
        $file16 = 'groesse.txt';
        $mmurrenta = file_get_contents($file16);
        $phrase = ",{\"Datum\":\"$lastDso\",\"Groesse\":\"$lastGs\"}";
        $mmurrentb = str_replace (  "$phrase",  "" , $mmurrenta );
        $mmurrentc = file_put_contents($file16, $mmurrentb);
        $file17 = 'input.txt';
        $miurrenta = file_get_contents($file17);
        $phrase2 = "Größe|$lastDso|$lastGs";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );

        $miurrentc = file_put_contents($file17, $miurrentb);
        
    }


    if($_POST['mengel'] == true){
        


        $file16 = 'json.txt';
        $mmurrenta = file_get_contents($file16);
        $phrase = "{\"Datum\":\"$lastMDao\",\"Zeit\":\"$lastMDzo\",\"Menge\":\"$lastMDo\"}";
        $mmurrentb = str_replace (  "$phrase",  "" , $mmurrenta );
        $mmurrentc = file_put_contents($file16, $mmurrentb);
        $file17 = 'input.txt';
        $miurrenta = file_get_contents($file17);
        $phrase2 = "Menge|$lastMDao|$lastMDzo|$lastMDo";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );

        $miurrentc = file_put_contents($file17, $miurrentb);


    }
    
    
 
            

    if($_POST['gewichtel'] == true and $_POST['grossel'] == false){

        $file15 = 'gewicht.txt';
        $gsrrenta = file_get_contents($file15);
        $phrase = ",{\"Datum\":\"$lastDo\",\"Gewicht\":\"$lastG\"}]";
        $gsrrentb = str_replace (  "$phrase",  "," , $gsrrenta );
        $gsrrentc = file_put_contents($file15, $gsrrentb);
        $file17 = 'visual.txt';
        $miurrenta = file_get_contents($file17);
        $phrase2 = "$lastDoCGs\t$lastG\t$lastGs";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );
        $miurrentc = file_put_contents($file17, $miurrentb);
        $file18 = 'input.txt';
        $miurrenta = file_get_contents($file18);
        $phrase2 = "Gewicht|$lastDo|$lastG";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );
        $miurrentc = file_put_contents($file18, $miurrentb);

    }
    
   



    if($_POST['grossel'] == true and ($_POST['gewichtel'] == false)){

        $file15 = 'groesse.txt';
        $gsrrenta = file_get_contents($file15);
        $phrase = ",{\"Datum\":\"$lastDso\",\"Groesse\":\"$lastGs\"}]";
        $gsrrentb = str_replace (  "$phrase",  "," , $gsrrenta );
        $gsrrentc = file_put_contents($file15, $gsrrentb);
        $file17 = 'visual.txt';
        $miurrenta = file_get_contents($file17);
        $phrase2 = "$lastDoCGs\t$lastG\t$lastGs";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );
        $miurrentc = file_put_contents($file17, $miurrentb);
        $file18 = 'input.txt';
        $miurrenta = file_get_contents($file18);
        $phrase2 = "Gewicht|$lastDso|$lastGs";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );

        $miurrentc = file_put_contents($file18, $miurrentb);




    }
    




    if(($_POST['grossel'] == true) and ($_POST['gewichtel'] == true)){

        $file17 = 'visual.txt';
        $miurrenta = file_get_contents($file17);
        $phrase2 = "$lastDoCG\t$lastG\t$lastGs";
        $miurrentb = str_replace (  "$phrase2",  "" , $miurrenta );
        $miurrentc = file_put_contents($file17, $miurrentb);






    }





    if((empty($menga)) and (empty($gewichta)) and (empty($groessa)) and !isset($_POST['loeschel']) and !isset($_POST['loeschelgs']) and !isset($_POST['loeschelgw'])){


         echo '<script>
        setTimeout(function() {
        swal({
            title: "",
            text: "Bitte Werte eintragen!",
            type: "error"
        }, function() {
            window.location = "index.php";
        });
       }, 200);
        </script>';
        



    }elseif (!(empty($menga)) and !(is_numeric($menga)) and (empty($gewichta)) and (empty($groessa))) {


        
       echo '<script>
        setTimeout(function() {
        swal({
            title: "",
            text: "Bitte nur Zahlen bei Menge eingeben!",
            type: "error"
        }, function() {
            window.location = "index.php";
        });
       }, 200);
        </script>';


    }
    elseif (!(empty($_POST['gewicht']))  and !(is_numeric($_POST['gewicht']))) {

       echo '<script>
        setTimeout(function() {
        swal({
            title: "",
            text: "Bitte nur Zahlen bei Gewicht eingeben!",
            type: "error"
        }, function() {
            window.location = "index.php";
        });
       }, 200);
        </script>';



    }elseif (!(empty($_POST['groesse'])) and !(is_numeric($_POST['groesse']))) {


       echo '<script>
        setTimeout(function() {
        swal({
            title: "",
            text: "Bitte nur Zahlen bei Größe eintragen!",
            type: "error"
        }, function() {
            window.location = "index.php";
        });
       }, 200);
        </script>';





    }else{
        if(!empty($menga)){
            fwrite ( $handle, "Menge");
            fwrite ( $handle, "|");
            fwrite ( $handle, $data);
            fwrite ( $handle, "|" );
            fwrite ( $handle, $nama);
            fwrite ( $handle, "|" );
            fwrite ( $handle, $menga);
            fwrite ( $handle, "\n" );
            $myObj->Datum = $data;
            $myObj->Zeit = $nama;
            $myObj->Menge = $menga;
            $myJSON = json_encode($myObj);

        
        }
        if(!empty($gewichta) and !empty($groessa)){
            fwrite ( $handle, "Gewicht");
            fwrite ( $handle, "|" );
            fwrite ( $handle, $data);
            fwrite ( $handle, "|" );
            fwrite ( $handle, $gewichta);
            fwrite ( $handle, "\n" );
            fwrite ( $handle, "Größe");
            fwrite ( $handle, "|" );
            fwrite ( $handle, $data);
            fwrite ( $handle, "|" );
            fwrite ( $handle, $groessa);
            fwrite ( $handle, "\n" );
            $myObj2->Datum = $data;
            $myObj2->Gewicht = $gewichta;
            $myJSON2 = json_encode($myObj2);
            fwrite($handle3, $myJSON2);
            $myObj4->Datum = $data;
            $myObj4->Groesse = $groessa;
            $myJSON4 = json_encode($myObj4);
            fwrite ($handle4, $myJSON4);
            fwrite ($handle5, $datb);
            fwrite ( $handle5, "\t" );
            fwrite($handle5, $gewichtd);
            fwrite ( $handle5, "\t" );
            fwrite($handle5, $groessb);
            fwrite ( $handle19, $datb);
            fclose ( $handle19 );
        }
        if(!empty($gewichta) and empty($groessa)) {
            fwrite ( $handle, "Gewicht");
            fwrite ( $handle, "|" );
            fwrite ( $handle, $data);
            fwrite ( $handle, "|" );
            fwrite ( $handle, $gewichta);
            fwrite ( $handle, "\n" );
            $myObj2->Datum = $data;
            $myObj2->Gewicht = $gewichta;
            $myJSON2 = json_encode($myObj2);
            fwrite($handle3, $myJSON2);
            fwrite($handle5, $datb);
            fwrite ( $handle19, $datb);
            fclose ( $handle19 );
            fwrite($handle5, "\t");
            fwrite($handle5, $gewichtd);
            fwrite($handle5, "\t");
            if (empty($groessa) and !empty($gewichta)) {
                if(isset($lastGss)){
                    fwrite($handle5, $lastGss);
                }else{
                    fwrite($handle5, "0");
                }

            } else {

                fwrite($handle5, $groessb);
            }

        }
        if(!empty($groessa) and empty($gewichta)){
            fwrite ( $handle, "Größe");
            fwrite ( $handle, "|" );
            fwrite ( $handle, $data);
            fwrite ( $handle, "|" );
            fwrite ( $handle, $groessa);
            fwrite ( $handle, "\n" );
            $myObj4->Datum = $data;
            $myObj4->Groesse = $groessa;
            $myJSON4 = json_encode($myObj4);
            fwrite ($handle4, $myJSON4);
            fwrite ($handle5, $datb);
            fwrite ( $handle19, $datb);
            fclose ( $handle19 );
            fwrite ( $handle5, "\t" );
            if(empty($gewichta)){
                if(isset($lastG)){
                    $lastGd = (int)$lastG / 10;
                    fwrite($handle5, $lastGd);
                }else{
                    fwrite($handle5, $nulleol);
                }

            }else{
                fwrite($handle5, $gewichtd);
            }
            fwrite ( $handle5, "\t" );
            fwrite($handle5, $groessb);
        }

        if(!isset($lastG) and !isset($lastGGs) and !isset($lastMDo)){

            $file8 = 'visual.txt';
            $vurrenta = file_get_contents($file8);
            $add = "date\tGewicht in g\tGröße in cm";
            $addeol = $add.PHP_EOL;
            $vurrentb = $addeol.$vurrenta;
            file_put_contents($file8, $vurrentb);


        }
        
        
        
        
        
        fwrite ( $handle2, $myJSON);
        header( 'HTTP/1.1 303 See Other' );
        header( "Location: index.php" );

        file_put_contents('visualb.txt',
            preg_replace(
                '~[\r\n]+~',
                "\r\n",
                trim(file_get_contents('visual.txt'))
            )
        );
        
        file_put_contents('inputb.txt',
            preg_replace(
                '~[\r\n]+~',
                "\r\n",
                trim(file_get_contents('input.txt'))
            )
        );

        exit();

    }

    exit();

    unset($nama);
    unset($data);
    unset($menga);
    unset($gewichta);


    fclose ( $handle2 );
    fclose ( $handle );
    fclose ( $handle3 );
    fclose ( $handle4 );
    fclose ( $handle5 );



    $file = 'json.txt';
    $currentb = file_get_contents($file);
    $currentc = str_replace (  "}{" ,  "},{" , $currentb );
    $handle = fopen ( "jsonval.txt", "w" );
    fwrite ( $handle, $currentc);
    fclose ( $handle );

    $file = 'jsonval.txt';
    $currenta = file_get_contents($file);
    $add = "[";
    $currentb = $add .$currenta;
    $end = "]";
    $currentc = $currentb.$end;
    $currente = str_replace (  "}[{" ,  "},{" , $currentc );
    $currentf = str_replace (  "}[" ,  "}]" , $currente );
    $currentg = str_replace (  "[[" ,  "[" , $currentf );
    $currenth = str_replace (  "}]{" ,  "},{" , $currentg );
    file_put_contents($file, $currenth);


    $file2 = 'gewicht.txt';
    $gurrentb = file_get_contents($file2);
    $gurrentc = str_replace (  "}{" ,  "},{" , $gurrentb );
    $handle2 = fopen ( "gewicht.txt", "w" );
    fwrite ( $handle2, $gurrentc);
    fclose ( $handle2 );

    $file = 'gewicht.txt';
    $gurrenta = file_get_contents($file);
    $add = "[";
    $gurrentb = $add .$gurrenta;
    $end = "]";
    $gurrentc = $gurrentb.$end;
    $gurrente = str_replace (  "}[{" ,  "},{" , $gurrentc );
    $gurrentf = str_replace (  "}[" ,  "}]" , $gurrente );
    $gurrentg = str_replace (  "[[" ,  "[" , $gurrentf );
    $gurrenth = str_replace (  "}]{" ,  "},{" , $gurrentg );
    file_put_contents($file2, $gurrenth);

    $file3 = 'groesse.txt';
    $lurrentb = file_get_contents($file3);
    $lurrentc = str_replace (  "}{" ,  "},{" , $lurrentb );
    $handle3 = fopen ( "groesse.txt", "w" );
    fwrite ( $handle3, $lurrentc);
    fclose ( $handle3 );

    $file = 'groesse.txt';
    $lurrenta = file_get_contents($file);
    $add = "[";
    $lurrentb = $add .$lurrenta;
    $end = "]";
    $lurrentc = $lurrentb.$end;
    $lurrente = str_replace (  "}[{" ,  "},{" , $lurrentc );
    $lurrentf = str_replace (  "}[" ,  "}]" , $lurrente );
    $lurrentg = str_replace (  "[[" ,  "[" , $lurrentf );
    $lurrenth = str_replace (  "}]{" ,  "},{" , $lurrentg );
    file_put_contents($file3, $lurrenth);


        


    exit;
    
    

}
?>



<div align="center">
    
    <div id="abfrage">
    <form id="werte" action="index.php"  method="POST"  onsubmit='func()'>
        
        <?php
        
echo "<div id='summ'>";        
        
$jcle = file_get_contents('jsonval.txt') or die("Kann Datenbankdatei nicht öffnen!");
$jsod = (json_decode($jcle, false));



$masse = array();
$tages = array();
$gjwicht = array();
$gjwdat = array();
$gjsse = array();
$gjwdats = array();
$heute = (date('d-m-Y'));
$time = time();
$gestern = date("d-m-Y", mktime(0,0,0,date("n", $time),date("j",$time)- 1 ,date("Y", $time)));
$vorgestern = date("d-m-Y", mktime(0,0,0,date("n", $time),date("j",$time)- 2 ,date("Y", $time)));
$vorvorgestern = date("d-m-Y", mktime(0,0,0,date("n", $time),date("j",$time)- 3 ,date("Y", $time)));
$lastmonth = date("m", strtotime("first day of previous month"));
$actyear = date("Y", strtotime("first day of previous month"));

$lastlastmonth = date("j-n-Y", strtotime("last day of previous month"));

$list=array();
$month = $lastmonth;
$year = $actyear;


foreach ($jsod as $topping) {
    $masse[] = (int)($topping -> Menge);
    if (($topping -> Datum) == $heute){
        $tages[] = (int)($topping -> Menge);
    }
    if (($topping -> Datum) == $gestern){
        $tagesj[] = (int)($topping -> Menge);
    }
    if (($topping -> Datum) == $vorgestern){
        $tagesjj[] = (int)($topping -> Menge);
    }
    if (($topping -> Datum) == $vorvorgestern){
        $tagesjjj[] = (int)($topping -> Menge);
    }

}








$gegenwa = array_sum($tages);
$gegenwb = "\"".$gegenwa."\"";
if(isset($tagesj)){
    $vergang = array_sum($tagesj);
    $diffgegve = $gegenwa - $vergang;
}







echo "Heute schon getrunken: " . $gegenwa . " ml \n ";
if(isset($tagesj)){
    echo "<br>Gestern getrunken: " . $vergang . " ml \n ";
    echo "<br>Differenz von heute zu gestern " . $diffgegve. " ml \n ";
   
}

echo "</div>";
?>

        <p><h3>Datum:</h3>
            <input type="Text" name="datum" value='<?php echo date('d-m-Y');?>'> </p>
        <input type="hidden" name="datec" value="<?php echo date('Ymd');?>" />
            


        <p><h3>Zeit:</h3>
            <input type="Text" name="zeit" value='<?php echo date('H:i');?>'></p>

        <p><h3>Menge:</h3>
            <input type="Text" name="menge"  autocomplete="off"></p>

        <p><h3>Gewicht in g:</h3>
            <input type="Text" name="gewicht" autocomplete="off"></p>

        <p><h3>Größe in cm:</h3>
            <input type="Text" name="groesse" autocomplete="off"></p>

        <p><h3>Soll der letzte Wert überschreiben werden?</h3>
            <input type="hidden" name="mengel" value="0" />
            <input type="checkbox"  name="mengel" value="1"  onclick="sweetAlert('', 'Du bist gerade dabei den letzten Menge Wert zu überschreiben. Willst du das wirklich?', 'warning');"> Menge<br>
            <input type="hidden" name="gewichtel" value="0" />
            <input type="checkbox"  name="gewichtel" value="1"  onclick="sweetAlert('', 'Du bist gerade dabei den letzten Gewicht Wert zu überschreiben. Willst du das wirklich?', 'warning');"> Gewicht<br>
            <input type="hidden" name="grossel" value="0" />
            <input type="checkbox"  name="grossel" value="1" onclick="sweetAlert('', 'Du bist gerade dabei den letzten Größe Wert zu überschreiben. Willst du das wirklich?', 'warning');"> Größe<br> <br><br>
            		<label>Dieses Feld leer lassen!</label>
		    <input type="text" name="hp" />
   
            <input type="Submit" name="savel" value="Speichern" >



            


<script>
function func() {

 if (confirm('Sicher?')){
   window.location = "http://index.php";
   alert('gespeichert');
   
}else{
   event.preventDefault();
   sweetAlert('', 'Vorgang abgebrochen', 'error');
};
 

}

</script>

            
            
            <?php

$file = 'json.txt';
$currentb = file_get_contents($file);
$currentc = str_replace (  "}{" ,  "},{" , $currentb );
$handle = fopen ( "jsonval.txt", "w+" );
fwrite ( $handle, $currentc);
fclose ( $handle );

$file = 'jsonval.txt';
$currentd = file_get_contents($file);
$currentdd =  "[".$currentd;
$currentddd =  $currentdd."]";
$currente = str_replace (  "}[{" ,  "},{" , $currentddd );
$currentf = str_replace (  "}[" ,  "}]" , $currente );
$currentg = str_replace (  "[[" ,  "[" , $currentf );
file_put_contents($file, $currentg);


$file2 = 'gewicht.txt';
$gurrentb = file_get_contents($file2);
$gurrentc = str_replace (  "}{" ,  "},{" , $gurrentb );
$handle2 = fopen ( "gewicht.txt", "w+" );
fwrite ( $handle2, $gurrentc);
fclose ( $handle2 );

$file2 = 'gewicht.txt';
$gurrentd = file_get_contents($file2);
$gurrentdd =  "[".$gurrentd;
$gurrentddd =  $gurrentdd."]";
$gurrente = str_replace (  "}[{" ,  "},{" , $gurrentddd );
$gurrentf = str_replace (  "}[" ,  "}]" , $gurrente );
$gurrentg = str_replace (  "[[" ,  "[" , $gurrentf );
$gurrenth = str_replace (  "]]" ,  "]" , $gurrentg );
$gurrenti = str_replace (  "[]" ,  "" , $gurrenth );
$gurrentj = str_replace (  "}]{" ,  "},{" , $gurrenti );

file_put_contents($file2, $gurrentj);


$file3 = 'groesse.txt';
$lurrentb = file_get_contents($file3);
$lurrentc = str_replace (  "}{" ,  "},{" , $lurrentb );
$handle2 = fopen ( "groesse.txt", "w+" );
fwrite ( $handle2, $lurrentc);
fclose ( $handle2 );

$file3 = 'groesse.txt';
$lurrentd = file_get_contents($file3);
$lurrentdd =  "[".$lurrentd;
$lurrentddd =  $lurrentdd."]";
$lurrente = str_replace (  "}[{" ,  "},{" , $lurrentddd );
$lurrentf = str_replace (  "}[" ,  "}]" , $lurrente );
$lurrentg = str_replace (  "[[" ,  "[" , $lurrentf );
$lurrenth = str_replace (  "]]" ,  "]" , $lurrentg );
$lurrenti = str_replace (  "[]" ,  "" , $lurrenth );
$lurrentj = str_replace (  "}]{" ,  "},{" , $lurrenti );

file_put_contents($file3, $lurrentj);




?>

<div id="summ">
<?php
echo "<br><strong> Die letzten 5 Einträge </strong> <br />";
$data = array_slice(file('inputb.txt'), -5);
foreach ($data as $line) {
    echo "<li>$line <br>";
}










$jclvalv = file_get_contents('jsonvalv.txt');
$jclgvv = (json_decode($jclvalv, false));

    $file222 = 'jsonvalv.txt';
    $mmurrenta222 = file_get_contents($file222);
    $add = "[";
    $end = "]";
    $mmurrentc222 = $mmurrenta222.$end;
    $mmurrentd222 = str_replace (  "[[",  "[" , $mmurrentc222 );
    $mmurrente222 = str_replace (  "}{",  "},{" , $mmurrentd222 );
    $mmurrentf222 = str_replace (  "}]{",  "},{" , $mmurrente222 );
    $mmurrentg222 = str_replace (  "}[{",  "},{" , $mmurrentf222 );
    $mmurrenth222 = str_replace (  "]]",  "]" , $mmurrentg222 );
    $mmurrenti222 = str_replace (  "[]",  "[" , $mmurrenth222 );
    $mmurrentj222 = file_put_contents($file222, $mmurrenth222);
    
 
    foreach ($jclgvv  as $taspping) {
        $masse22[] = (int)($taspping -> Menge);
        $lastMDo22 = (int)end($masse22);
        $gjmmaa[] = $taspping -> Datum;
        $lastMDao22 = end($gjmmaa);
        $lastMDo222 = "\"".$lastMDo22."\"";
    }
    
    


    



if(isset($lastMDo22) and ($lastMDao22 == $heute) and ($lastMDo222 != $gegenwa)){

    $phrase22 = "{\"Datum\":\"$lastMDao22\",\"Menge\":\"$lastMDo22\"}";
    $phraseneu = "{\"Datum\":\"$heute\",\"Menge\":\"$gegenwa\"}";
    $nuncha = file_get_contents('jsonvalv.txt');
    $nunchb = str_replace (  $phrase22,  "$phraseneu" , $nuncha );
    $nunchc = file_put_contents('jsonvalv.txt', $nunchb);

    
    
}else{

    
    
    
    $handle22 = fopen ( "jsonvalv.txt", "a" );
    $file22 = 'jsonvalv.txt';
    $myObj22->Datum = $heute;
    $myObj22->Menge = "$gegenwa";
    $myJSON22 = json_encode($myObj22);
    fwrite ($handle22, $myJSON22);
    fclose ( $handle22 );
}
    



    $file222 = 'jsonvalv.txt';
    $mmurrenta222 = file_get_contents($file222);
    $add = "[";
    $mmurrentcc222 = $add.$mmurrenta222;
    $end = "]";
    $mmurrentc222 = $mmurrentcc222.$end;
    $mmurrentd222 = str_replace (  "[[",  "[" , $mmurrentc222 );
    $mmurrente222 = str_replace (  "}{",  "},{" , $mmurrentd222 );
    $mmurrentf222 = str_replace (  "}]{",  "},{" , $mmurrente222 );
    $mmurrentg222 = str_replace (  "}[{",  "},{" , $mmurrentf222 );
    $mmurrenth222 = str_replace (  "]]",  "]" , $mmurrentg222 );
    $mmurrenti222 = str_replace (  "[]",  "[" , $mmurrenth222 );
    $mmurrentj222 = file_put_contents($file222, $mmurrenti222);
    

?></div>


<br>

<div align="center">
    


    <form id="test" action="index.php"  method="POST" >

          
             

            <input type="Submit" name="loeschel" value="Letzten Mengeeintrag löschen" >
            <br>
            <input type="Submit" name="loeschelgw" value="Letzten Gewichtseintrag löschen" ><br>
            <input type="Submit" name="loeschelgs" value="Letzten Größeeintrag löschen" >

            
 


            <div class="g-recaptcha" data-sitekey="6LcspywUAAAAAESCl1cpnh_tW2L5kQQWCT6xQ247"></div>


    </form>

</div>




<br>




</div>


</div>

</div>
</div>
<br>
</body>
</html>
