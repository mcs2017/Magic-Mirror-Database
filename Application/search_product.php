<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
        <meta charset="utf-8" />
        <title>Search products</title>
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

    <div id="page" class="container">
        <div class="title">
            <h1>Search products by keyword</h1>
        </div>
        <form method=get action="search_keyword.php">
            <b>Enter Brand Name:</b><a>(e.g., Becca, tarte, or Smashbox)</a><br>
            <input type="text" name="brand" required/><BR>
            <b>Enter a keyword of the products:</b><a>(e.g., light, clay, or finish)</a><br>
            <a>If you do not have a keyword, please leave it blank.</a><br>
            <input type="text" name="keyword"/><BR>
            <input type="submit" value="Submit">
            <input type="reset" value="Clear and Restart">
        </form>
        <br></br>
        <div class="title">
            <h1>Search products by features</h1>
        </div>

        <div id="sidebar">
			<div class="box2">
				<div class="title">
					<h3>Find foundations by features</h3>
				</div>
                <form action="find_feature.php" method="get">
                Category:
                    <input type="radio" name="Category" value="Foundation" checked> Foundation<br>
                    <p>
                        Formula: 
                        <select name="Formula">
                            <option value="Liquid">Liquid</option>
                            <option value="Cream">Cream</option>
                            <option value="Power">Powder</option>
                            <option value="Stick">Stick</option>
                        </select><br>
                        Coverage: 
                        <select name="Coverage">
                            <option value="Full">Full</option>
                            <option value="Medium">Medium</option>
                            <option value="Light">Light</option>
                        </select><br>
                        Finish: 
                        <select name="Finish">
                            <option value="Matte">Matte</option>
                            <option value="Radiant">Radiant</option>
                            <option value="Natural">Natural</option>
                        </select><br>            
                    </p>
                    <div>
                        <input type="submit" value="SEARCH">
                    </div>
                </form>
			</div>
        </div>
        <div id="sidebar">
			<div class="box2">
				<div class="title">
					<h3>Find concealers by features</h3>
				</div>
                <form action="find_feature.php" method="get">
                Category:
                    <input type="radio" name="Category" value="Concealer" checked> Concealer<br>
                    <p>
                    Finish: 
                    <select name="Finish">
                        <option value="Matte">Matte</option>
                        <option value="Radiant">Radiant</option>
                        <option value="Natural">Natural</option>
                    </select>
                    Formula: 
                    <select name="Formula">
                        <option value="Liquid">Liquid</option>
                        <option value="Cream">Cream</option>
                        <option value="Power">Powder</option>
                        <option value="Stick">Stick</option>
                    </select>     
                    </p>
                    <div>
                        <input type="submit" value="SEARCH">
                    </div>
                </form>
			</div>
        </div>
        <div id="sidebar">
			<div class="box2">
				<div class="title">
					<h3>Find primers by features</h3>
				</div>
                <form action="find_feature.php" method="get">
                    Category:
                    <input type="radio" name="Category" value="Primer" checked> Primer<br>
                    <p>
                    Finish: 
                    <select name="Finish">
                        <option value="Matte">Matte</option>
                        <option value="Radiant">Radiant</option>
                        <option value="Natural">Natural</option>
                    </select>  
                    </p>
                    <div>
                        <input type="submit" value="SEARCH">
                    </div>
                </form>
			</div>
		</div>
	</div>


<div id="copyright">
        <p>Created by Mengchen Shi. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. | This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license.</p>
</div>
        
</body>
</html>