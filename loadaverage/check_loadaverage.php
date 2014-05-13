#!/usr/bin/php
<?php
require_once(realpath(dirname( __FILE__)) ."/LoadAverageChecker.php");

$check = new LoadAverageChecker();
$check->process();

?>
