<?php
    $images_arr = array();
    foreach($_FILES['images']['name'] as $key=>$val){
        //upload and stored images
        $target_dir = "uploads/";
        $target_file = $target_dir.$_FILES['images']['name'][$key];
        if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$target_file)){
            $images_arr[] = $target_file;
        }
    }
?>