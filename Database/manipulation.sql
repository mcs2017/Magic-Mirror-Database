-- use mshi17;


-- 1.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS findProduct;
DELIMITER |
CREATE PROCEDURE findProduct(
	IN findBrandName		VARCHAR(100),
    IN findKeyword VARCHAR(50))
BEGIN
	IF findKeyword IS NULL THEN SET findKeyword = ''; END IF;
    SELECT * FROM Products 
    WHERE BrandName = findBrandName 
    AND ProductName LIKE concat('%', findKeyword, '%');
END |
DELIMITER ;




-- 2.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS addProduct;
DELIMITER |
CREATE PROCEDURE addProduct(
	IN addProductName VARCHAR(255),
    IN addBrandName VARCHAR(100),
    IN addPrice DECIMAL(10, 2),
    IN addRate DECIMAL(4, 3),
    IN addCategory VARCHAR(50),
    IN addFormula VARCHAR(50),
    IN addCoverage VARCHAR(50),
    IN addFinish VARCHAR(50))
    
BEGIN
	IF addFormula = 'NULL' THEN SET addFormula = NULL; END IF;
    IF addCoverage = 'NULL' THEN SET addCoverage = NULL; END IF;
    IF addFinish = 'NULL' THEN SET addFinish = NULL; END IF;
    
	INSERT IGNORE INTO Brands(BrandName) VALUES(addBrandName);
    INSERT INTO Products VALUES(addProductName, addBrandName, addPrice, addRate, addCategory);
    
    IF addCategory='Foundations' THEN 
		INSERT INTO Foundations VALUES(addProductName, addBrandName, addFormula, addCoverage, addFinish);
        CALL addToSimilarFoundations(addProductName, addBrandName, addFormula, addCoverage, addFinish);
	ELSEIF addCategory='Concealers' THEN 
		INSERT INTO Concealers VALUES(addProductName, addBrandName, addFormula, addFinish);
	ELSE 
		INSERT INTO Primers VALUES(addProductName, addBrandName, addFinish);
    END IF;
END |
DELIMITER ;





-- 3.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS searchCollaborateByBrand;
DELIMITER |
CREATE PROCEDURE searchCollaborateByBrand(
	IN searchBrandName		VARCHAR(100))
BEGIN
	SELECT *
    FROM Collaborate
    WHERE BrandName = searchBrandName;
END |
DELIMITER ;




-- 4.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS deleteProduct;
DELIMITER |
CREATE PROCEDURE deleteProduct(
	IN searchBrandName		VARCHAR(100),
	IN deleteProductName    VARCHAR(255))
BEGIN
	DELETE FROM Products
	WHERE BrandName = searchBrandName
    AND ProductName = deleteProductName;
END |
DELIMITER ;



-- 5.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS updateProduct;
DELIMITER |
CREATE PROCEDURE updateProduct(
	IN orgBrandName VARCHAR(100),
    IN orgProductName VARCHAR(255),
    IN upProductName  VARCHAR(255),
	IN upPrice DECIMAL(10, 2),
    IN upRate DECIMAL(4, 3))
BEGIN
	IF upPrice IS NOT NULL THEN
    UPDATE Products
    SET Price = upPrice
    WHERE BrandName = orgBrandName AND ProductName = orgProductName;
    END IF;
    
	IF upRate IS NOT  NULL THEN
    UPDATE Products
    SET Rate = upRate
    WHERE BrandName = orgBrandName AND ProductName = orgProductName;
    END IF;
    
	IF upProductName != '' THEN
	UPDATE Products
	SET ProductName = upProductName
	WHERE BrandName = orgBrandName AND ProductName = orgProductName;
    END IF;
END |
DELIMITER ;
CALL updateProduct('BECCA', 'Becca', 'Becca Primer Collection', '1', '1');




-- 6.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS deleteSoldIn;
DELIMITER |
CREATE PROCEDURE deleteSoldIn(
	IN deleteBrandName		VARCHAR(100),
	IN deleteCountryName    VARCHAR(100))
BEGIN
	DELETE FROM SoldIn
	WHERE BrandName = deleteBrandName
    AND CountryName = deleteCountryName	;
END |
DELIMITER ;




-- 7.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS addSoldIn;
DELIMITER |
CREATE PROCEDURE addSoldIn(
	IN addBrandName		VARCHAR(100),
	IN addCountryName    VARCHAR(100))
BEGIN
	INSERT INTO SoldIn VALUES(addBrandName, addCountryName);
END |
DELIMITER ;





-- 8.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS deleteCol;
DELIMITER |
CREATE PROCEDURE deleteCol(
	IN deleteBrandName		VARCHAR(100),
	IN deleteStoreName    VARCHAR(100))
BEGIN
	DELETE FROM Collaborate
	WHERE BrandName = deleteBrandName
    AND StoreName = deleteStoreName	;
END |
DELIMITER ;




-- 9.------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS addCol;
DELIMITER |
CREATE PROCEDURE addCol(
	IN addBrandName		VARCHAR(100),
	IN addStoreName    VARCHAR(100))
BEGIN
	INSERT INTO Collaborate VALUES(addBrandName, addStoreName);
END |
DELIMITER ;




-- 10.--------------------------------------------------------
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS deleteOwns;
DELIMITER |
CREATE PROCEDURE deleteOwns(
	IN deleteBrandName		VARCHAR(100),
	IN deleteCompName    VARCHAR(100))
BEGIN
	DELETE FROM Owns
	WHERE BrandName = deleteBrandName
    AND CompName = deleteCompName	;
END |
DELIMITER ;




-- 11.Insert a new foundation and find its similar products, then insert them into the table SimilarFoundations.
-- ---------------------------------------------------------
DROP PROCEDURE IF EXISTS addToSimilarFoundations;
DELIMITER |
CREATE PROCEDURE addToSimilarFoundations(
    IN newProductName       VARCHAR(255),
    IN newBrandName     VARCHAR(100),
    IN newFormula VARCHAR(20),
    IN newCoverage VARCHAR(20),
    IN newFinish VARCHAR(20))
BEGIN
    DECLARE aProductName    VARCHAR(255);
    DECLARE aBrandName   VARCHAR(100);
    DECLARE flag    INT DEFAULT 0;
    
-- Find foundations that have the same Formula, Coverage and Finish as the new foundation     
DECLARE AllFoundations CURSOR FOR
    SELECT ProductName, BrandName
    FROM Foundations
    WHERE Formula = newFormula
    AND Coverage = newCoverage
    AND Finish = newFinish
    AND Formula AND Coverage AND Finish;

DECLARE CONTINUE HANDLER
    FOR NOT FOUND
    SET flag = 1;
    

OPEN AllFoundations;
REPEAT
    FETCH AllFoundations INTO aProductName, aBrandName;
    -- Exclude cases when AllFoundation is empty, or comparing the foundation to itself.
    IF aProductName IS NOT NULL AND aProductName != newProductName AND aBrandName != newBrandName THEN
		IF aBrandName < newBrandName THEN
			INSERT IGNORE INTO SimilarFoundations VALUES(aProductName, aBrandName, newProductName, newBrandName, newFormula, newCoverage, newFinish);
		ELSE
			INSERT IGNORE INTO SimilarFoundations VALUES(newProductName, newBrandName, aProductName, aBrandName, newFormula, newCoverage, newFinish);
		END IF;
	END IF;
UNTIL flag = 1
END REPEAT;
CLOSE AllFoundations;
END |
DELIMITER ;


-- 12.------------------------------------------------------
-- trigger that inserts a new tuple in Products and a new tuple in SimilarFoundation when a new foundation tuple inserted
-- NOTICE!!!!! PLEASE FIRST RUN procedure.sql file, because this trigger calls the procedure addToSimilarFoundations
DROP TRIGGER IF EXISTS FoundationExistTrigger;
DELIMITER |
CREATE TRIGGER FoundationExistTrigger
AFTER INSERT ON Foundations
FOR EACH ROW
	BEGIN
		INSERT IGNORE INTO Products(ProductName, BrandName) VALUES(NEW.ProductName, NEW.BrandName);
		CALL addToSimilarFoundations(NEW.ProductName, NEW.BrandName, NEW.Formula, NEW.Coverage, NEW.Finish);
	END;|
DELIMITER ;
