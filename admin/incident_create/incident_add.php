<?php include '../../view/header.php'; ?>
<main>
    <h1>Create Incident</h1>
    <div id="main">
        <form action="." method="post" id="incident_form">
            <input type="hidden" name="action" value="create_incident">
            
            <input type="hidden" name="customer_id" value="<?php echo $customer['customerID']; ?>">
            
            <label>Customer:</label> <?php echo $customer['firstName'] . " ". $customer['lastName']; ?>
            <br />
            
            <label>Product:</label>
            <select name="product">
                <?php foreach ($registrations as $registration) : ?>
                    <option value="<?php echo $registration['productCode']; ?>">
                        <?php echo $registration['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br />
            
            <label>Title:</label>
            <input type="text" name="title" size="26" />
            <br />
            
            <label>Description:</label><br />
            <textarea name="description" rows="5" cols="46"></textarea>
            <br />
            
            <input type="submit" value="Create Incident" />
        </form>
    </div>
</main>
<?php include '../../view/footer.php'; ?>