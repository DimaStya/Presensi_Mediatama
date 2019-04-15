<?php
$filter = "01-12-2018";
$folder = '../images/';
$proses = new RecursiveDirectoryIterator("$folder");
foreach(new RecursiveIteratorIterator($proses) as $file)
{
  if (!((strpos(strtolower($file), $filter)) === false) || empty($filter))
  {
    unlink($file);
  }
}

?>