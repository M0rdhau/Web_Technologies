<?php
require_once("functions.php");
if (file_exists(ARRIVAL_FILE)) {
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="data.psv"');
  header('Expires: 0');
  header('Cache-Control: no-cache, must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize(ARRIVAL_FILE));
  flush();
  readfile(ARRIVAL_FILE);
  exit;
}
