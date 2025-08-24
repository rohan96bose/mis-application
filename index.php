<?php
function redirect($url) {
    header("Location: $url");
    exit();
}
redirect('public/login.php');