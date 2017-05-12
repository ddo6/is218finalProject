<?php include '../../view/header.php'; ?>
<!-- Displays table of incidents and assigns to technician -->
<main>
    <h3>Select Incident</h3>

    <div id="main">
        <!-- display a table of incidents -->
        <table>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Date Opened</th>
                <th>Title</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['firstName'] . " ". $incident['lastName']; ?></td>
                <td><?php echo $incident['productCode']; ?></td>
                <td><?php echo $incident['dateOpened']; ?></td>
                <td><?php echo $incident['title']; ?></td>
                <td><?php echo $incident['description']; ?></td>
                <!-- select the incident -->
                <td><form action="" method="post">
                    <input type="hidden" name="action"
                           value="show_select_technician">
                    <input type="hidden" name="id"
                           value="<?php echo $incident['incidentID']; ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>      
    </div>
</main>
<?php include '../../view/footer.php'; ?>

