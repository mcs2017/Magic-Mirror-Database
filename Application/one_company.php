<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>Company Information</title>
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
                        <li class="current_page_item"><a href="./all_companies.php">Explore by Company</a></li>
                        <li><a href="./all_brands.php">Explore by Brand</a></li>
                        <li><a href="./search_product.php">Search Product</a></li>
                        <li><a href="./add_product.php">Add Product</a></li>
                        <li><a href="./applyto.php">Fit my skin</a></li>
                        <li><a href="./datawarehouse.php">Data Warehouse</a></li>
                    </ul>
            </div>
                <!-- end #menu --> 
    </div>
<h2 align="center">Company Information:</h2>

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

// Getting the input parameter (company):
$comp = $_GET['company'];

// Get the attributes of the company with the given username
$query1 = "SELECT * 
            FROM Companies 
            NATURAL JOIN HQin 
            NATURAL JOIN Countries 
            WHERE CompName='$comp'";
// print $query1;
$result1 = mysqli_query($dbcon, $query1)
  or die('Query failed: ' . mysqli_error($dbcon));



if ($result1->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
    <table  width='50%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Head Quarter (Country)</th>
        <th>Found Year</th>
        <th>Continent</th>
        </tr>";
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CountryName"] . "</td>
            <td>" . $row["FoundYear"] . "</td>
            <td>" . $row["Continent"] . "</td>
            </tr>";
    }
    echo "</table></table>";
} else {
    echo "<div align='center'>Sorry, no result. You are welcome to enrich our database!</div></br>";
}
echo " </br>";
// Free result
mysqli_free_result($result1);

echo "<h2 align='center'>Brands owned by $comp: </h2></br>";

$comp = $_GET['company'];
$brand = $_GET['brand'];
if ($brand != NULL) {
    mysqli_query($dbcon, "CALL deleteOwns ('$brand', '$comp');");
    echo "<div align='center'><font style='color:#FF0000;'>'$brand' - '$comp' is deleted! </font></div><br>";
}


$query2 = "SELECT CompName, BrandName FROM Companies NATURAL JOIN Owns WHERE CompName='$comp'";

// print $query;
$result2 = mysqli_query($dbcon, $query2)
  or die('Query failed: ' . mysqli_error($dbcon));

if ($result2->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
    <table  width='50%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Company Name</th>
        <th>Brand Name</th>
        <th>Delete</th>
        </tr>";
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CompName"] . "</td>
            <td>" . $row["BrandName"] . "</td>
            <td><a href='one_company.php?brand=" . 
            urlencode($row["BrandName"]) . "&company=" . 
            urlencode($row["CompName"]) . "'>" .    "<input type='submit' value='Delete'>" . "</a></td>
            </tr>";
    }
    echo "</table></table>";
} else {
    echo "<div align='center'>Sorry, no result. You are welcome to enrich our database!</div></br>";
}


// Free result
mysqli_free_result($result2);

// Closing connection
mysqli_close($dbcon);
?>

</p>
<div align='center'>
    <form method=get action="all_companies.php">
        <input type="submit" value="Go Back">
    </form>
</div>


<div id="copyright">
    <p>Created by Mengchen Shi. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. | This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license.</p>
</div>
        
</body>
</html>