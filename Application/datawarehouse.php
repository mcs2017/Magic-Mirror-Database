<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>Data Warehouse</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="./templated/default.css" rel="stylesheet" type="text/css" media="all" />
        <link href="./templated/fonts.css" rel="stylesheet" type="text/css" media="all" />
        

</head>

<body>
    <div id="header-wrapper">
            <div id="header" class="container">
                    <div id="logo">
                        <h1><a href="#">Magic Mirror</a></h1>
                        <p><a href="http://templated.co" rel="nofollow">Find the best makeup products just for you</a></p>
                    </div>
                    <div id="banner"> <a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a> </div>
            </div>
    </div>
        
	<div id="menu-wrapper">
            <div id="menu" class="container">
                    <ul>
                        <li><a href="./index.html">Home</a></li>
                        <li><a href="./all_companies.php">Explore by Company</a></li>
                        <li><a href="./all_brands.php">Explore by Brand</a></li>
                        <li><a href="./search_product.php">Search Product</a></li>
                        <li><a href="./add_product.php">Add Product</a></li>
                        <li><a href="./applyto.php">Fit my skin</a></li>
                        <li class="current_page_item"><a href="./datawarehouse.php">Data Warehouse</a></li>
                    </ul>
            </div>
                <!-- end #menu --> 
    </div>


<p>
<?php

// Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'mshi17';
$password = '87475636';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
// print 'Connected successfully!<br>';
mysqli_set_charset($dbcon, 'utf8mb4');

// Analyze average rates of companies' products
echo "<h4 align='center'>Compare avg rate of products provided by each company:</h4>";
echo "<div align='center'> Three tables involved in this analysis: Products, Owns, and Companies</div>";
$query = "SELECT CompName, AVG(Rate) AS AvgRate
        FROM Companies
        NATURAL JOIN Owns
        NATURAL JOIN Products
        GROUP BY CompName
        ORDER BY AvgRate DESC;";
// print $query;
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));


if ($result->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
    <table  width='30%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Company</th>
        <th>AvgRate</th>
        </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CompName"] . "</td>
            <td>" . $row["AvgRate"] . "</td>
            </tr>";
    }
    echo "</table></table>";
} else {
    echo "<div align='center'> Sorry, no result. You are welcome to enrich our database!</div><br>";
}
// Free result
mysqli_free_result($result);




// second analysis
echo "<h4 align='center'>Compare avg price and rate of foundations for each kind formula made by different brands:</h4>";
echo "<div align='center'> Three tables involved in this analysis: Products, Foundations, and Brands</div>";
$query = "SELECT BrandName, Formula, 
        COUNT(*) AS Number, AVG(Price) AS AvgPrice, AVG(Rate) AS AvgRate
        FROM Foundations 
        NATURAL JOIN Products 
        NATURAL JOIN Brands 
        GROUP BY BrandName, Formula
        ORDER BY BrandName, Formula, AvgPrice, AvgRate, Number;";
// print $query;
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));


if ($result->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
    <table  width='50%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Brand</th>
        <th>Formula</th>
        <th>Number</th>
        <th>AvgPrice</th>
        <th>AvgRate</th>
        </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["BrandName"] . "</td>
            <td>" . $row["Formula"] . "</td>
            <td>" . $row["Number"] . "</td>
            <td>" . $row["AvgPrice"] . "</td>
            <td>" . $row["AvgRate"] . "</td>
            </tr>";
    }
    echo "</table></table>";
} else {
    echo "<div align='center'> Sorry, no result. You are welcome to enrich our database!</div><br>";
}


// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>

</p>



<div id="copyright">
        <p>Created by Mengchen Shi. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. | This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license.</p>
</div>
        
</body>
</html>