<?php
  $filename = "home_hits.txt";
  $count= file($filename);
  $count[0]++;
  $file = fopen ($filename, "w") or die ("Cannot find $filename");
  fputs($file, "$count[0]");
  fclose($file);
  echo '<p class="hits"><span>hits: ' . $count[0] . '</span></p>';
?>