<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product</h1>
    <div id="main">
        <p>Product (<?php echo $code; ?>) was registered successfully.</p>
        <p><a href=".">Register another product</a></p>
        <form action="." method ="post" id="logout">
            <input type="hidden" name="action" value="logout" />
            <p>You are logged in as <?php echo $_SESSION['user']['email']; ?></p>
            <input type="submit" value="Logout" />
        </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>