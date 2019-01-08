<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>Add Product</title>
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
                    <li class="current_page_item"><a href="./add_product.php">Add Product</a></li>
                    <li><a href="./applyto.php">Fit my skin</a></li>
                    <li><a href="./datawarehouse.php">Data Warehouse</a></li>
                </ul>
        </div>
            <!-- end #menu --> 
    </div>

    <!-- <div align='center'><h1>Add Products</h1></div> -->


<p>
<?php
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'mshi17';
$password = '87475636';
$database = $username.'DB';
$MYSQL_CODE_DUPLICATE_KEY = 1062;
$MYSQL_CODE_SYNTAX_ERROR = 1064;

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die("<div align='center'>Could not connect: " . mysqli_connect_error());
// print 'Connected successfully!<br>';
mysqli_set_charset($dbcon, 'utf8mb4');


$brand = $_POST['BrandName'];

if ($brand != NULL) { 
    $product = $_POST['ProductName'];
    $price = $_POST['Price'];
    $rate = $_POST['Rate'];
    $category = $_POST['Category'];
    $formula = $_POST['Formula'];
    $coverage = $_POST['Coverage'];
    $finish = $_POST['Finish'];

    // Insert brand into table Brands
    // mysqli_query($dbcon, "INSERT IGNORE INTO Brands(BrandName) VALUES('$brand');") 
    //     or die('Query failed: ' . mysqli_error($dbcon));


    // $query = "INSERT INTO Products VALUES('$brand', '$product', $price, $rate, '$category');";    
    $query = "CALL addProduct('$product', '$brand', $price, $rate, '$category', '$formula', '$coverage', '$finish');";
    if (!mysqli_query($dbcon, $query)){
        if(mysqli_errno($dbcon) == $MYSQL_CODE_DUPLICATE_KEY){
            echo "<div align='center'><font style='color:#FF0000;'>Failed: product 
            '$product' - '$brand' already exists in our database. Please add a new product.</font></div><br>";
        }elseif(mysqli_errno($dbcon) == $MYSQL_CODE_SYNTAX_ERROR){
            echo "<div align='center'><font style='color:#FF0000;'>Bad input. Please do not input single quote(s), i.e., '.</font></div><br>";
        }else{
            echo "<div align='center'>Failed: " . mysqli_error($dbcon). "</div><br>";
        }
    }else{
        echo "<div align='center'><font style='color:#FF0000;'>
        Product '$product' - '$brand' is added successfully!</font></div><br>" ;
    }
}
?>

    <div id='page' class='container'>
        <div class='title'>
            <h1>Add new products</h1>
        </div>
        <form action method='post' name='myform'>
            <p>
            <a>Enter Product Name (255 characters at most):</a><br>
                <input type="text" name="ProductName" required maxlength="255" size="50"/><br>
            <a>Enter Brand Name (100 characters at most):</a><br>
                <input type="text" name="BrandName" required maxlength="100" size="30"/><br>
            <a>Enter Price (a number from 0 to 99999999):</a><br>
                <input type="number" name="Price" required min="0" max="99999999" step="0.01"/><br>
            <a>Enter Rate (a number from 0 to 5):</a><br>
                <input type="number" name="Rate" required min="0" max="5" step="0.001"/><br>
            <a>Choose Category:</a><br>
                <input type="radio" name="Category" value="Foundations" checked> Foundation<br>
                <input type="radio" name="Category" value="Concealers"> Concealer<br>
                <input type="radio" name="Category" value="Primers"> Primer<br>
            <a>Choose Formula: </a><br>
                <input type="radio" name="Formula" value="NULL" checked> "Not applicable" (default for Primers); OR "I do not know." <br>
                <input type="radio" name="Formula" value="Liquid"> Liquid<br>
                <input type="radio" name="Formula" value="Cream"> Cream<br>
                <input type="radio" name="Formula" value="Powder"> Powder<br>
                <input type="radio" name="Formula" value="Stick"> Stick<br>

            <a>Choose Coverage:</a><br>
                <input type="radio" name="Coverage" value="NULL" checked> "Not applicable" (default for Concealers and Primers); OR "I do not know." <br>
                <input type="radio" name="Coverage" value="Full"> Full<br>
                <input type="radio" name="Coverage" value="Medium"> Medium<br>
                <input type="radio" name="Coverage" value="Light"> Light<br>

            <a>Choose Finish:</a><br>
                <input type="radio" name="Finish" value="Matte"> Matte<br>
                <input type="radio" name="Finish" value="Radiant"> Radiant<br>
                <input type="radio" name="Finish" value="Natural"> Natural<br>
                <input type="radio" name="Finish" value="NULL" checked> I do not know<br>
            </p>
            <div>
                <input type='submit' value='ADD'>
            </div>
        </form>
    </div>


<div id="copyright">
        <p>Created by Mengchen Shi. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. | This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license.</p>
</div>
        
</body>
</html>