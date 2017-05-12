<?php include '../../view/header.php'; ?>
<!-- Searches up customer based on email to create incident -->
<main>
    <h1>Get Customer</h1>

    <div id="main">
        <p>You must enter the customer's email address to select the customer.</p>
        <!-- search customers by email -->
        <form action="index.php" method="post" id="search_customer">
            <input type="hidden" name="action" value="search_customers">
            <input type="text" name="email" value="">
            <input type="submit" value="Get Customer"><br>
        </form>     
    </div>
</main>
<?php include '../../view/footer.php'; ?>
