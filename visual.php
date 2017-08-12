    <title>Visualisierung 1</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

    <meta charset="utf-8">
    
       <link rel="stylesheet" type="text/css" href="responsiveform.css">

<link rel="stylesheet" media="screen and (max-width: 1200px) and (min-width: 601px)" href="responsiveform1.css" />
<link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 351px)" href="responsiveform2.css" />
<link rel="stylesheet" media="screen and (max-width: 350px)" href="responsiveform3.css" />
    <style>

        body {
           
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
            opacity:0.4;}
            
            * {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.box2 {
  display: inline-block;
  width: 500px;
  height: 100px;
  margin: 1em;
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
  <li><a class="active" href="visual.php">Visualisierung: Gewicht und Größe</a></li>
  <li><a  href="visual2.php">Visualisierung: eingenommene Menge</a></li>
    <li><a href="automat.php">Automatisch errechnete Werte</a></li>
</ul>   
<div align="center"> 

   
    <div id="abfrage">
<strong>Verlauf von Gewicht und Größe im Laufe der Zeit:</strong><br></div>

        <form>

<div class="box2">
<script src="https://d3js.org/d3.v3.js"></script>
<script src="d3legend.js"></script>
<script>



        
   var margin = {top: 20, right: 80, bottom: 70, left: 80},
         width = 700 - margin.left,
         height = 300 - margin.top;

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

    d3.tsv("visualb.txt", function(error, data) {
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
            .style("font-size","16px")
            .call(d3.legend)

        setTimeout(function() {
            legend
                .style("font-size","16px")
                .attr("data-style-padding",10)
                .call(d3.legend)
        },1000)

    });

</script></div>
</div>
</div>


</body>
