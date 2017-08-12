<!DOCTYPE html>
<head>
    <title>Automatisch berechnete Einträge</title>


<script src="dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
   <link rel="stylesheet" type="text/css" href="responsiveform.css">

<link rel="stylesheet" media="screen and (max-width: 1200px) and (min-width: 601px)" href="responsiveform1.css" />
<link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 351px)" href="responsiveform2.css" />
<link rel="stylesheet" media="screen and (max-width: 350px)" href="responsiveform3.css" />

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
  <li><a href="index.php">Hauptseite</a></li>
  <li><a  href="summary.php">Übersicht über alle Eintragungen</a></li>
  <li><a href="visual.php">Visualisierung: Gewicht und Größe</a></li>
  <li><a href="visual2.php">Visualisierung: eingenommene Menge</a></li>
    <li><a class="active" href="automat.php">Automatisch errechnete Werte</a></li>
</ul>   
    
    
    <button onclick="topFunction()" id="myBtn" title="Go to top">Nach oben</button>

<div align="center">    
    <div id="abfrage">
       
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

echo "<h2 id='menge'>Automatisch errechnete Werte</h2></u>";


$jcle = file_get_contents('jsonval.txt') or die("Kann Datenbankdatei nicht öffnen!");
$jsod = (json_decode($jcle, false));

$jclgw = file_get_contents('gewicht.txt');
$jclgs = file_get_contents('groesse.txt');
$jclgsj = (json_decode($jclgs, false));
$jclgwj = (json_decode($jclgw, false));

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

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month)       
        $list[]=date('d-m-Y', $time);
}

$massem = array();

foreach ($jsod as $topping) {
    $masse[] = (int)($topping -> Menge);
    $massem[$topping->Datum] = $topping->Menge;
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






if (is_array($jclgwj) || is_object($jclgwj)){
    foreach ($jclgwj as $topp) {
        $gjwicht[] = $topp -> Gewicht;
        $lastG = (int)end($gjwicht);
        $lastGG = (int)prev($gjwicht);
        $gjwdat[] = $topp -> Datum;
        $lastD = end($gjwdat);
        $lastDD = prev($gjwdat);
    }
}



foreach ($jclgsj as $toppa) {
    $gjsse[] = $toppa -> Groesse;
    $lastGs = (int)end($gjsse);
    $lastGGs = (int)prev($gjsse);
    $gjwdats[] = $toppa -> Datum;
    $lastDs = end($gjwdats);
    $lastDDs = prev($gjwdats);
}


$gegenwa = array_sum($tages);
$gegenwb = "\"".$gegenwa."\"";
if(isset($tagesj)){
    $vergang = array_sum($tagesj);
    $diffgegve = $gegenwa - $vergang;
}


$diffgegvegw = $lastG - $lastGG;
$diffgegvegs = $lastGs - $lastGGs;

if((isset($tagesj)) and (isset($tagesjj)) and (isset($tagesjjj))){
    $summedreitage = array_sum($tagesj)+array_sum($tagesjj)+array_sum($tagesjjj);
}



echo "<br>Heute getrunken: " . $gegenwa . " ml \n ";
if(isset($tagesj)){
    echo "<br>Gestern getrunken: " . $vergang . " ml \n ";
    echo "<br>Differenz von heute zu gestern " . $diffgegve. " ml \n ";
    if(isset($summedreitage)){
        echo "<br>Summe der vergangenen drei Tage: " . $summedreitage." ml <br> (von $vorgestern bis $gestern) \n ";
    }
}
echo "<br>Letzte Gewichtsangabe: " . $lastG. " g (".$lastD.") ";
if(isset($diffgegvegw)){
    echo "<br>Differenz zur letzten Gewichtsangabe (vom $lastDD): " . $diffgegvegw. " g  \n ";
}


echo "<br>Letzte Größenangabe: " . $lastGs. " cm. (".$lastDs.") ";
if(isset($diffgegvegw)){
    echo "<br>Differenz zur letzten Größenangabe (vom $lastDDs): " . $diffgegvegs. " cm  \n <br>";
}



$jcle = file_get_contents('jsonvalv.txt') or die("Kann Datenbankdatei nicht öffnen!");
$jsod = (json_decode($jcle, false));

$jclel = file_get_contents('gewicht.txt') or die("Kann Datenbankdatei nicht öffnen!");
$jsodl = (json_decode($jclel, false));

$jcleg = file_get_contents('groesse.txt') or die("Kann Datenbankdatei nicht öffnen!");
$jsodg = (json_decode($jcleg, false));



$time = time();
$lastmonth = date("m", strtotime("first day of previous month"));
$actyear = date("Y", strtotime("first day of previous month"));


$lastlastmonth = date("j-n-Y", strtotime("last day of previous month"));

$listlm=array();
$listnm=array();
$month = $lastmonth;
$year = $actyear;
$nmonth = (date('m'));


for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month)       
        $listlm[]=date('d-m-Y', $time);
}

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $nmonth, $d, $year);          
    if (date('m', $time)==$nmonth)       
        $listnm[]=date('d-m-Y', $time);
}




foreach ($jsod as $topping) {
    
    if (in_array(($topping -> Datum), $listlm)){
         $massem[$topping->Datum] = $topping->Menge;
    }
    if (in_array(($topping -> Datum), $listnm)){
         $massenm[$topping->Datum] = $topping->Menge;
    }    
   

}


foreach ($jsodl as $tapping) {
    
    if (in_array(($tapping -> Datum), $listlm)){
         $gewem[$tapping->Datum] = $tapping->Gewicht;
    }
    if (in_array(($tapping -> Datum), $listnm)){
         $gewenm[$tapping->Datum] = $tapping->Gewicht;
    }    
   

}

foreach ($jsodg as $tipping) {
    
    if (in_array(($tipping -> Datum), $listlm)){
         $gswem[$tipping->Datum] = $tipping->Groesse;
    }
    if (in_array(($tipping -> Datum), $listnm)){
         $gswenm[$tipping->Datum] = $tipping->Groesse;
    }    
   

}



$vallMonth = array_sum(array_values($massem));
$valnMonth = array_sum(array_values($massenm));
$valdMonth = $vallMonth - $valnMonth;

$valglMontha = array_values(array_slice($gewem, -1))[0];
$valglMonthb = array_values($gewem);
$valglMonthc = reset($valglMonthb);
$valgnMontha = array_values(array_slice($gewenm, -1))[0];
$valgnMonthb = array_values($gewenm);
$valgnMonthc = reset($valgnMonthb);

$valgslMontha = array_values(array_slice($gswem, -1))[0];
$valgslMonthb = array_values($gsewem);
$valgslMonthc = reset($valgslMonthb);
$valgsnMontha = array_values(array_slice($gswenm, -1))[0];
$valgsnMonthb = array_values($gswenm);
$valgsnMonthc = reset($valgsnMonthb);


$valglMonth = $valglMontha - $valglMonthc;
$valgnMonth = $valgnMontha - $valgnMonthc;

$valgslMonth = $valgslMontha - $valgslMonthc;
$valgsnMonth = $valgsnMontha  - $valgsnMonthc;


echo "Letzten Monat insgesamt getrunken: ".$vallMonth. "ml <br>";
echo "In diesem Monat bislang getrunken: ".$valnMonth. "ml <br>";
echo "Differenz zwischen diesem und letztem Monat: ".$valdMonth. "ml <br><br>";

echo "Im letzten Monat zugenommen: ".$valglMonth. "g <br>";
echo "In diesem Monat bislang zugenommen: ".$valgnMonth. "g <br>";
echo "Differenz zwischen diesem und letztem Monat: ".($valglMonth-$valgnMonth). "g <br><br>";

echo "Im letzten Monat größer geworden: ".$valgslMonth. "cm <br>";
echo "In diesem Monat bislang größer geworden: ".$valgsnMonth. "cm <br>";
echo "Differenz zwischen diesem und letztem Monat: ".($valgslMonth-$valgsnMonth). "cm <br><br>";

?>



    </div></div>

</body>
</html>
