<?php session_start(); // must start session FIRST ?>

<?php  
// INCLUDE THIS PHP BLOCK FIRST ON EVERY PAGE
$dbTable['name'] = 'photos';
$dbTable['has_file'] = 'yes';
$dbTable['order_by'] = 'position';
$dbTable['col1'] = 'id';
$dbTable['col2'] = 'filename';
$dbTable['col3'] = 'caption';
$dbTable['col4'] = 'position';
?>

<?php include('_doctype_&_head.php') ?>
<?php include('admin/_open_db_&_get_all_rows.php') ?>
  
<body>
<div id="page"> 
       
  <?php include('_horiz_nav_top.php'); ?>
  
	<div id="gallery-main-panel" class="main-panel">
	  
		<div id="gallery-main-text" class="main-text">
		  <h1>Photo Gallery</h1>
		</div><!--end gallery-main-text-->

	  <?php
    if ( mysql_num_rows($result) > 0 ) {
              
      // get all the filenames into an array
      while($row = mysql_fetch_row($result)) {
         $photos['filenames'][] = $row[1];
         $photos['captions'][] = $row[2];           
      }

      $size = sizeof($photos['filenames']);

      // PREV & NEXT processing - We want photoIndex to go from zero to $size -1
      // if photoIndex is not set yet, then intialize to zero, if it is set, just use that existing value
      $_SESSION['photoIndex'] = ((isset($_SESSION['photoIndex'])) ? $_SESSION['photoIndex'] : 0 );

      // if the next button was pressed, AND photoindex is less than max, then increment photoIndex
      if( isset($_GET['next']) && ($_SESSION['photoIndex'] < $size -1) ){
        $_SESSION['photoIndex']++;
      }
      
      // if prev button was pressed, AND photoIndex is greater than zero, then decrement photoIndex
      if( isset($_GET['prev']) && ($_SESSION['photoIndex'] > 0) ){
        $_SESSION['photoIndex']--;
      }
    ?>
	  <div id="gallery">
	    <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="get">
        <p><input type="submit" name="prev" value="&lt; PREV" />
          <strong>&nbsp;<?php echo $_SESSION['photoIndex'] + 1; ?>&nbsp;</strong>
          <input type="submit" name="next" value="NEXT &gt;" /></p>
      </form>
	    <div class="picture-box">
      	<img id="picture" src="<?php echo $photos['filenames'][$_SESSION['photoIndex']] ?>" 
      	  alt="Gallery picture"/>
      	<p id="caption" class="caption">
      	  <?php echo $photos['captions'][$_SESSION['photoIndex']]; ?> 
      	</p>		    
      </div><!--end picture-box-->
    </div><!--end gallery-->
    <?php
    } // end if( mysql_num_rows...
    else {
      echo "No photos found in gallery.";
    } // end if (mysql_num_rows... else ...
    // free result set memory
    mysql_free_result($result);

    // close connection
    mysql_close($connection);      
    ?>
	  
	</div><!--end main-panel-->
	
	<?php include('_horiz_nav_bottom.php'); ?>
	
  <?php include('_w3c_logos.php'); ?>
    
</div><!--end page-->
</body>
</html>
