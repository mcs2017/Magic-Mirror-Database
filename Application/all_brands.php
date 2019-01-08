<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>FindByBrand</title>
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
                        <li class="current_page_item"><a href="./all_brands.php">Explore by Brand</a></li>
                        <li><a href="./search_product.php">Search Product</a></li>
                        <li><a href="./add_product.php">Add Product</a></li>
                        <li><a href="./applyto.php">Fit my skin</a></li>
                        <li><a href="./datawarehouse.php">Data Warehouse</a></li>
                    </ul>
            </div>
                <!-- end #menu --> 
    </div>
<h1 align="center">Brands in alphabetical order:</h1>
<p>
<?php

// Connection parameters
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'mshi17';
$password = '87475636';
$database = $username.'DB';


// Attempting to connect

$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
// print 'Connected successfully!<br>';
mysqli_set_charset($dbcon, 'utf8mb4');

// Selecting a database
mysqli_select_db($dbcon, $database)
   or die('Could not select database');
// print 'Selected database successfully!<br>';

// Listing table Brands in your database
$query = 'SELECT DISTINCT BrandName, FoundYear, Website FROM Brands ORDER BY BrandName';
$result = mysqli_query($dbcon, $query)
  or die('Show tables failed: ' . mysqli_error());


echo "<div align='center'>Click brand names to find more!</div></br>";
if ($result->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
        <table  width='50%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Brand Name</th>
        <th>Found Year</th>
        <th>Website</th>
        </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td><a href='one_brand.php?brand=". urlencode($row['BrandName']). "'>" . $row['BrandName'] . "</a></td>
            <td>" . $row["FoundYear"] . "</td>
            <td>" . $row["Website"] . "</td>
              </tr>";
    }
    echo "</table></table>";
} else {
    echo "<div align='center'>Sorry, no results. You are welcome to enrich our database!</div>";
}



// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>


<div id="copyright">
    <p>Created by Mengchen Shi. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. | This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license.</p>
</div>
        
</body>
</html>