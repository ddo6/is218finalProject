<?php include '../../view/header.php'; ?>
<!-- PHP file to display select technician option -->
<main>
    <h3>Select Technician</h3>

    <div id="main">
        <!-- display a table of technicians -->
        <table>
            <tr>
                <th>Name</th>
                <th>Open Incidents</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($technicians as $technician) : ?>
            <tr>
                <?php $tech = new Technician($technician['firstName'], $technician['lastName']); ?>
                <td><?php echo $tech->getFullName(); ?></td>
                <td><?php echo $technician['openIncidents']; ?></td>
                <!-- select the technician -->
                <td><form action="" method="post">
                    <input type="hidden" name="action"
                           value="select_technician">
                    <input type="hidden" name="id"
                           value="<?php echo $technician['techID']; ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>      
    </div>
</main>
<?php include '../../view/footer.php'; ?>
