<?php include '../../view/header.php'; ?>
<main>
    <h3>Unassigned Incidents | <a href="?action=list_assigned_incidents">Assigned Incidents</a></h3>

    <div id="main">
        <!-- display a table of incidents -->
        <table class="outer_table">
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Incident</th>
            </tr>
            <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident['firstName'] . " ". $incident['lastName']; ?></td>
                <td><?php echo $incident['name']; ?></td>
                <td>
                    <table class="inner_table">
                        <tr>
                            <td>ID:</td>
                            <td><?php echo $incident['incidentID']; ?></td>
                        </tr>
                        <tr>
                            <td>Opened:</td>
                            <td><?php $dateOpened = new DateTime($incident['dateOpened']); 
                                      echo $dateOpened->format('m/d/Y'); ?></td>
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
