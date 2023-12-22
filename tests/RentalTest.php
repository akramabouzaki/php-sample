<?php

use PHPUnit\Framework\TestCase;

$codedir = './src';

require_once("$codedir/Movie.php");
require_once("$codedir/Rental.php");
require_once("$codedir/Classification.php");

final class RentalTest extends TestCase
{
    public function testGetRentalPrice()
    {
        $newRelease = new Classification(ClassificationType::NEW_RELEASE, 0.0, 0, 3, true);
        $prognosisNegative = new Movie("Prognosis Negative", $newRelease);
        $prognosisRental = new Rental($prognosisNegative, 3);

        $this->assertSame(9.0, $prognosisRental->getRentalPrice());
    }

    public function testGetFrequentRenterPoints()
    {
        $newRelease = new Classification(ClassificationType::NEW_RELEASE, 0.0, 0, 3, true);
        $prognosisNegative = new Movie("Prognosis Negative", $newRelease);
        $prognosisRental = new Rental($prognosisNegative, 3);

        $this->assertSame(2, $prognosisRental->getFrequentRenterPoints());
    }
}