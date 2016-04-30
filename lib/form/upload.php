<?php
//How many failes do we have?
$bytes = 0;
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(dirname(__FILE__).'/upload/'));
foreach ($iterator as $i) 
{
  $bytes += $i->getSize();
}
//Сheck that we have a fileand space available.
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0) && $bytes < 100000000) {
  //Check if the file is HTML and it's size is less than 1Mb
  $filename = basename($_FILES['uploaded_file']['name']);
  $ext = substr($filename, strrpos($filename, '.') + 1);
  if (($ext == "html") && ($_FILES["uploaded_file"]["size"] < 1000000)) {
    //Determine the path to which we want to save this file
      $newname = dirname(__FILE__).'/upload/'.date("YmdHis").'_'.$filename;
      //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
           chmod($newname, 0777);
           echo "<html>";
           echo "<head></head>";
           echo "<body>";
           echo "It's done! The file has been saved ".'<a target="_blank" href="http://homepages.dcc.ufmg.br/~manassesferreira/clv/upload/'.date("YmdHis").'_'.$filename.'">here</a>!';
           echo "</body>";
           echo "</html>";
        } else {
           echo "Error: A problem occurred during file upload!";
        }
      } else {
         echo "Error: File ".$_FILES["uploaded_file"]["name"]." already exists";
      }
  } else {
     echo "Error: Only .html files under 1Mb are accepted for upload";
  }
} else {
 echo "Error: No file uploaded. Space used: $bytes";
}
?>
