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
  
  <h1>Admin - Delete Photos</h1>

  <div id="admin-page-body" >

    <?php include('_admin_panel_left.php'); ?>
    
    <div id="admin-panel-right">
      <?php
      // only process if we have photos in memebersdb database
      if (mysql_num_rows($result) > 0) { 
             
        // if delete has been posted from the form, delete the particular notice
        if( isset($_POST['delete']) ){

          // extract id from post variable
          $id = $_POST['delete'];

          // get filename and position value of photo to delete, we need these later 
          $query = "select * from photos where id = $id";
          $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
          $row = mysql_fetch_row($result);
          $filename = $row[1];
          $newPosition = $row[3];
         
          // create query to delete record
          $query = "DELETE FROM photos WHERE id = $id";

          // execute query
          $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
          
          // We need to subtract 1 from the position value of all photos above the one to be deleted,
          // to close up the gap in postion sequence after the photo is deleted
          $query = "update photos set position = position - 1 where position > $newPosition";
          mysql_query($query) or die ("Error in query: $query. " . mysql_error());
          
          // delete the photo file from the gallery folder
          unlink('../' . $filename);
      
          // create query to get all rows again after delete
          $query = "select * from photos order by position";

          // execute query
          $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
        } // end if( isset...
      ?>  
      <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table id="delete-diarydate" border="1" cellspacing="0" cellpadding="5" >
          <tr>
            <th>id</th>
            <th>filename</th>
            <th>position</th>
            <th>*DELETE*</th>        
          </tr>
          <?php while($row = mysql_fetch_row($result)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo basename($row[1]); ?></td>
            <td><?php echo $row[3]; ?></td>
            <td class="delete-button"><input type="submit" name="delete" value="<?php echo $row[0]; ?>" /></td>
          </tr>
          <?php } ?>
        </table>
      </form>
      <?php
      } 
      else {
          echo "No photos found in database.";
      }
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