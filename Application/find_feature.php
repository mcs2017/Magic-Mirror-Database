<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>FindByFeauture</title>
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
                    <li class="current_page_item"><a href="./search_product.php">Search Product</a></li>
                    <li><a href="./add_product.php">Add Product</a></li>
                    <li><a href="./applyto.php">Fit my skin</a></li>
                    <li><a href="./datawarehouse.php">Data Warehouse</a></li>
                </ul>
        </div>
            <!-- end #menu --> 
        </div>
        <div align='center'><h1 align="center">Search product by features:</h1></div>
        <br> </br>
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

// Getting the input parameter (user):
$category = $_REQUEST['Category'];
$formula = $_REQUEST['Formula'];
$coverage = $_REQUEST['Coverage'];
$finish = $_REQUEST['Finish'];

// Get the attributes of the user with the given username
if ($category == 'Foundation') {
        $query = "SELECT * FROM Foundations 
        NATURAL JOIN Products 
        WHERE Formula='$formula' AND Coverage='$coverage' AND Finish='$finish';";
}elseif ($category == 'Concealer') {
        $query = "SELECT * FROM Concealers
        NATURAL JOIN Products 
        WHERE Formula='$formula' AND Finish='$finish';";
}else {
        $query = "SELECT * FROM Primers
        NATURAL JOIN Products 
        WHERE Finish='$finish';";
}

// print $query;
$result = mysqli_query($dbcon, $query)
  or die("<div align='center'>Query failed: " . mysqli_error($dbcon));


if ($result->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
    <table  width='75%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Product Name</th>
        <th>Brand Name</th>
        <th>Category</th>
        <th>Formula</th>
        <th>Coverage</th>
        <th>Finish</th>
        <th>Price</th>
        <th>Rate</th>
        </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["ProductName"] . "</td>
            <td>" . $row["BrandName"] . "</td>
            <td>" . $category . "</td>
            <td>" . $row["Formula"] . "</td>
            <td>" . $row["Coverage"] . "</td>
            <td>" . $row["Finish"] . "</td>
            <td>" . $row["Price"] . "</td>
            <td>" . $row["Rate"] . "</td>
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

</p>

<div align='center'>
    <form method=get action="search_product.php">
        <input type="submit" value="Go back to search">
    </form>
</div>


</body>
</html>