Dokumenation
=====================

Detta är en dokumenation för mitt webshops-API, du kan använda följande

* Funktioner
* Procedures
* Vyer

I denna dokumenation kommer du endast få reda på hur du kan använda API:et. Inte bakomliggande
funktioner eller triggers som får SQL-koden att fungera.


Procedures
=====================
Produkt
-------------

Man bör börja med att skapa en produkt. När man skapar produkten med procedure, så
kan man endast tilldela en kategori, därefter kan man lägga till fler med "updateProduct".

`CALL createProduct(des, imgLink, price, C_id)`

* des VARCHAR(20),
* imgLink VARCHAR(40),
* price INT,
* C_id INT

___

Här uppdaterar man produktens information.

`CALL updateProduct(P_id, newDes, newImg, newPrice)`

* P_id INT,
* newDes VARCHAR(20),
* newImg VARCHAR(40),
* newPrice INT

___

Denna använder ett id som motsvarar produktens id, den tar bort alla kategorier för
produkten.

`CALL removeCategory(P_id)`

* P_id INT
___

Här lägger man till en kategori till produkten.

`CALL addCategory(P_id, C_id)`

 * P_id INT,
 * C_id INT

___


Här raderar man produkten.

`CALL removeProduct(P_id)`

___

Ett exempel hur man kan använda den med PHP


CALL removeCategory(P_id)

foreach $categories as $category {
    CALL addCategory(P_id, $category["id"])
}

CALL updateProduct(P_id, newDes, newImg, newPrice)

___

Inventory
-------------

Uppdatering av hylla

`CALL updateInventory(P_id, newShelf, newAmount)`

* P_id INT,
* newShelf CHAR(6),
* newAmount INT

___

Ta bort ett antal av specifik produkt på lagret

`CALL decreaseInventory(P_id, decrease)`

* P_id INT
* decrease INT

___

Öka ett antal av specifik produkt på lagret

`CALL increaseInventory(P_id, increase)`

* P_id INT
* increase INT

___

ShoppingCart
-------------

Man behöver aldrig skapa en specifik kundvagn för kunden. Du lägger in varorna så hanterar SQL-koden resten och
ser till så det blir som en kundvagn.

Däremot behöver man en kund. Först skapar man en kund med en vanlig insert till tabellen "Costumer",
därefter har du kund-id:et som man behöver.


`CALL addCart(customerId, prodId)`

* customerId INT,
* prodId int

___

Om du vill ta bort en vara så kan du göra det med följande.

`CALL removeCart(customerId, prodId)`

* customerId INT,
* prodId int

___

Order
-------------

För att skapa ordern så behöver du endast kundens id. SQL-koden kommer ta kundvagens innehåll och
skapa en order. Därefter tas kundvagnen bort. Motsvarande varor tas även bort från lagret.

Därefter får ordern status "aktiv".

`CALL createOrder(customerId)`

* customerId INT

___


Det går att avbryta ordern. Då blir orderns status "canceled", SQL-koden ser även till så att varorna
tas tillbaka på lagret.

`CALL cancelOrder(orderId)`

* orderId INT

___


Funktioner
=====================

En bra sak att veta är nog att när du skapar en produkt, så skapas även en Inventory för
produkten via en trigger.

Du kan inte ta bort en inventory såvida inte produkten är borttagen. Denna funktionen kontrollerar just detta.
Den tar bort inventory om produkten har tagits bort, annars ingenting.

Den returnerar även en sträng "False" eller "True", så med PHP-kod så kan du antingen göra en redirect eller
felmeddelande till använder.

`SELECT removeInventory(id)`

* I_id INTEGER

Vyer
-------------

Vyerna ger informationen precis enligt namnen.

`SELECT * ProductView;`
`SELECT * VInventory;`
`SELECT * VShoppingCart;`
`SELECT * VCst_Order;`
`SELECT * Cst_Order;`


Exemplen
=====================

Alla följande exemplen antar att du har gjort följande eller använder setup-webshop.sql,

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
("Music Book", "img/webshop/musicbook.jpg", 100),
("Styling Book", "img/webshop/clothesbook.png", 100),
("CD book", "img/webshop/cd.png", 100),
("Rockband Merchandise T-shirt", "img/webshop/tshirt.png", 100);

INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES
(1, 1), (1, 2),
(2, 1), (2, 3),
(3, 2), (3, 3),
(4, 1), (4, 3),
(5, 1), (5, 2);


CALL updateInventory(1, "A101", 1000);
CALL updateInventory(3, "A101", 300);


Skapa en order för en kund (SQL-KOD, idén är att man kan kopiera rakt av)
-------------

INSERT INTO `Customer` (`firstName`, `lastName`) VALUES
("Nicklas", "Envall");

-- Ska fungera,
CALL addCart(1, 1);
CALL addCart(1, 1);

-- Ska inte fungera,
CALL addCart(1, 2);

-- Ska fungera,
CALL addCart(1, 3);
CALL addCart(1, 3);

-- Kontroll
SELECT * FROM VShoppingCart WHERE Customer_ID = 1;

-- Ta bort vara 1
CALL removeCart(1, 1);

-- Kontroll
SELECT * FROM VShoppingCart WHERE Customer_ID = 1;

-- Skapa order, kontrollera lagret så det tas bort
SELECT * FROM Inventory;
CALL createOrder(1);
SELECT * FROM Inventory;

-- Titta allt som har med ordrar att göra
SELECT * FROM Cst_Order;
SELECT * FROM OrderRow;

-- Avbryt ordern, kontrollera så allt tas tillbaka till lagret och status ändras till cancel
SELECT * FROM VCst_Order;
SELECT * FROM Inventory;
call cancelOrder(1);

SELECT * FROM VCst_Order;
SELECT * FROM Inventory;


Rapporten (SQL-KOD, idén är att man kan kopiera rakt av)
-------------

--En trigger kontrollerar efter varje UPDATE.

CALL updateInventory(4, "A101", 1);
SELECT * FROM LowStock;
CALL updateInventory(4, "A101", 4);
SELECT * FROM LowStock;
CALL updateInventory(4, "A101", 7);
SELECT * FROM LowStock;
CALL updateInventory(4, "A101", 10);
SELECT * FROM LowStock;
