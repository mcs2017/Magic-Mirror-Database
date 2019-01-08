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

// Getting the input parameter (brand):
$brand = $_GET['brand'];

// Get the attributes of the user with the given username
$query1 = "SELECT CompName 
            FROM Brands 
            JOIN Owns 
            ON Brands.BrandName = Owns.BrandName 
            WHERE Brands.BrandName='$brand'";
// print $query;
$result1 = mysqli_query($dbcon, $query1)
  or die('Query failed: ' . mysqli_error($dbcon));
echo "<div align='center'><h3>Company(ies) owning $brand: </h3></div></br></strong>";
if ($result1->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
    <table  width='50%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Company Name</th>
        </tr>";
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CompName"] . "</td>
            </tr>";
    }
    echo "</table></table>";
} else {
    echo "<div align='center'>Sorry, no result. You are welcome to enrich our database!</div></br>";
}
echo " </br>";


// Collaborate Stores:
// Manipulate stores
echo "<div align='center'><h3>Store(s) collaborating with $brand: </h3></div></br></strong>";
$store = $_GET['store'];
if ($store != NULL) {
    mysqli_query($dbcon, "CALL deleteCol ('$brand', '$store');");
    echo "<div align='center'><font style='color:#FF0000;'>'$brand' - '$store' is deleted! </font></div><br>";
}

// Get the attributes of the user with the given username
$query2 = "SELECT Collaborate.StoreName StoreName, Collaborate.BrandName BrandName, BeautyStores.Website Website
            FROM Collaborate 
            JOIN Brands ON Collaborate.BrandName = Brands.BrandName
            JOIN BeautyStores ON BeautyStores.StoreName = Collaborate.StoreName 
            WHERE Collaborate.BrandName = '$brand';";
// print $query2;
$result2 = mysqli_query($dbcon, $query2)
  or die('Query failed: ' . mysqli_error($dbcon));


if ($result2->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
    <table  width='50%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Store Name</th>
        <th>Website</th>
        <th>Delete</th>
        </tr>";
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["StoreName"] . "</td>
            <td>" . $row["Website"] . "</td>
            <td><a href='one_brand.php?brand=" . 
            urlencode($row["BrandName"]) . "&store=" . 
            urlencode($row["StoreName"]) . "'>" . "<input type='submit' value='Delete'>" . "</a></td>
            </tr>";
    }
    echo "</table></table>";
} else {
    echo "<div align='center'>Sorry, no result. You are welcome to enrich our database!</div></br>";
}
echo "<div align='center'>
    <a href='add_col.php?brand=" . urlencode($brand) . "'>" 
        ."Add a new store the brand collaborates with". "</a></div><br>";
// echo "<div align='center'><font style='color:blue;', size='18'>
//     <a href='add_col.php?brand=" . $brand . "'>
//     <input type='submit' value='Add a new store the brand collaborates with' >
//     </a></font></div><br>";
echo "<br>";




echo "<div align='center'><h3>Products of $brand are sold in these countries: </h3></div></br></strong>";
// Manipulate countries
$country = $_GET['country'];
if ($country != NULL) {
    mysqli_query($dbcon, "CALL deleteSoldIn ('$brand', '$country');");
    echo "<div align='center'><font style='color:#FF0000;'>'$brand' - '$country' is deleted! </font></div><br>";
}
$query3 = "SELECT BrandName, CountryName FROM Brands NATURAL JOIN SoldIn WHERE BrandName='$brand'";
// print $query;
$result3 = mysqli_query($dbcon, $query3)
  or die('Query failed: ' . mysqli_error($dbcon));



if ($result3->num_rows > 0) {
    echo "<table width='100%'   height='100%' border='0'   cellspacing='0'   cellpadding='0'>
    <table  width='50%'   border='1'   align='center'   cellpadding='0'   cellspacing='2'>
        <tr>
        <th>Country Name</th>
        <th>Delete</th>
        </tr>";
    // output data of each row
    while($row = $result3->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CountryName"] . "</td>
            <td><a href='one_brand.php?brand=" . 
            urlencode($row["BrandName"]) . "&country=" . 
            $row["CountryName"] . "'>" . "<input type='submit' value='Delete'>" . "</a></td>
            </tr>";
    }  
    echo "</table></table>";
} else {
    echo "<div align='center'>Sorry, no result. You are welcome to enrich our database!</div></br>";
}


echo "<div align='center'><a href='add_soldin.php?brand=" 
        . urlencode($brand) . "'>" ."Add a new country the brand is sold in". "</div></a>";

// Free result
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result3);

// Closing connection
mysqli_close($dbcon);
?>
</p>    


<div align='center'>
    <form method=get action="all_brands.php">
        <input type="submit" value="Go Back">
    </form>
</div>

<div id="copyright">
    <p>Created by Mengchen Shi. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. | This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license.</p>
</div>
        
</body>
</html>