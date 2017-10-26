<?php
$upload_dir = "upload/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . mktime() . ".png";
$success = file_put_contents($file, $data);
shell_exec("python /home/pi/reply/tienlui.py 2>&1");

print $success ? $file : 'Unable to save the file.';

?>
