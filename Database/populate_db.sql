-- use mshi17DB;


LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Countries.dat"
    REPLACE INTO TABLE Countries
    FIELDS TERMINATED BY '|'
    (CountryName, Continent);





LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Companies.dat"
    REPLACE INTO TABLE Companies
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (CompName, FoundYear);




LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Brands.dat"
    REPLACE INTO TABLE Brands
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (BrandName, FoundYear, Website);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/BeautyStores.dat"
    REPLACE INTO TABLE BeautyStores
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (StoreName, Website);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Products.dat"
    REPLACE INTO TABLE Products
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (ProductName, BrandName, Price, Rate, Category);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/SkinTypes.dat"
    REPLACE INTO TABLE SkinTypes
    FIELDS TERMINATED BY '|'
    (TypeName, Description);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Foundations.dat"
    REPLACE INTO TABLE Foundations
	CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (ProductName, BrandName, Formula, Coverage, Finish);

LOAD DATA
	LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/SimilarFoundations.dat"
    REPLACE INTO TABLE SimilarFoundations
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
	(ProductName1, BrandName1, ProductName2, BrandName2, Formula, Coverage, Finish);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Concealers.dat"
    REPLACE INTO TABLE Concealers
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (ProductName, BrandName, Formula, Finish);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Primers.dat"
    REPLACE INTO TABLE Primers
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (ProductName, BrandName, Finish);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Owns.dat"
    REPLACE INTO TABLE Owns
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (BrandName, CompName);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/Collaborate.dat"
    REPLACE INTO TABLE Collaborate
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (BrandName, StoreName);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/SoldIn.dat"
    REPLACE INTO TABLE SoldIn
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (BrandName, CountryName);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/HQin.dat"
    REPLACE INTO TABLE HQin
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (CompName, CountryName);



LOAD DATA
    LOCAL INFILE "/Users/mengchenshi/Downloads/Autumn-18/Databases/Project/Assignment9/data/ApplyTo.dat"
    REPLACE INTO TABLE ApplyTo
    CHARACTER SET UTF8
    FIELDS TERMINATED BY '|'
    (ProductName, BrandName, TypeName);


