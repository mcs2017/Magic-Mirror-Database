
-- use mshi17DB;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE  IF EXISTS Countries;
CREATE TABLE Countries (
	CountryName VARCHAR(100) PRIMARY KEY,
    Continent VARCHAR(100)
		);


DROP TABLE IF EXISTS Companies;
CREATE TABLE Companies (
	CompName VARCHAR(100) PRIMARY KEY,
    FoundYear  SMALLINT(4) UNSIGNED
		);


DROP TABLE IF EXISTS Brands;
CREATE TABLE Brands (
	BrandName VARCHAR(100) PRIMARY KEY,
    FoundYear  SMALLINT(4) UNSIGNED,
    Website VARCHAR(255)
		);


DROP TABLE IF EXISTS BeautyStores;
CREATE TABLE BeautyStores (
	StoreName VARCHAR(100) PRIMARY KEY,
    Website VARCHAR (255)
);


DROP TABLE IF EXISTS Products;
CREATE TABLE Products(
	ProductName VARCHAR(255),
    BrandName VARCHAR(100),
    Price DECIMAL(10, 2),
    Rate DECIMAL(4, 3),
    Category VARCHAR(50),
    PRIMARY KEY (ProductName, BrandName)
);


DROP TABLE IF EXISTS SkinTypes;
CREATE TABLE SkinTypes(
	TypeName VARCHAR(20) PRIMARY KEY,
    Description VARCHAR(1024)
);


DROP TABLE IF EXISTS Foundations;
CREATE TABLE Foundations(
	ProductName VARCHAR(255),
    BrandName VARCHAR(100),
    Formula VARCHAR(20),
    Coverage VARCHAR(20),
    Finish VARCHAR(20),
    PRIMARY KEY (ProductName, BrandName),
    FOREIGN KEY (ProductName, BrandName) REFERENCES Products(ProductName, BrandName)
	ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS SimilarFoundations;
CREATE TABLE SimilarFoundations(
	ProductName1 VARCHAR(255),
    BrandName1 VARCHAR(100),
	ProductName2 VARCHAR(255),
    BrandName2 VARCHAR(100),
	Formula VARCHAR(20),
    Coverage VARCHAR(20),
    Finish VARCHAR(20),
    PRIMARY KEY (ProductName1, BrandName1, ProductName2, BrandName2),
    FOREIGN KEY (ProductName1, BrandName1) REFERENCES Products(ProductName, BrandName)
    ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (ProductName2, BrandName2) REFERENCES Products(ProductName, BrandName)
    ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS Concealers;
CREATE TABLE Concealers(
	ProductName VARCHAR(255),
    BrandName VARCHAR(100),
    Formula VARCHAR(20),
    Finish VARCHAR(20),
    PRIMARY KEY (ProductName, BrandName),
    FOREIGN KEY (ProductName, BrandName) REFERENCES Products(ProductName, BrandName)
    ON UPDATE CASCADE ON DELETE CASCADE
);


DROP TABLE IF EXISTS Primers;
CREATE TABLE Primers(
	ProductName VARCHAR(255),
    BrandName VARCHAR(100),
    Finish VARCHAR(20),
    PRIMARY KEY (ProductName, BrandName),
    FOREIGN KEY (ProductName, BrandName) REFERENCES Products(ProductName, BrandName)
    ON UPDATE CASCADE ON DELETE CASCADE
);


DROP TABLE IF EXISTS Owns;
CREATE TABLE Owns(
	BrandName VARCHAR(100),
    CompName VARCHAR(100),
    PRIMARY KEY (BrandName, CompName),
    FOREIGN KEY (BrandName) REFERENCES Brands(BrandName),
    FOREIGN KEY (CompName) REFERENCES Companies(CompName)
);


DROP TABLE IF EXISTS Collaborate;
CREATE TABLE Collaborate(
	BrandName VARCHAR(100),
    StoreName VARCHAR(100),
    PRIMARY KEY (BrandName, StoreName),
    FOREIGN KEY (BrandName) REFERENCES Brands(BrandName),
    FOREIGN KEY (StoreName) REFERENCES BeautyStores(StoreName)
);


DROP TABLE IF EXISTS SoldIn;
CREATE TABLE SoldIn(
	BrandName VARCHAR(100),
    CountryName VARCHAR(100),
    PRIMARY KEY (BrandName, CountryName),
    FOREIGN KEY (BrandName) REFERENCES Brands(BrandName) 
    ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (CountryName) REFERENCES Countries(CountryName)
    ON UPDATE CASCADE ON DELETE CASCADE
);


DROP TABLE IF EXISTS HQin;
CREATE TABLE HQin(
	CompName VARCHAR(100),
    CountryName VARCHAR(100),
    PRIMARY KEY (CompName, CountryName),
    FOREIGN KEY (CompName) REFERENCES Companies(CompName),
    FOREIGN KEY (CountryName) REFERENCES Countries(CountryName)
);


DROP TABLE IF EXISTS ApplyTo;
CREATE TABLE ApplyTo(
	ProductName VARCHAR(255),
    BrandName VARCHAR(100),
    TypeName VARCHAR(20),
    PRIMARY KEY (ProductName, BrandName, TypeName),
    FOREIGN KEY (ProductName, BrandName) REFERENCES Products(ProductName, BrandName)
    ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (TypeName) REFERENCES SkinTypes(TypeName)
    ON UPDATE CASCADE ON DELETE CASCADE
);

SET FOREIGN_KEY_CHECKS = 1;
