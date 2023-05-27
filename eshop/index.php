<?php
class Product {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }
}

class ShoppingCart {
    private $items;

    public function __construct() {
        $this->items = array();
    }

    public function addItem(Product $product) {
        $this->items[] = $product;
    }

    public function getTotalPrice() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }
        return $total;
    }
}

// Create products
$product1 = new Product('iPhone', 999);
$product2 = new Product('Laptop', 1299);

// Add your own products
$product3 = new Product('Headphones', 149);
$product4 = new Product('Smartwatch', 299);

// Create a shopping cart
$cart = new ShoppingCart();

// Add products to the cart
$cart->addItem($product1);
$cart->addItem($product2);
$cart->addItem($product3);
$cart->addItem($product4);

$totalPrice = $cart->getTotalPrice();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart Application</title>
</head>
<body>
    <h1>Shopping Cart Application</h1>

    <h2>Products:</h2>
    <ul>
        <li><?php echo $product1->getName() . ' - $' . $product1->getPrice(); ?></li>
        <li><?php echo $product2->getName() . ' - $' . $product2->getPrice(); ?></li>
        <li><?php echo $product3->getName() . ' - $' . $product3->getPrice(); ?></li>
        <li><?php echo $product4->getName() . ' - $' . $product4->getPrice(); ?></li>
    </ul>

    <h2>Shopping Cart:</h2>
    <p>Total Price: $<?php echo $totalPrice; ?></p>
</body>
</html>
