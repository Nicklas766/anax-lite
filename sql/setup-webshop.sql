-- ------------------------------------------------------------------------
--
-- For lecture in oophp-v3 kmom03
--
-- CREATE DATABASE oophp;
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";

USE nien16;
SET NAMES utf8;
-- ------------------------------------------------------------------------
--
-- Setup tables
--
DROP TABLE IF EXISTS `Prod2Cat`;
DROP TABLE IF EXISTS `Image`;
DROP TABLE IF EXISTS `ProdCategory`;
DROP TABLE IF EXISTS `Inventory`;
DROP TABLE IF EXISTS `LowStock`;
DROP TABLE IF EXISTS `InvenShelf`;
DROP TABLE IF EXISTS `OrderRow`;
DROP TABLE IF EXISTS `Cst_Order`;
DROP TABLE IF EXISTS `ShoppingCart`;
DROP TABLE IF EXISTS `Product`;
DROP TABLE IF EXISTS `Customer`;

-- ------------------------------------------------------------------------
--
-- Product
--

CREATE TABLE `Image` (
	`id` INT AUTO_INCREMENT,
	`link` VARCHAR(40),

	PRIMARY KEY (`id`)
);

CREATE TABLE `ProdCategory` (
	`id` INT AUTO_INCREMENT,
	`category` CHAR(10),

	PRIMARY KEY (`id`)
);

CREATE TABLE `Product` (
	`id` INT AUTO_INCREMENT,
    `description` VARCHAR(20),
    `imgLink` VARCHAR(40),
    `price` INT,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Prod2Cat` (
	`id` INT AUTO_INCREMENT,
	`prod_id` INT,
	`cat_id` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
    FOREIGN KEY (`cat_id`) REFERENCES `ProdCategory` (`id`)
);


-- ------------------------------------------------------------------------
--
-- Inventory, shelf and report
--

CREATE TABLE `LowStock` (
    `id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `amount` INT,
    `occured` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
);

CREATE TABLE `InvenShelf` (
    `shelf` CHAR(6),
    `description` VARCHAR(40),

	PRIMARY KEY (`shelf`)
);
CREATE TABLE `Inventory` (
	`id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `shelf_id` CHAR(6),
    `amount` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
    FOREIGN KEY (`shelf_id`) REFERENCES `InvenShelf` (`shelf`)
);


-- ------------------------------------------------------------------------
--
-- Customer
--
CREATE TABLE `Customer` (
	`id` INT AUTO_INCREMENT,
    `firstName` VARCHAR(20),
    `lastName` VARCHAR(20),

	PRIMARY KEY (`id`)
);



-- ------------------------------------------------------------------------
--
-- Shopping Cart
--

CREATE TABLE `ShoppingCart` (
	`id` INT AUTO_INCREMENT,
    `customer_id` INT,
    `prod_id` INT,

	PRIMARY KEY (`id`),
 	FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`)
);


-- ------------------------------------------------------------------------
--
-- Order
--
CREATE TABLE `Cst_Order` (
	`id` INT AUTO_INCREMENT,
    `customer_id` INT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `status` VARCHAR(20),
	`delivery` DATETIME DEFAULT NULL,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `OrderRow` (
	`id` INT AUTO_INCREMENT,
    `order` INT,
    `product` INT,
	`amount` INT,

	PRIMARY KEY (`id`),
    FOREIGN KEY (`order`) REFERENCES `Cst_Order` (`id`)
);

-- -------------------------------------------------------------------------
--
-- Functions, triggers, etc
--

-- Trigger for creating product, insert into inventory
DROP TRIGGER IF EXISTS createdProduct;

CREATE TRIGGER createdProduct
AFTER INSERT ON Product FOR EACH ROW
	INSERT INTO Inventory (`prod_id`, `amount`, `shelf_id`) VALUES (NEW.id, 0, "NONE");

-- PROCEDURE for updating product, first product then category and p2c

DROP PROCEDURE IF EXISTS removeCategory;
DELIMITER //

-- remove all categories in product
CREATE PROCEDURE removeCategory(
    P_id INT
)
BEGIN
    DELETE FROM Prod2Cat WHERE prod_id = P_id;
END
//
DELIMITER ;


-- PROCEDURE for updating product, first product then category and p2c

DROP PROCEDURE IF EXISTS addCategory;
DELIMITER //

-- adds category
CREATE PROCEDURE addCategory(
    P_id INT,
    C_id INT
)
BEGIN
    INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES (P_id, C_id);
END
//
DELIMITER ;

DROP PROCEDURE IF EXISTS createProduct;
DELIMITER //

-- creates product
CREATE PROCEDURE createProduct(
    des VARCHAR(20),
    imgLink VARCHAR(40),
    price INT,
    C_id INT
)
BEGIN
	DECLARE latestId INT;
    INSERT INTO `Product` (`description`, `imgLink`, `price`) VALUES
	(des, imgLink, price);

    -- Get the id of product.
    SET latestId = (SELECT MAX(id) FROM Product);

    call addCategory(latestId, C_id);

END
//
DELIMITER ;

-- PROCEDURE for updating product, first product then category and p2c

DROP PROCEDURE IF EXISTS updateProduct;
DELIMITER //

-- adds category
CREATE PROCEDURE updateProduct(
     P_id INT,
     newDes VARCHAR(20),
     newImg VARCHAR(40),
     newPrice INT
)
BEGIN
    UPDATE Product SET description = newDes, imgLink = newImg, price = newPrice WHERE id = P_id;
END
//
DELIMITER ;

-- PROCEDURE for removing product

DROP PROCEDURE IF EXISTS removeProduct;
DELIMITER //

-- adds category
CREATE PROCEDURE removeProduct(
     P_id INT
)
BEGIN
	SET FOREIGN_KEY_CHECKS=0; -- to disable them
	DELETE FROM LowStock WHERE prod_id = P_id;
	DELETE FROM Prod2Cat WHERE prod_id = P_id;
    DELETE FROM Product WHERE id = P_id;
    SET FOREIGN_KEY_CHECKS=1; -- to re-enable them
END
//
DELIMITER ;

-- updates inventory
DROP PROCEDURE IF EXISTS updateInventory;
DELIMITER //

CREATE PROCEDURE updateInventory(
     P_id INT,
     newShelf CHAR(6),
     newAmount INT
)
BEGIN
	DECLARE amountInStock INT;
    START TRANSACTION;

    SET amountInStock = (SELECT amount FROM Inventory WHERE prod_id = P_id);

    IF (amountInStock + (newAmount)) < 0 THEN
        ROLLBACK;
        SELECT "You cant decrease below zero!";
    ELSE
        UPDATE Inventory SET shelf_id = newShelf, amount = amount + (newAmount), prod_id = P_id WHERE prod_id = P_id;
        COMMIT;
        END IF;
END
//
DELIMITER ;


-- updates inventory
DROP PROCEDURE IF EXISTS decreaseInventory;
DELIMITER //

CREATE PROCEDURE decreaseInventory(
     P_id INT,
     decrease INT
)
BEGIN
	UPDATE Inventory SET amount = amount - decrease WHERE prod_id = P_id;
END
//
DELIMITER ;

-- updates inventory
DROP PROCEDURE IF EXISTS increaseInventory;
DELIMITER //

CREATE PROCEDURE increaseInventory(
     P_id INT,
     increase INT
)
BEGIN
    UPDATE Inventory SET amount = amount + increase WHERE prod_id = P_id;
END
//
DELIMITER ;

--

-- PROCEDURE for updating product, first product then category and p2c

DROP PROCEDURE IF EXISTS addCart;
DELIMITER //

-- adds category
CREATE PROCEDURE addCart(
     customerId INT,
     prodId int
)
BEGIN
    DECLARE amountInStock INT;
    START TRANSACTION;

    SET amountInStock = (SELECT amount FROM Inventory WHERE prod_id = prodId);

    IF amountInStock <= 0 THEN
        ROLLBACK;
        SELECT "Sorry! That product is currently not in stock.";
    ELSE
        INSERT INTO `ShoppingCart` (`customer_id`, `prod_id`) VALUES (customerId, prodId);
        END IF;
END
//
DELIMITER ;

-- PROCEDURE for updating product, first product then category and p2c

DROP PROCEDURE IF EXISTS removeCart;
DELIMITER //

-- adds category
CREATE PROCEDURE removeCart(
     customerId INT,
     prodId int
)
BEGIN
    DELETE FROM `ShoppingCart` WHERE customer_id = customerId AND prod_id = prodId limit 1;
END
//
DELIMITER ;


-- PROCEDURE for creating an order based on the ShoppingCart

DROP PROCEDURE IF EXISTS createOrder;
DELIMITER //

-- adds category
CREATE PROCEDURE createOrder(
     customerId INT
)
BEGIN
    DECLARE latestId INT;
    -- Start with creating order
    INSERT INTO Cst_Order (`customer_id`, `status`) VALUES (customerId, 'active');

    -- Get the id of order.
    SET latestId = (SELECT MAX(id) FROM Cst_Order);

    -- Create orderrows for the order
	INSERT INTO OrderRow (`order`, `product`, `amount`)
	SELECT latestId, prod_id, Amount FROM `VShoppingCart` WHERE Customer_ID = customerId;

    -- Delete the ShoppingCart after ordermade
	DELETE FROM `ShoppingCart` WHERE Customer_ID = customerId;


END
//
DELIMITER ;


-- Cancels order

DROP PROCEDURE IF EXISTS cancelOrder;
DELIMITER //

-- Cancels the order
CREATE PROCEDURE cancelOrder(
     orderId INT
)
BEGIN
	DECLARE numOfOrders INT;
    DECLARE theProd INT;
    DECLARE theAmount INT;
    DECLARE p1 INT;
    SET p1 = 0;
	-- No delete, set status as canceled instead
    UPDATE Cst_Order SET status = "canceled" WHERE id = orderId;

    -- Get product id and amount
    set numOfOrders = (SELECT COUNT(`order`) FROM OrderRow WHERE `order` = orderId);

	-- Return the goods to the warehouse
	label1: WHILE p1 < numOfOrders + 1 DO
		set theProd = (SELECT product FROM OrderRow WHERE `order` = orderId LIMIT 1 OFFSET p1);
		set theAmount = (SELECT amount FROM OrderRow WHERE `order` = orderId LIMIT 1 OFFSET p1);
		CALL increaseInventory(theProd, theAmount);
		SET p1 = p1 + 1;
   END WHILE label1;
END
//
DELIMITER ;


-- Trigger for creating product, insert into inventory
DROP TRIGGER IF EXISTS createdOrderRow;

CREATE TRIGGER createdOrderRow
AFTER INSERT ON OrderRow FOR EACH ROW
	CALL decreaseInventory(NEW.Product, NEW.amount);


-- Trigger for checking if product is lower than 0 on update
DROP TRIGGER IF EXISTS checkInventory;
DELIMITER //
CREATE TRIGGER checkInventory
AFTER UPDATE ON Inventory FOR EACH ROW
	IF (NEW.amount < 5) THEN
		INSERT INTO LowStock (`prod_id`, `amount`) VALUES (OLD.prod_id, NEW.amount);
	END IF;
//
DELIMITER ;

-- ----------------------------------------------------------
--
-- Function
--
DELIMITER //

DROP FUNCTION IF EXISTS StockStatus //
CREATE FUNCTION StockStatus(
    Amount INTEGER
)
RETURNS CHAR(30)
BEGIN
    IF Amount > 0 THEN
        RETURN CONCAT("Yes(", Amount, ")");
    ELSEIF Amount = 0 THEN
        RETURN "No";
    END IF;
END
//

DELIMITER ;

DELIMITER //

DROP FUNCTION IF EXISTS removeInventory //
CREATE FUNCTION removeInventory(
    I_id INTEGER
)
RETURNS CHAR(20)
BEGIN
	DECLARE P_id INT;
    -- Get products id
    set P_id = (SELECT prod_id FROM Inventory WHERE id = I_id);

    -- If product exists do a rollback.
    IF EXISTS (SELECT * FROM Product WHERE id = P_id) THEN
        RETURN "FALSE";
    ELSE
        DELETE FROM Inventory WHERE id = I_id;
        RETURN "TRUE";
	END IF;
END
//

DELIMITER ;

-- ----------------------------------------------------------
--
-- create
--

INSERT INTO `ProdCategory` (`category`) VALUES
("music"), ("clothes"), ("book");

INSERT INTO `InvenShelf` (`shelf`, `description`) VALUES
("NONE", "Currently not in stock"),
("A101", "House A, shelf 101"),
("A102", "House A, shelf 102");

INSERT INTO `Image` (`link`) VALUES
("img/webshop/cd.png"), ("img/webshop/clothesbook.png"), ("img/webshop/musicbook.jpg"),
("img/webshop/musicshirt.png"), ("img/webshop/tshirt.png");

INSERT INTO `Product` (`description`, `imgLink`, `price`) VALUES
("Rockband Merchandise Sleeve", "img/webshop/musicshirt.png", 100),
("Music Book", "img/webshop/musicbook.jpg", 50),
("Styling Book", "img/webshop/clothesbook.png", 150),
("CD book", "img/webshop/cd.png", 30),
("Rockband Merchandise T-shirt", "img/webshop/tshirt.png", 70);

INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES
(1, 1), (1, 2),
(2, 1), (2, 3),
(3, 2), (3, 3),
(4, 1), (4, 3),
(5, 1), (5, 2);



INSERT INTO `Customer` (`firstName`, `lastName`) VALUES
("Nicklas", "Envall");

-- ------------------------------------------------------------------------
--
-- Create view for product
--
DROP VIEW IF EXISTS ProductView;
CREATE VIEW ProductView
AS
SELECT P.id as id,
GROUP_CONCAT(PC.category) AS category,
P.description as description,
StockStatus(INV.amount) AS InStock,
P.imgLink as image,
P.price as price

FROM (((Prod2Cat AS P2C
INNER JOIN Product AS P ON P2C.prod_id = P.id)
INNER JOIN ProdCategory AS PC ON P2C.cat_id = PC.id)
INNER JOIN Inventory AS INV ON INV.prod_id = P.id)
GROUP BY P.id ORDER BY P.id;


--
-- View connecting products with their place in the inventory
-- and offering reports for inventory and sales personal.
--
DROP VIEW IF EXISTS VInventory;
CREATE VIEW VInventory AS
SELECT
S.shelf, I.prod_id,
S.description AS location,
I.amount

FROM Inventory AS I
INNER JOIN InvenShelf AS S ON I.shelf_id = S.shelf
ORDER BY S.shelf;

SELECT * FROM VInventory;

CALL updateInventory(1, "A101", 1000);
CALL updateInventory(3, "A101", 300);

SELECT * FROM VInventory;
SELECT * FROM Inventory;


--
-- Create view for the shopping cart
--
DROP VIEW IF EXISTS VShoppingCart;
CREATE VIEW VShoppingCart AS
SELECT
P.id AS prod_id, C.id AS Customer_ID,
P.description as Item,
SUM(P.Price) as Price, COUNT(*) as Amount

FROM ShoppingCart AS SC
INNER JOIN Customer AS C ON SC.customer_id = C.id
INNER JOIN Product AS P ON P.id = SC.prod_id
GROUP BY P.id
ORDER BY P.id;


--
-- Create view for the shopping cart
--
DROP VIEW IF EXISTS VCst_Order;
CREATE VIEW VCst_Order AS
SELECT
CO.id AS OrderNumber, C.id AS CostumerNumber,
CO.created as OrderDate,
SUM(P.Price * O.amount) as Price, C.firstName, C.lastName,
CO.status as Status

FROM Cst_Order AS CO
INNER JOIN OrderRow AS O ON CO.id = O.order
INNER JOIN Customer AS C ON CO.customer_id = C.id
INNER JOIN Product AS P ON P.id = O.Product
GROUP BY CO.id
ORDER BY P.id;


CREATE UNIQUE INDEX name_unique ON users (name);
CREATE INDEX index_price ON product(price);
CREATE INDEX index_status ON Cst_Order(status);
