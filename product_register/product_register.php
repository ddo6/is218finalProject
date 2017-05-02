<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product</h1>
    <div id="main">
        <form action="." method="post" id="register_form">
            <input type="hidden" name="action" value="register_product" />
            
            <label>Customer:</label> <?php echo $customer_name; ?>
            <br />
            
            <label>Product:</label>
            <select name="code">
                <?php foreach ($products as $product) : ?>
                    <option value="<?php echo $product['productCode']; ?>">
                        <?php echo $product['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br />
            
            <input type="submit" value="Register Product" />
        </form>
        <form action="." method ="post" id="logout">
            <input type="hidden" name="action" value="logout" />
            <p>You are logged in as <?php echo $_SESSION['user']['email']; ?></p>
            <input type="submit" value="Logout" />
        </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>