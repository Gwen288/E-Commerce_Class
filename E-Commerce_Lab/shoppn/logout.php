<?php

require_once 'core/core.php';

session_unset();
session_destroy();


redirect("index.php");


?>