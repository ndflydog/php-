<?php

//var_dump($_FILES);

move_uploaded_file($_FILES['file']['tmp_name'], '/home/php-/'.$_FILES['file']['name']);

#var_dump($_FILES);
//header("Content-type: image/jpg");
echo file_get_contents('./749.jpg');die;
?>
<img src="<?php echo './'.$_FILES['file']['name']; ?>">
