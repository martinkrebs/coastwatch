<?php include('_doctype_&_head.php') ?>

<body>  
<div id="admin-page" class="page">
  
  <h1>Admin - Upload Roster</h1>

  <div id="admin-page-body" >

    <?php include('_admin_panel_left.php'); ?>
    
    <div id="admin-panel-right">
      <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" class="upload">
        <fieldset>
          <legend>Upload Roster</legend>
          <div>
            <label for="file" class="fixedwidth">Roster:</label>
            <input id="file" type="file" name="file" size="50" />
          </div>
          <div class="button-area">
            <input type="submit" name="submit" value="upload" />
          </div>
        </fieldset>
      </form>
      <?php
      if(isset($_POST['submit'])) {

        // fieldname used within the file <input> of the HTML form
        $fieldname = 'file';
      	$docsDir = 'documents/';
        $finalFilename = $docsDir . 'roster.pdf';
        
        // move the uploaded file to destination folder, and allocate the new filename 
        if(move_uploaded_file($_FILES[$fieldname]['tmp_name'], '../' . $finalFilename)) {
          echo "Saved roster OK.";
        }
        else {
          echo "There was an error uploading the file, please try again.";
        }
      }
      ?>
    </div><!--end admin-pannel-right-->
    
  </div><!--end admin-page-body-->

  <?php include('_w3c_logos.php') ?>
  
</div><!--end page-->
</body>
</html>