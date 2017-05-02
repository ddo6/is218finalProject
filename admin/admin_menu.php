<?php include ('view/header.php'); ?>
<div id="main">
    <h2>Admin Menu</h2>
    <ul class="nav">
        <li><a href="product_manager">Manage Products</a></li>
        <li><a href="technician_manager">Manage Technicians</a></li>
        <li><a href="customer_manager">Manage Customers</a></li>
        <li><a href="incident_create">Create Incident</a></li>
        <li><a href="incident_assign">Assign Incident</a></li>
        <li><a href="incident_display">Display Incidents</a></li>
    </ul>
    <h2>Login Status</h2>
    <form action="." method ="post" id="logout">
        <input type="hidden" name="action" value="logout" />
        <p>You are logged in as <?php echo $_SESSION['admin']['username']; ?></p>
        <input type="submit" value="Logout" />
    </form>
</div>
<?php include ('view/footer.php'); ?>