<?php $file = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="admin-panel-left">
  <h2>Add:</h2>
  <ul id="admin-nav">
    <li><a href="upload_photos.php" <?php if ($file == 'upload_photos.php') echo 'class="selected"'; ?> >Photos</a></li>
  	<li><a href="add_notices.php" <?php if ($file == 'add_notices.php') echo 'class="selected"'; ?> >Notices</a></li>
  	<li><a href="add_diarydates.php" <?php if ($file == 'add_diarydates.php') echo 'class="selected"'; ?> >Diary Dates</a></li>
  	<li><a href="upload_documents.php" <?php if ($file == 'upload_documents.php') echo 'class="selected"'; ?> >Documents</a></li>
  	<li><a href="upload_newsletters.php" <?php if ($file == 'upload_newsletters.php') echo 'class="selected"'; ?> >Newsletters</a></li>
  	<li><a href="upload_roster.php" <?php if ($file == 'upload_roster.php') echo 'class="selected"'; ?> >Roster</a></li>            
  </ul>
  <h2>Delete:</h2>
  <ul>  	    
    <li><a href="delete_photos.php" <?php if ($file == 'delete_photos.php') echo 'class="selected"'; ?> >Photos (table view)</a></li>
    <li><a href="delete_photos_gallery_view.php" <?php if ($file == 'delete_photos_gallery_view.php') echo 'class="selected"'; ?> >Photos (gallery view)</a></li>
    <li><a href="delete_notices.php" <?php if ($file == 'delete_notices.php') echo 'class="selected"'; ?> >Notices</a></li>
    <li><a href="delete_diarydates.php" <?php if ($file == 'delete_diarydates.php') echo 'class="selected"'; ?> >Diary Dates</a></li>
    <li><a href="delete_documents.php" <?php if ($file == 'delete_documents.php') echo 'class="selected"'; ?> >Documents</a></li>
    <li><a href="delete_newsletters.php" <?php if ($file == 'delete_newsletters.php') echo 'class="selected"'; ?> >Newsletters</a></li>        			   
  </ul>      	
  <h2>Exit to:</h2>
  <ul>  	    
    <li><a href="../members/members.php">Members Page</a></li>
    <li><a href="../index.php">Home Page</a></li>   
  </ul>
</div><!--end admin-panel-left-->