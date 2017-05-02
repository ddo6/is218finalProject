<?php include '../../view/header.php'; ?>
<main>
    <h1>Product List</h1>

    <div id="main">
        <!-- display a table of products -->
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Version</th>
                <th>Release Date</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['version']; ?></td>
                <td><?php $date = new DateTime($product['releaseDate']); 
                     echo $date->format('m-d-Y'); ?></td>
                <!-- delete the product -->
                <td><form action="" method="post">
                    <input type="hidden" name="action"
                           value="delete_product">
                    <input type="hidden" name="code"
                           value="<?php echo $product['productCode']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="?action=show_add_form">Add Product</a></p>       
    </div>
</main>
<?php include '../../view/footer.php'; ?>