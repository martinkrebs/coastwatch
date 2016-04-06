<?php include('_doctype_&_head.php') ?>

<body>
<div id="admin-page" class="page">
  
  <h1>Admin - Upload Photos</h1>

  <div id="admin-page-body" >

    <?php include('_admin_panel_left.php'); ?>
    
    <div id="admin-panel-right">
      <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" class="upload">
        <fieldset>
          <legend>Upload Photo</legend>
          <div>
            <label for="file" class="fixedwidth">Photo:</label>
            <input id="file" type="file" name="file" size="50" />
          </div>
          <div>      
            <label for="caption" class="fixedwidth">Caption:</label>
            <input id="caption" name="caption" type="text" size="60" />
          </div> 
          <div>
            <label for="position" class="fixedwidth">Position:</label>
            <input id="position" type="text" name="position" size="5" /><span>( Leave blank if just adding photo to next free position )</span>
          </div>
          <div class="button-area">
            <input type="submit" name="submit" value="upload" />
          </div>
        </fieldset>
      </form>
    <?php
    // Only process if form has been submitted and the file field has data
    if ( isset($_POST['submit'])) {

      // fieldname used within the file <input> of the HTML form
      $fieldname = 'file';
	  $photosDir = 'gallery/';      
     
      // get form input, check to make sure it's all there, escape input values for greater safety
      $caption = empty($_POST['caption']) ? die ("ERROR: Enter caption") : mysql_escape_string($_POST['caption']);
      
      $finalFilename = $photosDir . basename( $_FILES[$fieldname]['name']);
      
            
      // move the file over to the destination directory, if ok then also save data to database
      if(move_uploaded_file($_FILES[$fieldname]['tmp_name'], '../' . $finalFilename)) {

        // Write info to database
        include('_db_login.php');

        // open connection
        $connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

        // select database
        mysql_select_db($db) or die ("Unable to select database!");     

        // get the next free postion from the database
        $query = "select max(position) as position from photos";
        $result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
        $row = mysql_fetch_row($result);
        $nextFreePosition = $row[0] + 1;
        
        // First extract the position user set in the form, if none, set position to be next free position
        if( empty($_POST['position']) ){
          $newPosition = $nextFreePosition;              
        }
        else {
          // use position entered in form, unless it is less than 1 or above next free postion, then just use next free position instead,
          $newPosition =
            ( (mysql_escape_string($_POST['position']) > $nextFreePosition) ||
              (mysql_escape_string($_POST['position']) < 1) ) ? 
              $nextFreePosition : mysql_escape_string($_POST['position']);
        } 
               
        // First, if required, we need to re order the values in the position column to allow insertion of new photo at 
        // the required position entered into the form.
        $query = "update photos set position = position + 1 where position >= $newPosition";
        mysql_query($query) or die ("Error in query: $query. ".mysql_error());
        
     
        // Now we can write the photo info to the data base
        // create query
        $query = "INSERT INTO photos (filename, caption, position) VALUES ('$finalFilename', '$caption', '$newPosition')";
        

        // execute query
        mysql_query($query) or die ("Error in query: $query. ".mysql_error());

        // print message with ID of inserted record
        echo "New record inserted with ID ".mysql_insert_id();
        
        // close connection
        mysql_close($connection);

      } 
      else { 
        echo "There was an error uploading the file, please try again!";
      }
    }
    ?>
    </div><!--end admin-pannel-right-->
        
  </div><!--end admin-page-body-->

  <?php include('_w3c_logos.php') ?>
  
</div><!--end page-->
</body>
</html>