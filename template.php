<?php
/**
 * Template Name: eliza
 *
 * @package WordPress
 */
global $EM_Event;
?>
 <?php echo $_POST['yourname']; ?><br />
  <?php echo $_POST['price']; ?><br />
Your e-mail: <?php echo $_POST['email']; ?><br />

<?php echo $EM_Event->output('#_BOOKINGFORM'); ?>
<?php

genesis();
