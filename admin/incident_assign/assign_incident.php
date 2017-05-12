<?php include ('../../view/header.php'); ?>
<!-- Assigns incident to Technician Selected from technician DB -->
<main>
    <h3>Assign Incident</h3>
    <form action="index.php" method="post" id="assign_incident_form">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="action" value="assign_technician" />

        <label>Customer:</label>
        <span><?php echo $customer_name ?></span><br />

        <label>Product:</label>
        <span><?php echo $product ?></span><br />
        
        <label>Technician:</label>
        <span><?php echo $technician_name ?></span><br />
        
        <label>&nbsp;</label>
        <input type="submit" value="Assign Incident"><br />
        </form>
</main>
<?php include ('../../view/footer.php'); ?>
