<?php
  include('admin/_db_login.php');

  // open connection
  $connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

  // select database
  mysql_select_db($db) or die ("Unable to select database!");

  $query = "select * from newsletters order by id";
  $newsletters = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
?>

<?php include('_doctype_&_head.php'); ?>
  
<body>
<div id="page">
        
  <?php include('_horiz_nav_top.php'); ?>
  
	<div id="newsletters-main-panel" class="main-panel">
	  
		<img src="images/newsletters-banner.gif" width="950" 
		  height="225" alt="Newsletters"/>
	  
		<div class="main-text">
		  
		  <p>Wells NCI publishes a Newsletter from time-to-time 
		    to keep members informed of station business.</p>
		  <p>Please click on the buttons below if you would like to 
		    know what we have been up to.</p>
		  
		  <ul id="newsletter-list">
		    <?php 
          if (mysql_num_rows($newsletters) > 0) {
            while($newsletter = mysql_fetch_row($newsletters)) { 
        ?> 
        <li>
          <a href="<?php echo $newsletter[1]; ?>">
            <?php echo basename($newsletter[1]); ?></a>
        </li>

        <?php
            }//end while
          } else { echo "No newsletters found in memebersdb database."; } 
        ?>
		  </ul>
		  
		  <p id="adobe-icon">
		    <a href="http://get.adobe.com/reader/">
		      <img src="images/get_adobe_reader.gif" alt="Get Adobe Reader" /></a> 
		  </p>
		
		</div><!--end main-text-->	
	
	</div><!--end main-panel-->
	
	<?php include('_horiz_nav_bottom.php'); ?>
	  
  <?php include('_w3c_logos.php'); ?>

</div><!--end page-->
</body>
</html>

