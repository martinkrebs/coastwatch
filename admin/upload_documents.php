<?php include('_doctype_&_head.php') ?>

<body>
<div id="admin-page" class="page">
  
  <h1>Admin - Upload Documents</h1>

  <div id="admin-page-body" >

    <?php include('_admin_panel_left.php'); ?>
    
    <div id="admin-panel-right">       
     <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="upload">
      <fieldset>
        <legend>Upload Document</legend>
        <div>
          <label for="file" class="fixedwidth">Document:</label>
          <input id="file" type="file" name="file" size="50" />
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
      $docsDir = 'documents/';

      $finalFilename = $docsDir . basename( $_FILES[$fieldname]['name']);
     
      // move the file over to the destination directory, if ok then also save data to database
      if(move_uploaded_file($_FILES[$fieldname]['tmp_name'], '../' . $finalFilename)) {

        // Write info to database
        include('_db_login.php');

        // open connection
        $connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

        // select database
        mysql_select_db($db) or die ("Unable to select database!");

        // create query
        $query = "INSERT INTO documents (filename) VALUES ('$finalFilename')";

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