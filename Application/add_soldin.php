<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>Add new countries the brand is sold in</title>
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


<div align='center'><h3>Add new countries that the brand is sold in: </h3></div></br></strong>
<div align='center'>
    <form method=get action="all_brands.php">
        <input type="submit" value="Go back to all brands">
    </form>
</div>

<p>
<?php

// Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'mshi17';
$password = '87475636';
$database = $username.'DB';
$MYSQL_CODE_DUPLICATE_KEY = 1062;

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
// print 'Connected successfully!<br>';
mysqli_set_charset($dbcon, 'utf8mb4');

// Getting the input parameter (brand and country):
$brand = $_GET['brand'];
$country = $_POST['country'];

if ($country != NULL) { 
    $brand = $_POST['brand'];
    $query = "CALL addSoldIn ('$brand', '$country');";

    if (!mysqli_query($dbcon, $query)){
        if(mysqli_errno($dbcon) == $MYSQL_CODE_DUPLICATE_KEY){
            echo "<div align='center'>Failed: '$country' - '$brand' already exists in our database. Please add a new country.</div><br>";
        }else{
            echo "<div align='center'>Failed: " . mysqli_error($dbcon). "</div><br>";
        }
    }else{
        echo "<div align='center'><font style='color:#FF0000;'>'$country' - '$brand' is added successfully!</font></div><br>" ;
    }
}

$opcountry = "";
$notyet = "SELECT CountryName FROM Countries WHERE CountryName NOT IN
    (SELECT CountryName FROM SoldIn WHERE BrandName = '$brand');";
$allcountry = mysqli_query($dbcon, $notyet);
if ($allcountry->num_rows > 0) {
    while ($row = $allcountry->fetch_assoc()) {
        $opcountry = $opcountry . "<option value='" . $row['CountryName'] ."'>" . $row['CountryName'] . "</option>";
    }
    echo "<div align='center'><form action='add_soldin.php' method='post' >
    Brand: <input type='radio' name='brand' value='$brand' checked> '$brand'<br>
    Add a new country the brand is sold in.<br>
    Countries where the brand is not sold in yet include: <br>
    <select name='country'>" . $opcountry .
    "</select>
    <br>
    <div>
        <input type='submit' value='ADD'></input>
    </div></div>";
}else {
    echo "<div align='center'><font style='color:#FF0000;'>$brand is sold in all countries in our database. </font></div><br>";
}

echo "<div align='center'>
        <form method=get action='one_brand.php?brand='". $brand ."'>
            <input type='submit' value='Go back'></input>
        </form>
    </div>"; 
?>


<!-- <div id="copyright">
    <p>Created by Mengchen Shi. | Design by 
        <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. 
        | This free template is released under the 
        <a href="http://templated.co/license">Creative Commons Attribution</a> 
        license.</p>
</div> -->
        
</body>
</html>