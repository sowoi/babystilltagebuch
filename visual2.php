  <title>Visualisierung 2</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

    <meta charset="utf-8">
    
       <link rel="stylesheet" type="text/css" href="responsiveform.css">

<link rel="stylesheet" media="screen and (max-width: 1200px) and (min-width: 601px)" href="responsiveform1.css" />
<link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 351px)" href="responsiveform2.css" />
<link rel="stylesheet" media="screen and (max-width: 350px)" href="responsiveform3.css" />
    <style>

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
  <li><a href="index.php">Hauptseite</a></li>
  <li><a  href="summary.php">Übersicht über alle Eintragungen</a></li>
  <li><a href="visual.php">Visualisierung: Gewicht und Größe</a></li>
  <li><a class="active" href="visual2.php">Visualisierung: eingenommene Menge</a></li>
    <li><a href="automat.php">Automatisch errechnete Werte</a></li>
</ul>   
<div align="center"> 

   
    <div id="abfrage">
<strong>Menge an Essen pro Tag</strong><br></div>
        <form>

<div class="box2">
    
    
<script src="https://d3js.org/d3.v3.min.js"></script>

<script>
    // set the dimensions of the canvas
   var margin = {top: 20, right: 80, bottom: 70, left: 80},
         width = 600 - margin.left,
         height = 300 - margin.top;


    // set the ranges
    var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);

    var y = d3.scale.linear().range([height, 0]);

    // define the axis
    var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom")


    var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(10);


    // add the SVG element
    var svg = d3.select("body").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform",
                    "translate(" + margin.left + "," + margin.top + ")");


    // load the data
    d3.json("jsonvalv.txt", function(error, data) {

        data.forEach(function(d) {
            d.Datum = d.Datum;
            d.Menge = +d.Menge;
        });

        // scale the range of the data
        x.domain(data.map(function(d) { return d.Datum; }));
        y.domain([0, d3.max(data, function(d) { return d.Menge; })]);

        // add axis
        svg.append("g")
                .attr("class", "x axis")
                .attr("transform", "translate(0," + height + ")")
                .call(xAxis)
                .selectAll("text")
                .style("text-anchor", "end")
                .attr("dx", "-.8em")
                .attr("dy", "-.55em")
                .attr("transform", "rotate(-90)" );

        svg.append("g")
                .attr("class", "y axis")
                .call(yAxis)
                .append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 5)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .text("Menge");


        // Add bar chart
        svg.selectAll("bar")
                .data(data)
                .enter().append("rect")
                .attr("class", "bar")
                .attr("x", function(d) { return x(d.Datum); })
                .attr("width", x.rangeBand())
                .attr("y", function(d) { return y(d.Menge); })
                .attr("height", function(d) { return height - y(d.Menge); });

    });

</script></div>
</body>
