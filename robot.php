<?php
	require_once __DIR__ . '/vendor/autoload.php';
	use Symfony\Component\Console\Application;
	use App\Apartment\Apartment;

	// Creating object of Apartment class
	$apartmentObj = new Apartment();

	// Creating object of Application class
	$appObj = new Application();
	$appObj->add($apartmentObj);
	$appObj->run();
?>