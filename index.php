<!DOCTYPE html>
<head>
  <title>Liz Enni Ahmed</title>

<meta charset="utf-8">
<style>

    body {
        font: 10px sans-serif;
    }

    .axis path,
    .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
    }

    .x.axis path {
        display: none;
    }

    .line {
        fill: none;
        stroke: steelblue;
        stroke-width: 1.5px;
    }

    .legend rect {
        fill:white;
        stroke:black;
        opacity:0.8;}

</style>
</head>
<body>

<br><br>
<center>
    <form action="index.php" method="get">

        <p>Datum:<br>
            <input type="Text" name="datum" value='<?php echo date('d-m-Y');?>'></p>

        <p>Zeit:<br>
            <input type="Text" name="zeit" value='<?php echo date('H:i');?>'></p>

        <p>Menge:<br>
            <input type="Text" name="menge"></p>

        <p>Gewicht:<br>
            <input type="Text" name="gewicht"></p>

        <p>Größe:<br>
            <input type="Text" name="groesse"></p>


        <input type="Submit" name="" value="speichern">

    </form>

</center>





    <?php

    if ( isset($_GET['datum']) <> "" )
    {

        $handle = fopen ( "input.txt", "a" );
        $handle2 = fopen ( "json.txt", "a" );
        $handle3 = fopen ( "gewicht.txt", "a" );
        $handle4 = fopen ( "groesse.txt", "a" );
        $handle5 = fopen ("visual.txt", "a");

        $data = $_GET['datum'];
        $datb = date('Ymd');
        $nama = $_GET['zeit'];
        $menga = $_GET['menge'];
        $gewichta = $_GET['gewicht'];
        $groessa = $_GET['groesse'];
        $groessb = $_GET['groesse']. PHP_EOL;


        $jclgwo = file_get_contents('gewicht.txt');
        $jclgso = file_get_contents('groesse.txt');
        $jclgsjo = (json_decode($jclgso, false));
        $jclgwjo = (json_decode($jclgwo, false));
        $gjwicht = array();
        $gjwdato = array();
        $gjsseo = array();
        $gjwdatso = array();

        foreach ($jclgwjo as $topp) {
            $gjwichto[] = $topp -> Gewicht;
            $lastG = (int)end($gjwichto);

        }


        foreach ($jclgsjo as $toppa) {
            $gjsseo[] = $toppa -> Groesse;
            $lastGs = (int)end($gjsseo);
            $lastGss = $lastGs.PHP_EOL;

        }



        if((empty($menga)) and (empty($gewichta)) and (empty($groessa))){

            echo "<br><br><center>Bitte Werte eingeben!</center>";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<center><a href='$url'>Zurück</a></center>";


        }elseif((empty($menga))  and (empty($gewichta)) and (empty($groessa)))
        {

            echo "<br><br><center>Bitte eine Menge angeben. \n</center>";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<center><a href='$url'>Zurück</a></center>";

        }elseif (!(empty($menga)) and !(is_numeric($menga)) and (empty($gewichta)) and (empty($groessa))) {

            echo "<br><br><center>Bitte nur Zahlen bei Menge eingeben.</center>";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<center><a href='$url'>Zurück</a></center>";

        }
        elseif (!(empty($_GET['gewicht']))  and !(is_numeric($_GET['gewicht']))) {

            echo "<br><br><center>Bitte nur Zahlen bei Gewicht eingeben.</center>";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<center><a href='$url'>Zurück</a></center>";

        }elseif (!(empty($_GET['groesse'])) and !(is_numeric($_GET['groesse']))) {

            echo "<br><br><center>Bitte nur Zahlen bei Größe eintragen.</center>";
            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
            echo "<center><a href='$url'>Zurück</a></center>";

        }else{
            if(!empty($menga)){
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
            if(!empty($gewichta) and !empty($grossa)){
                fwrite ($handle5, $datb);
                fwrite ( $handle5, "\t");
                fwrite ($handle5, $gewichta);
                fwrite ( $handle5, "\t" );
                fwrite($handle5, $groessb);
            }elseif(!empty($_GET['gewicht'])){
                $myObj2->Datum = $data;
                $myObj2->Gewicht = $gewichta;
                $myJSON2 = json_encode($myObj2);
                fwrite ($handle5, $datb);
                fwrite ( $handle5, "\t");
                fwrite ($handle5, $gewichta);
                if (empty($groessa) and !empty($gewichta)){
                    fwrite ( $handle5, "\t" );
                    fwrite($handle5, $lastGss);
                }else{
                    fwrite ( $handle5, "\t" );
                    fwrite($handle5, $groessb);

                }
                fwrite ($handle3, $myJSON2);
            }elseif(!empty($_GET['groesse'])){
                $myObj4->Datum = $data;
                $myObj4->Groesse = $groessa;
                $myJSON4 = json_encode($myObj4);
                fwrite ($handle5, $datb);
                fwrite ( $handle5, "\t" );
                if (empty($gewichta)){
                    fwrite($handle5, $lastG);
                }else{
                    fwrite($handle5, $gewichta);
                }
                fwrite ( $handle5, "\t" );
                fwrite($handle5, $groessb);
                fwrite ($handle4, $myJSON4);
            }
            fwrite ( $handle2, $myJSON);
            header( 'HTTP/1.1 303 See Other' );
            header( "Location: index.php" );
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

        $file8 = 'visual.txt';
        $vurrenta = file_get_contents($file8);
        $add = "[ <br>";
        $vurrentb = $add.$vurrenta;
        file_put_contents($file8, $vurrentb);


        exit;

    }
    ?>

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

    <?php


    echo "<center><strong> Die letzten 5 Einträge </strong> <br />";
    $data = array_slice(file('input.txt'), -5);
    foreach ($data as $line) {
        echo "<pre>$line</pre>";
    }
    echo "</center>";


    $jcle = file_get_contents('jsonval.txt') or die("Kann Datenbankdatei nicht öffnen!");
    $jsod = (json_decode($jcle, false));

    $jclgw = file_get_contents('gewicht.txt');
    $jclgs = file_get_contents('groesse.txt');
    $jclgsj = (json_decode($jclgs, false));
    $jclgwj = (json_decode($jclgw, false));

    //var_dump($jsod);
    //echo $jsod[1]->Menge;
    //echo $jsod[2]->Menge;
    //echo $jsod[3]->Menge;

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


    foreach ($jsod as $topping) {
        //echo $topping -> Menge, "<br>";
        //echo "\n";
        //$masse[i]=$topping->Menge;
        //$i++;
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

    foreach ($jclgwj as $topp) {
        $gjwicht[] = $topp -> Gewicht;
        $lastG = (int)end($gjwicht);
        $gjwdat[] = $topp -> Datum;
        $lastD = end($gjwdat);
    }


    foreach ($jclgsj as $toppa) {
        $gjsse[] = $toppa -> Groesse;
        $lastGs = (int)end($gjsse);
        $gjwdats[] = $topp -> Datum;
        $lastDs = end($gjwdats);
    }


    $gegenwa = array_sum($tages);
    $vergang = array_sum($tagesj);
    $diffgegve = $gegenwa - $vergang;
    if((isset($tagesj)) and (isset($tagesjj)) and (isset($tagesjjj))){
        $summedreitage = array_sum($tagesj)+array_sum($tagesjj)+array_sum($tagesjjj);
    }


    echo "<center><br>Heute getrunken: " . $gegenwa . " ml \n </center>";
    if(isset($tagesj)){
        echo "<center><br>Gestern getrunken: " . $vergang . " ml \n </center>";
        echo "<center><br>Differenz gestern und heute " . $diffgegve. " ml \n </center>";
        if(isset($summedreitage)){
            echo "<center><br>Summe der vergangenen drei Tage: " . $summedreitage. " ml (von $vorgestern bis $gestern) \n </center>";
        }
    }

    echo "<center><br>Insgesamt getrunken: " . array_sum($masse) . " ml \n </center>";
    echo "<center><br>Letzte Gewichtsangabe: " . $lastG. " g. (".$lastD.") </center>";


    echo "<center><br>Letzte Größenangabe: " . $lastGs. " cm. (".$lastDs.") </center>";





    ?>
<script src="http://d3js.org/d3.v3.js"></script>
<script src="d3.legend.js"></script>
<script>


    var margin = {top: 20, right: 80, bottom: 30, left: 50},
        width = 960 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    var parseDate = d3.time.format("%Y%m%d").parse;

    var x = d3.time.scale()
        .range([0, width]);

    var y = d3.scale.linear()
        .range([height, 0]);

    var color = d3.scale.category10();

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left");

    var line = d3.svg.line()
        .interpolate("basis")
        .x(function(d) { return x(d.date); })
        .y(function(d) { return y(d.temperature); });

    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    d3.tsv("visual.txt", function(error, data) {
        color.domain(d3.keys(data[0]).filter(function(key) { return key !== "date"; }));

        data.forEach(function(d) {
            d.date = parseDate(d.date);
        });

        var cities = color.domain().map(function(name) {
            return {
                name: name,
                values: data.map(function(d) {
                    return {date: d.date, temperature: +d[name]};
                })
            };
        });

        x.domain(d3.extent(data, function(d) { return d.date; }));

        y.domain([
            d3.min(cities, function(c) { return d3.min(c.values, function(v) { return v.temperature; }); }),
            d3.max(cities, function(c) { return d3.max(c.values, function(v) { return v.temperature; }); })
        ]);

        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Mass");

        var city = svg.selectAll(".city")
            .data(cities)
            .enter().append("g")
            .attr("class", "city");

        city.append("path")
            .attr("class", "line")
            .attr("d", function(d) { return line(d.values); })
            .attr("data-legend",function(d) { return d.name})
            .style("stroke", function(d) { return color(d.name); });

        city.append("text")
            .datum(function(d) { return {name: d.name, value: d.values[d.values.length - 1]}; })
            .attr("transform", function(d) { return "translate(" + x(d.value.date) + "," + y(d.value.temperature) + ")"; })
            .attr("x", 3)
            .attr("dy", ".35em")
            .text(function(d) { return d.name; });


        legend = svg.append("g")
            .attr("class","legend")
            .attr("transform","translate(50,30)")
            .style("font-size","12px")
            .call(d3.legend)

        setTimeout(function() {
            legend
                .style("font-size","20px")
                .attr("data-style-padding",10)
                .call(d3.legend)
        },1000)

    });

</script>


</div>
</body>
</html>
