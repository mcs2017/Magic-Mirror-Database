<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>Add new stores the brand collaborates with</title>
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


<div align='center'><h3>Add new stores that collaborate with the brand: </h3></div></br></strong>
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

// Getting the input parameter (user):
$brand = $_GET['brand'];
$store = $_POST['store'];


// // go back to the brand
// echo "<div align='center'>
//     <form method='get' action='one_brand.php?brand=". $brand ."'>
//         <input type='submit' value='Go back to the brand'>
//     </form>
//     </div>";


if ($store != NULL) { 
    $brand = $_POST['brand'];
    $query = "CALL addCol ('$brand', '$store');";

    if (!mysqli_query($dbcon, $query)){
        if(mysqli_errno($dbcon) == $MYSQL_CODE_DUPLICATE_KEY){
            echo "<div align='center'>Failed: '$store' - '$brand' already exists in our database. Please add a new store.</div><br>";
        }else{
            echo "<div align='center'>Failed: " . mysqli_error($dbcon). "<br>";
        }
    }else{
        echo "<div align='center'><font style='color:#FF0000;'>Collaboration '$store' - '$brand' is added successfully!</font></div><br>" ;
    }
}

$opstore = "";
$notyet = "SELECT StoreName FROM BeautyStores WHERE StoreName NOT IN
    (SELECT StoreName FROM Collaborate WHERE BrandName = '$brand');";
$allstore = mysqli_query($dbcon, $notyet);
if ($allstore->num_rows > 0) {
    while ($row = $allstore->fetch_assoc()) {
        $opstore = $opstore . "<option value='" . $row['StoreName'] ."'>" . $row['StoreName'] . "</option>";
    }
    echo "<div align='center'><form action='add_col.php' method='post' >
    Brand: <input type='radio' name='brand' value='$brand' checked> '$brand'<br>
    Stores that have not collaborated with the brand include: <br>
    <select name='store'>" . $opstore .
    "</select>
    </br>
    <div>
        <input type='submit' value='ADD'></input>
    </div></div>";
}else {
    echo "<div align='center'><font style='color:#FF0000;'>$brand is available at all the stores in our database already. </font></div>";
}

?>


<div id="copyright">
    <p>Created by Mengchen Shi. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. | This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license.</p>
</div>
        
</body>
</html>