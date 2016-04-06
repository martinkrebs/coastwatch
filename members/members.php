<?php
  include('../admin/_db_login.php');
  
  
  // open connection
  $connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

  // select database
  mysql_select_db($db) or die ("Unable to select database!");

  // get notices
  $query = "select * from notices order by postdate desc";
  $notices = mysql_query($query) or die ("Error in query: $query. ".mysql_error());

  $query = "select date_format(postdate, '%a %D %b %Y %H:%i') from notices order by postdate desc";
  $noticePostdates = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
  
  // get diary dates 
  $query = "select * from diarydates order by date";
  $diarydates = mysql_query($query) or die ("Error in query: $query. ".mysql_error());

  $query = "select date_format(date, '%a %D %b %Y') from diarydates order by date";
  $diaryEventdates = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
  
  $query = "select date_format(postdate, '%a %D %b %Y %H:%i') from diarydates order by date";
  $diaryPostdates = mysql_query($query) or die ("Error in query: $query. ". mysql_error());
 
   // get documents
  $query = "select * from documents order by id desc";
  $documents = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
?>

<?php include('_doctype_&_head.php') ?>

<body>
<div class="page">
  
  <?php include('_horiz_nav_top.php') ?>
  
  <img src="../images/members-area-banner-blue.gif" alt="Members Page" usemap="#admin" ismap="ismap" />
  <map name="admin">
    <area shape="circle" coords="804,40,10" href="../admin/upload_photos.php" >
  </map>
  
  <div class="page-body">
     <div id="notices" class="display-panel scroll-panel">     
      <h2>NOTICES</h2>
      <?php 
        if (mysql_num_rows($notices) > 0) {
          while($notice = mysql_fetch_row($notices)) { 
      ?>
      <div class="notice">
        <h3 class="notice-title"><?php echo stripslashes($notice[1]); ?></h3>
        <p class="notice-body"><?php echo stripslashes($notice[2]); ?></p>
        <p class="notice-author">- <?php echo stripslashes($notice[3]); ?>
            <?php $postdate = mysql_fetch_row($noticePostdates) ?>
            <span class="notice-postdate"><?php echo stripslashes($postdate[0]); ?></span></p>   
      </div><!--end notice-->
      <?php 
          }
        } else { echo "No notices found in database."; } 
       ?>
    </div><!--end notices-->
    
    
    <div id="layout-panel-right" >

      <div id="roster" class="display-panel">
        <a href="../documents/roster.pdf"><h2><p>CLICK HERE FOR THE</p>
          <p>WATCH ROSTER</p></h2></a>      
      </div><!--end roster-->

    
      <div id="diarydates" class="display-panel scroll-panel">
        <h2>DIARY DATES</h2>
        <?php 
          if (mysql_num_rows($diarydates) > 0) {
            while($diarydate = mysql_fetch_row($diarydates)) { 
        ?>       
        <div class="diarydate">
            <?php $diaryEventdate = mysql_fetch_row($diaryEventdates) ?>
          <h3 class="diary-event-date"><?php echo stripslashes($diaryEventdate[0]); ?></h3>
          <p class="diarydate-body"><?php echo stripslashes($diarydate[1]); ?></p>
          <p class="diarydate-author">- <?php echo stripslashes($diarydate[2]); ?>
              <?php $postdate = mysql_fetch_row($diaryPostdates) ?>
              <span class="diarydate-postdate"><?php echo stripslashes($postdate[0]); ?></span></p>   
        </div><!--end notice-->
        <?php
            }//end while
          } else { echo "No diary dates found in database."; } 
        ?>                
      </div><!--end diarydates-->
    
    
      <div id="documents" class="display-panel scroll-panel">
        <ul id="links">
          <li class="odd-row, title-li"><h2>DOCUMENTS AVAILABLE</h2></li>
          <?php 
            if (mysql_num_rows($documents) > 0) {
              while($document = mysql_fetch_row($documents)) { 
          ?>
  				<li>
  				  <a href="<?php echo '../' . $document[1]; ?>"><?php echo basename($document[1]); ?></a>
  				</li>
          <?php
              }//end while
            } else { echo "No documents found in database."; }
            
            // free result set memory
            mysql_free_result($notices);
            mysql_free_result($noticePostdates);
            mysql_free_result($diarydates);
            mysql_free_result($diaryEventdates);
            mysql_free_result($documents);

            // close connection
            mysql_close($connection); 
          ?>
  			</ul>
  		    <a href="http://get.adobe.com/reader/">
  		      <img src="../images/get_adobe_reader.gif" alt="Get Adobe Reader" /></a> 
      </div><!--end documents-->

    </div><!--end right-panel-->
    
    <?php include('../members/hits.php') ?> 
        
  </div><!--end page-body-->  
  
 <?php include('_w3c_logos.php') ?>
  
</div><!--end page-->
</body>
</html>