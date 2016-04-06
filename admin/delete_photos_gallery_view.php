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
<?php include('_open_db_&_get_all_rows.php') ?>


<body>  
<div id="admin-page" class="page">
  
  <h1>Admin - Slideshow Delete Photos</h1>

  <div id="admin-page-body" >

    <?php include('_admin_panel_left.php'); ?>
    
    <div id="admin-panel-right">
      <?php
      // only process if we have photos in memebersdb database
      if (mysql_num_rows($result) > 0) {
        
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
        if( isset($_GET['next']) && ($_SESSION['photoIndex'] < $size - 1) ){
          $_SESSION['photoIndex']++;
        }
        
        // if prev button was pressed, AND photoIndex is greater than zero, then decrement photoIndex
        if( isset($_GET['prev']) && ($_SESSION['photoIndex'] > 0) ){
          $_SESSION['photoIndex']--;
        }

        // Only if delete has been posted from the form, delete the particular notice
        if( isset($_POST['delete']) ){
          
          // first get the current photo position number
          $newPosition = ($_SESSION['photoIndex'] + 1);

          // get filename  of photo to delete, we need this later 
          $query = "select * from photos where position = $newPosition";
          $result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
          $row = mysql_fetch_row($result);
          $filename = $row[1];
         
          // create query to delete record
          $query = "DELETE FROM photos WHERE position = " . ($_SESSION['photoIndex'] + 1);

          // execute query
          $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
          
          // We need to subtract 1 from the position value of all photos above the one that was deleted,
          // to close up the gap in postion sequence after the photo is deleted
          $query = "update photos set position = position - 1 where position > $newPosition";
          mysql_query($query) or die ("Error in query: $query. " . mysql_error());
          
          // delete the photo file from the gallery folder
          unlink( '../' . $filename);
      
          // create query to get all rows again after delete
          $query = "select * from photos order by position";
          // execute query
          $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
        } // end if( isset...
      ?>  
      <div id="delete-photos">
        <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="get">
          <input type="submit" name="prev" value="&lt; PREV" />
          <strong>&nbsp;<?php echo $_SESSION['photoIndex'] + 1; ?>&nbsp;</strong>
          <input type="submit" name="next" value="NEXT &gt;" />
        </form>
        <div class="picture-box">
        	<img id="picture" src="<?php echo '../' . $photos['filenames'][$_SESSION['photoIndex']] ?>" 
        	  alt="Gallery picture"/>
        	<p id="caption" class="caption">
        	  <?php echo $photos['captions'][$_SESSION['photoIndex']]; ?> 
        	</p>
        	<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="delete" value="DELETE" />
          </form>		    
        </div><!--end picture-box-->
      </div><!--end gallery-->
      <?php
      } 
      else {
          echo "No photos found in database.";
      } // end if (mysql_num_rows... else ...
      // free result set memory
      mysql_free_result($result);
      
      // close connection
      mysql_close($connection);      
      ?> 
    </div><!--end admin-panel-right-->
    
  </div><!--end admin-page-body-->

<?php include('_w3c_logos.php') ?>
  
</div><!--end page-->
</body>
</html>