<?php

$codedir = '../src';

require_once("$codedir/Movie.php");
require_once("$codedir/Rental.php");
require_once("$codedir/Customer.php");
require_once("$codedir/Statement.php");
require_once("$codedir/Classification.php");


$regular = new Classification(ClassificationType::REGULAR, 2.0, 2, 1.5, false);
$childrens = new Classification(ClassificationType::CHILDRENS, 1.5, 3, 1.5, false);
$newRelease = new Classification(ClassificationType::NEW_RELEASE, 0.0, 0, 3, true);

$prognosisNegative = new Movie("Prognosis Negative", $newRelease);
$sackLunch = new Movie("Sack Lunch", $childrens);
$painAndYearning = new Movie("The Pain and the Yearning", $regular);

$customer = new Customer("Susan Ross");
$customer->addRental(
  new Rental($prognosisNegative, 3)
);
$customer->addRental(
  new Rental($painAndYearning, 1)
);
$customer->addRental(
  new Rental($sackLunch, 1)
);

$statement = new Statement($customer);
$plainTextStatement = $statement->getPlainText();
$HTMLTextStatement = $statement->getHTML();

echo '<pre>';
echo $plainTextStatement;
echo '</pre>';

echo $HTMLTextStatement;