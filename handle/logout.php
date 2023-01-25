<?php
//destroy all sessions and return to homepage
Session_start();
Session_destroy();
header("location: /")
?>
