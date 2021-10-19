<?php

if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
    $uploaded_file_name = $_FILES['upfile']['name'];
    $temp_path = $_FILES['upfile']['tmp_name'];
    $directory_path = 'upload/';
    $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
    $filename_to_save = $directory_path . $unique_name;
    var_dump($filename_to_save);
    exit();
}
