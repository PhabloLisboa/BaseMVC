<?php
	$files = glob($_SERVER['DOCUMENT_ROOT']."/Downrling/*.zip"); // obtém as imagens 
	foreach($files as $file){ // percorre os arquivos encontrados
	  if(is_file($file))
	    unlink($file); // remove o arquivo/
	}

	function rrmdir($dir) { 
   	if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir."/".$object))
          rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object); 
       } 
     }
    	rmdir($dir);
 		}
	}

  rrmdir($_SERVER['DOCUMENT_ROOT']."/Downrling/Mangás");
 ?>
