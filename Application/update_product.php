<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>Update product</title>
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

    <br></br>

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
   or die('Could not connect: ' . mysqli_connect_error());
// print 'Connected successfully!<br>';
mysqli_set_charset($dbcon, 'utf8mb4');

$brand = $_REQUEST['brand'];
$product = $_REQUEST['product'];
// $price = $_GET['Price'];
// $rate = $_GET['Rate'];
// $category = $_GET['Category'];
$submitUPDATE = $_REQUEST['submitUPDATE'];
$upproduct = $_REQUEST['upproduct'];
$upprice = $_REQUEST['upprice'];
$uprate = $_REQUEST['uprate'];


// if ($upproduct != NULL) {
if ($upproduct == NULL & $upprice == NULL & $uprate == NULL) {
    if ($submitUPDATE != NULL) {
        echo "<div align='center'><font style='color:#FF0000;'>
        Please input at least one field!</font></div></br>";
    }
}else{
    $upprice = !empty($upprice) ? "'$upprice'" : "NULL";
    $uprate = !empty($uprate) ? "'$uprate'" : "NULL";
    $query = "CALL updateProduct('$brand', '$product', '$upproduct', $upprice, $uprate);";

    if (!mysqli_query($dbcon, $query)){
        if(mysqli_errno($dbcon) == $MYSQL_CODE_DUPLICATE_KEY){
            echo "<div align='center'><font style='color:#FF0000;'>
            Failed: product '$upproduct' - '$brand' already exists in our database. 
            Please add a new product name.</font></div><br>";
        }elseif(mysqli_errno($dbcon) == $MYSQL_CODE_SYNTAX_ERROR){
            echo "<div align='center'><font style='color:#FF0000;'>
            Bad input. Please do not input single quote(s), i.e., '.</font></div><br>";
        }else{
            echo "<div align='center'>Failed: " . mysqli_error($dbcon). "</div><br>";
        }
    }else{
        echo "<div align='center'><font style='color:#FF0000;'>
        Product is updated successfully!</font></div><br>" ;
        if ($upproduct != NULL) {
            $product = $upproduct;
        }
    }
}

echo "<div align='center'>Brand: '$brand'</div><br>";

echo "<div align='center'>Product Name: '$product'</div><br>";


echo "<div align='center'>Please update product information below. </div><br>";



echo "<div id='page' class='container'>
        <div class='title'>
            <h1>Update product</h1>
        </div>
        <form action method='request' name='myform'>
            <p>
            <a>Please leave input field blank if no need to update it.</a><br>
                <input type='radio' name='brand' value='". $brand ."' checked>" ."Brand: ".$brand. " <br>
                <input type='radio' name='product' value='". $product ."' checked>" . "Product: " . $product . "<br>
                <a>Enter New Product Name (255 characters at most):</a><br>
                    <input type='text' name='upproduct' maxlength='255' size='50'/><br>
                <a>Enter Price (a number from 0 to 99999999):</a><br>
                    <input type='number' name='upprice' min='0' max='99999999' step='0.01'/><br>
                <a>Enter Rate (a number from 0 to 5):</a><br>
                    <input type='number' name='uprate' min='0' max='5' step='0.001'/><br>
            </p>
            <div>
                <input type='submit' value='UPDATE' name='submitUPDATE'>
            </div>
        </form>
        </div>";
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