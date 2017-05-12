<?php include ('../../view/header.php'); ?>
<!-- Updated Customer Add/Update to Display information from cutomer DB -->
<main>
    <h1>Add/Update Customer</h1>
    <form action="index.php" method="post" id="add_edit_customer_form">
        
        <?php if (isset($id)) : ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="action" value="update_customer" />
        <?php else: ?>
            <input type="hidden" name="action" value="add_customer" />
        <?php endif; ?>

        <label>First Name:</label>
        <input type="text" name="fname"
               value="<?php echo htmlspecialchars($fname); ?>" />
        <?php echo $fields->getField('fname')->getHTML(); ?><br />

        <label>Last Name:</label>
        <input type="text" name="lname"
               value="<?php echo htmlspecialchars($lname); ?>" />
        <?php echo $fields->getField('lname')->getHTML(); ?><br />
        
        <label>Address:</label>
        <input type="text" name="address" size="45"
               value="<?php echo htmlspecialchars($address); ?>" />
        <?php echo $fields->getField('address')->getHTML(); ?><br />
        
        <label>City:</label>
        <input type="text" name="city"
               value="<?php echo htmlspecialchars($city); ?>" />
        <?php echo $fields->getField('city')->getHTML(); ?><br />
        
        <label>State:</label>
        <input type="text" name="state"
               value="<?php echo htmlspecialchars($state); ?>" />
        <?php echo $fields->getField('state')->getHTML(); ?><br />
        
        <label>Postal Code:</label>
        <input type="text" name="zip"
               value="<?php echo htmlspecialchars($zip); ?>" />
        <?php echo $fields->getField('zip')->getHTML(); ?><br />
        
        <label>Country Code:</label>
        <select name="country">
        <?php foreach ($countries as $country) : ?>
            <option value="<?php echo $country['countryCode'];?>" 
            <?php if($country['countryCode']===$customer['countryCode']) {
                    echo "selected='selected'";
                  }
            ?>>
                <?php echo $country['countryName']; ?>
            </option>
        <?php endforeach; ?>
        </select><br />
        
        <label>Phone:</label>
        <input type="text" name="phone"
               value="<?php echo htmlspecialchars($phone); ?>" />
        <?php echo $fields->getField('phone')->getHTML(); ?><br />
        
        <label>Email:</label>
        <input type="text" name="email" size="40"
               value="<?php echo htmlspecialchars($email); ?>" />
        <?php echo $fields->getField('email')->getHTML(); ?><br />
        
        <label>Password:</label>
        <input type="text" name="password"
               value="<?php echo htmlspecialchars($password); ?>" />
        <?php echo $fields->getField('password')->getHTML(); ?><br />
        
        <label>&nbsp;</label>
        <?php if (isset($id)) : ?>
            <input type="submit" value="Update Customer"><br />
        <?php else: ?>
            <input type="submit" value="Add Customer"><br />
        <?php endif; ?>
        </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_customers">Search Customers</a>
    </p>

</main>
<?php include ('../../view/footer.php'); ?>
