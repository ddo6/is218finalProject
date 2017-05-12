<?php include '../view/header.php'; ?>
<!-- Error file that is thrown if databse error occurs -->
<div id="main">
    <h1 class="top">Database Error</h1>
    <p>An error occurred while attempting to work with the database.</p>
    <p>Message: <?php echo $error_message; ?></p>
    <p>&nbsp;</p>
</div><!-- end main -->
<?php include '../view/footer.php'; ?>
