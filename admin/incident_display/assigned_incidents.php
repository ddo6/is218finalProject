<?php include '../../view/header.php'; ?>
<main>
    <h3>Assigned Incidents | <a href="?action=list_unassigned_incidents">Unassigned Incidents</a></h3>

    <div id="main">
        <!-- display a table of incidents -->
        <table class="outer_table">
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Technician</th>
                <th>Incident</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['incidentID'] . ?></td>
               <td><?php echo $incident['cFirstName'] . " ". $incident['cLastName']; ?></td>
                <td><?php echo $incident['productName']; ?></td>
                <td><?php echo $incident['tFirstName'] . " ". $incident['tLastName']; ?></td>
                <td>
                    <table class="inner_table">
                        <tr>
                            <td>ID:</td>
                            <td><?php echo $incident['id']; ?></td>
                        </tr>
                        <tr>
                            <td>Opened:</td>
                            <td><?php $dateOpened = new DateTime($incident['open']); 
                                      echo $dateOpened->format('m/d/Y'); ?></td>
                        </tr>
                        <tr>
                            <td>Closed:</td>
                            <?php if (!empty($incident['closed'])) : ?>
                                <td><?php $dateClosed = new DateTime($incident['closed']); 
                                          echo $dateClosed->format('m/d/Y'); ?></td>
                            <?php else: ?>
                                <td>OPEN</td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td>Title:</td>
                            <td><?php echo $incident['title']; ?></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><?php echo $incident['description']; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>      
    </div>
</main>
<?php include '../../view/footer.php'; ?>
