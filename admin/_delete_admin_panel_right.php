<div id="admin-panel-right">  
  <?php
  // only process if we have rows db table
  if (mysql_num_rows($result) > 0) { 
         
    // if delete has been posted from the form, delete the particular row
    if( isset($_POST['delete']) ){

      // extract id from post variable
      $id = $_POST['delete'];
      
      // if this model stores a file in the file system then delete this first
      if($dbTable['has_file'] == 'yes') {
        // get filename and position value of photo to delete, we need these later 
        $query = "select filename from " . $dbTable['name'] . " where id = $id";
        $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
        $row = mysql_fetch_row($result);
        unlink('../' . $row[0]); 
      }

      // create query to delete record
      $query = "delete from " . $dbTable['name'] . " where id = $id";

      // execute query
      $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());

      // create query to get all rows again after delete
      $query = "select * from " . $dbTable['name'] . " order by id desc";

      // execute query
      $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
    } // end if( isset...
  ?>  
  <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table id="delete-row" border="1" cellspacing="0" cellpadding="5" >
      <tr>
        <th><?php echo $dbTable['col1']; ?></th>
        <th><?php echo $dbTable['col2']; ?></th>
        <th>*DELETE*</th>        
      </tr>
      <?php while($row = mysql_fetch_row($result)) { ?>
      <tr>
        <td><?php echo $row[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td class="delete-button"><input type="submit" name="delete" value="<?php echo $row[0]; ?>" /></td>
      </tr>
      <?php } ?>
    </table>
  </form>
  <?php
  } 
  else {
      echo "No " . $dbTable['name'] . " found in database.";
  }
  
  // free result set memory
  mysql_free_result($result);
  
  // close connection
  mysql_close($connection);        
  ?>
</div><!--end admin-panel-right-->