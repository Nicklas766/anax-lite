<?php
/**
 * Content
 */
namespace nicklas\Connect;

use \PDO;

class Webshop extends Connect implements \Anax\Common\AppInjectableInterface, \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;


    public function __construct()
    {
        parent::__construct();
    }

    public function setApp($app)
    {
        $this->app = $app;
        $this->currentUrl = $app->request->getRoute();
    }

    // Updates the product.
    public function updateProduct($product, $categories)
    {
        // get details from array
        $id = $product["id"];
        $description = $product["description"];
        $img = $product["img"];
        $price = $product["price"];

        // start with removing all categories for product
        $this->execute("CALL removeCategory($id)");

        // add all new categories
        foreach ($categories as $cat) {
            $this->execute("CALL addCategory($id, $cat)");
        }

        // update product details
        $this->execute("CALL updateProduct($id, '$description', '$img', $price)");
    }
    // Updates the product.
    public function updateInventory($params)
    {
        // get details from array
        $id = $params["id"];
        $shelf = $params["shelf"];
        $amount = $params["Amount"];
        // update product details
        $this->execute("CALL updateInventory($id, '$shelf', $amount)");
    }

    // Updates the product.
    public function createProduct($params)
    {
        // get details from array
        $desc = $params["description"];
        $img = $params["img"];
        $price = $params["price"];
        $catId = $params["catId"];
        // update product details
        $this->execute("CALL createProduct('$desc', '$img', $price, $catId)");
    }
    // Updates the product.
    public function deleteProduct($id)
    {
        // Remove product
        $this->execute("CALL removeProduct($id)");
        $this->app->redirect("webshop");
    }
    // Updates the product.
    public function deleteInventory($id)
    {
        $success = $this->getRes("SELECT removeInventory($id) AS success")["success"];

        //remove inventory
        if ($success == "TRUE") {
            $this->app->redirect("webshop/stock");
        } else {
            echo "<p class='warning'>Fail! You cannot delete if the product exists</p>";
        }
    }
}
