Databas för OOPHP {#id1}
=====================

Detta är en introduktion till min databas, "nien16". I databasen har jag just nu ett flertal tabeller,

* users
* content
* Prod2Cat
* Product
* ProdCategory
* LowStock
* Inventory
* InvenShelf
* Image
* Costumer
* Cst_Order
* Order_row

Den använder bland annat indexes för att se till så hantering och vissa SELECT-satser går snabbare.

Users handlar om precis vad namnet antyder, den innehåller information om användare och admins.

Content innehåller texter, med information om hur de ska visas på sidan. Bra för att undvika flera
filer, så texterna kan sparas i databasen istället.

Prod2Cat, Product och ProdCategory är väldigt nära varandra i databasen. Prod2Cat binder dem tillsammans.

LowStock, Inventory och InvenShelf är precis som namnen innebär.

Image innehåller länkar till bilder.

Costumer, Cst_Order och Order_row är en kund, en order och därefter en rad av alla produkter.
