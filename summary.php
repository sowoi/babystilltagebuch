<!DOCTYPE html>
<head>
    <title>Alle Einträge</title>


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

a[href$=".txt"]{

    width:70%;
    padding: 5px;
    border-radius:5px;
    border:1px solid #000;
    background-color: #173c66;
    color: aliceblue;
    font-size:15px;
    cursor:pointer;
    text-decoration: none;
    
}


a:hover, a:active {
    background-color: grey;
}
</style>   
</head>
<body>
    <ul class="topnav">
  <li><a href="index.php">Hauptseite</a></li>
  <li><a class="active" href="auflistary.php">Übersicht über alle Eintragungen</a></li>
  <li><a href="visual.php">Visualisierung: Gewicht und Größe</a></li>
  <li><a href="visual2.php">Visualisierung: eingenommene Menge</a></li>
    <li><a href="automat.php">Automatisch errechnete Werte</a></li>
</ul>   
    
    
    <button onclick="topFunction()" id="myBtn" title="Go to top">Nach oben</button>

<div align="center">    
    <div id="abfrage">
        <form>

        <input type="button" value="Springe zu Gewicht" class="homebutton" id="btnHome" onClick="Javascript:window.location.href = 'summary.php#gewicht';" />
        <input type="button" value="Springe zu Größe" class="homebutton" id="btnHome" onClick="Javascript:window.location.href = 'summary.php#groesse';" /></form>
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
$all = file_get_contents('jsonval.txt');
$json = json_decode($all, true); 
$allgew = file_get_contents('gewicht.txt');
$json2 = json_decode($allgew, true); 
$allges = file_get_contents('groesse.txt');
$json3 = json_decode($allges, true); 
echo "Es gibt insgesamt: ".count($json)." Mengeneintragung(en), ".count($json2)." Gewichtseintragung(en) und ".count($json3)." Größeneintragung(en).<br>";
echo "<br><div id='auflist'>";
echo "<h2 id='menge'>Alle Mengeneintragungen</h2></u>";

    echo '<table>';
    echo '<tr>';

foreach($json as $k=>$val):
    echo '<tr>';
    echo '<th>';
            $k = $k + 1;
    echo '<b>Eintrag: '.$k.'</b>';
    echo '</th>';

    $keys = array_keys($val);
    
    foreach($keys as $key):
    echo '<th>';
        echo '&nbsp;'.ucfirst($key).' = '.$val[$key].'</br>';
    echo '<th>';     
    endforeach;

endforeach;
    echo '</tr>';
    echo '</table>';
    echo "<br><a href='jsonval.txt'>Backup aller Mengen runterladen</a>";


echo "</div>";

echo "<br><div id='auflist'>";
echo "<h2 id='gewicht'>Alle Gewichtseintragungen</h2>";



$allgew = file_get_contents('gewicht.txt');
$json2 = json_decode($allgew, true); 

//echo '<pre>' . print_r($json, true) . '</pre>';

    echo '<table>';
    echo '<tr>';

foreach($json2 as $k=>$val):
    echo '<tr>';
    echo '<th>';
    $k = $k + 1;
    echo '<b>Eintrag: '.$k.'</b>';
    echo '</th>';

    $keys = array_keys($val);
    
    foreach($keys as $key):
    echo '<th>';
        echo '&nbsp;'.ucfirst($key).' = '.$val[$key].'</br>';
    echo '<th>';     
    endforeach;

endforeach;
    echo '</tr>';
    echo '</table>';
    echo "<br><a href='gewicht.txt'>Backup aller Gewichte runterladen</a>";
    
echo "</div>";    
echo "<br><div id='auflist'>";    
echo "<h2 id='groesse'>Alle Größeneintragungen</h2>";

$allges = file_get_contents('groesse.txt');
$json3 = json_decode($allges, true); 

//echo '<pre>' . print_r($json, true) . '</pre>';

    echo '<table>';
    echo '<tr>';

foreach($json3 as $k=>$val):
    echo '<tr>';
    echo '<th>';
    $k = $k + 1;
    echo 'Eintrag: '.$k.'';
    echo '</th>';

    $keys = array_keys($val);
    
    foreach($keys as $key):
    echo '<th>';
        echo '&nbsp;'.ucfirst($key).' = '.$val[$key].'</br>';
    echo '<th>';     
    endforeach;

endforeach;
    echo '</tr>';
    echo '</table>';
    echo "<br><a href='groesse.txt'>Backup aller Größen runterladen</a>";

echo "</div>";  
echo "<br>";

?>

    </div></div>
<br>
</body>
</html>
