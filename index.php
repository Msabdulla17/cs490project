<!DOCTYPE html>
<?php
	$Title = 'Index';

	require_once 'includes/header.php';
	require_once 'db/connect.php';

	$results = $crud->getSpecialties();
?>
<h1 class+"text-center">
