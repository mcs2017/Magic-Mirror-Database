<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>Fit My Skin</title>
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
                    <li class="current_page_item"><a href="./applyto.php">Fit my skin</a></li>
                    <li><a href="./datawarehouse.php">Data Warehouse</a></li>
                </ul>
        </div>
            <!-- end #menu --> 
    </div>

    <div id='page' class='container'>
        <div class='title'>
            <h1>What products fit my skin type?</h1>
        </div>
        <p>
        <form method=get action="applyto.php">
            <b>Select your skin type:</b><br>
            <a href="skintype.php">Click here if you are not sure about your skin type.</a><br>
            <p>
                <input type="radio" name="skintype" value="Oily" checked> Oily<br>
                <input type="radio" name="skintype" value="Dry"> Dry<br>
                <input type="radio" name="skintype" value="Normal"> Normal<br>
                <input type="radio" name="skintype" value="Combination"> Combination
            </p>
            <b>Select product category:</b><br>
            <p>
                <input type="radio" name="category" value="Foundations" checked> Foundation<br>
                <input type="radio" name="category" value="Concealers"> Concealer<br>
                <input type="radio" name="category" value="Primers"> Primer<br>
            </p>
            <input type="submit" value="Submit">
        </form>
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

// Getting the input parameter (user):
$skintype = $_GET['skintype'];
$category = $_GET['category'];

if ($skintype != NULL) {
    $query = "SELECT * FROM ApplyTo 
    NATURAL JOIN Products WHERE TypeName='$skintype'
    AND Category='$category';";
    // print $query;
    $result = mysqli_query($dbcon, $query)
        or die("<div align='center'Query failed: " . mysqli_error($dbcon));
    if ($result->num_rows > 0) {
        echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
        <table  width='80%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
            <tr>
            <th>Product Name</th>
            <th>Brand Name</th>
            <th>Type Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Rate</th>
            </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["ProductName"] . "</td>
                <td>" . $row["BrandName"] . "</td>
                <td>" . $row["TypeName"] . "</td>
                <td>" . $row["Category"] . "</td>
                <td>" . $row["Price"] . "</td>
                <td>" . $row["Rate"] . "</td>
                </tr>";
        }
        echo "</table></table>";
        } else {
            echo "<div align='center'> Sorry, no result. You are welcome to enrich our database!</div><br>";
        }
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