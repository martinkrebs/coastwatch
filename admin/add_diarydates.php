<?php include('_doctype_&_head.php') ?>

<body>
<div id="admin-page" class="page">
  
  <h1>Admin - Add Diary Dates</h1>

  <div id="admin-page-body" >

    <?php include('_admin_panel_left.php'); ?>

    <div id="admin-panel-right">       
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="upload">
      <fieldset>
        <legend>Add Diary Date</legend>
        <div>
          <label for="title" class="fixedwidth">Title:</label>
          <input type="text" name="title" id="title" size="40" />
        </div>
        <div>      
          <label for="date" class="fixedwidth">Date:</label>
          <input type="text" id="date" name="date" /><span>( YY-MM-DD )</span>
        </div> 
        <div>        
          <label for="author" class="fixedwidth">Author:</label>
          <input type="text" name="author" id="author" size="30" />
        </div> 
        <div class="button-area">
          <input type="submit" name="submit" value="submit" />
        </div>
      </fieldset>
    </form>
    <?php
    // if form submitted we need to add notice
    if (isset($_POST['submit'])) {
      
      // get form input, check to make sure it's all there, escape input values for greater safety
      $title = empty($_POST['title']) ? die ("ERROR: Enter title") : mysql_escape_string($_POST['title']);
      $date = empty($_POST['date']) ? die ("ERROR: Enter date") : mysql_escape_string($_POST['date']);
      $author = empty($_POST['author']) ? die ("ERROR: Enter author") : mysql_escape_string($_POST['author']);
            
      include('_db_login.php');

      // open connection
      $connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

      // select database
      mysql_select_db($db) or die ("Unable to select database!");

      // create query
      $query = "INSERT INTO diarydates (title, date, author) VALUES ('$title', '$date', '$author')";

      // execute query
      mysql_query($query) or die ("Error in query: $query. ".mysql_error());

      // print message with ID of inserted record
      echo "New record inserted with ID" . mysql_insert_id();
      
      // close connection
      mysql_close($connection);
    }
    ?>
    </div><!--end admin-panel-right-->
    
  </div><!--end admin-page-body-->
  
  <?php include('_w3c_logos.php') ?>
  
</div><!--end page-->
</body>
</html>