<?php
session_start();
echo "Loggin You out. Please wait...";

session_destroy();
header("location:/forum");

?>