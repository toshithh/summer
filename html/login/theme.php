<?php
include 'login_check1318.php';
$dir = "/var/www/html/widescreen/style/Wallpapers/desktop";

$images = scandir($dir);
echo "<center><h1>Choose a wallpaper</h1></center>";
foreach($images as $file) {
    if($file !== "." && $file !== "..") {
        echo "<img src='/widescreen/style/Wallpapers/desktop/$file' name='$file' style='max-width:400px;height:auto;padding:50px;'/>";
    }
}


print_r($a);

?>
