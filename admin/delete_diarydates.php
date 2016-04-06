<?php  
// INCLUDE THIS PHP BLOCK FIRST ON EVERY PAGE
$dbTable['name'] = 'diarydates';
$dbTable['has_file'] = 'no';
$dbTable['order_by'] = 'date';
$dbTable['col1'] = 'id';
$dbTable['col2'] = 'title';
$dbTable['col3'] = 'date';
$dbTable['col4'] = 'author';
$dbTable['col5'] = 'postdate';
?>

<?php include('_doctype_&_head.php') ?>
<?php include('_open_db_&_get_all_rows.php') ?>

<body>
<div id="admin-page" class="page">  
  
  <h1>Admin - Delete Diary Dates</h1>

  <div id="admin-page-body" >
    <?php include('_admin_panel_left.php'); ?>      
    <?php include('_delete_admin_panel_right.php') ?>
  </div><!--end admin-page-body-->

  <?php include('_w3c_logos.php') ?>
  
</div><!--end page-->
</body>
</html>