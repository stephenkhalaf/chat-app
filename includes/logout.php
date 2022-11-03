<?php
session_destroy();
$info->logged_in = false;
echo json_encode($info);
