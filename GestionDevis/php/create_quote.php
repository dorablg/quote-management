<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</h><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quote</title>
<head>
<body>
    <h1>Creating Quote</h1>
    
    <form action="" method="post">
        <label for="client">Select Client:</label>
        <select name="client" id="client">
            <option value="client_id_1">Client 1</option>
            <option value="client_id_2">Client 2</option>
            <!-- Add more client options as needed -->
        </select>
        <br>
        
        <label for="product">Select Product:</label>
        <select name="product" id="product">
            <option value="product_id_1">Product 1</option>
            <option value="product_id_2">Product 2</option>
            <!-- Add more product options as needed -->
        </select>
        <input type="number" name="quantity" placeholder="Quantity">
        <button type="submit" name="addProduct">Add Product</button>
        <br>
     
        <?php
        if (isset($_POST['addProduct'])) {
            $selectedProduct = $_POST['product'];
            $selectedQuantity = (int)$_POST['quantity'];
            $productPrice = rand(1000, 10000); 
            
            if ($selectedQuantity > 0) {
                $productTotal = $selectedQuantity * $productPrice;
                echo "<div>{$selectedProduct} x{$selectedQuantity} - $productTotal</div>";
            }
        }
        ?>
        
        <button type="submit" name="createQuote">Create Quote</button>
    </form>
</body>
</html>


