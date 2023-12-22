<?php

use PHPUnit\Framework\TestCase;

$codedir = './src';

require_once("$codedir/Movie.php");
require_once("$codedir/Rental.php");
require_once("$codedir/Customer.php");
require_once("$codedir/Statement.php");
require_once("$codedir/Classification.php");

final class StatementTest extends TestCase
{
    private function initialize(): Statement{
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
        return $statement;
    }

    public function testGetRentalPrice()
    {
        $newRelease = new Classification(ClassificationType::NEW_RELEASE, 0.0, 0, 3, true);
        $prognosisNegative = new Movie("Prognosis Negative", $newRelease);
        $prognosisRental = new Rental($prognosisNegative, 3);
        $customer = new Customer("Susan Ross");
        $customer->addRental($prognosisRental);
        $statement = new Statement($customer);

        $this->assertSame(9.0, $statement->getRentalPrice($prognosisRental));
    }

    public function testGetFrequentRenterPoints()
    {
        $newRelease = new Classification(ClassificationType::NEW_RELEASE, 0.0, 0, 3, true);
        $prognosisNegative = new Movie("Prognosis Negative", $newRelease);
        $prognosisRental = new Rental($prognosisNegative, 3);
        $customer = new Customer("Susan Ross");
        $customer->addRental($prognosisRental);
        $statement = new Statement($customer);

        $this->assertSame(2, $statement->getFrequentRenterPoints($prognosisRental));
    }

    public function testGetPlainText()
    {
        $statement = $this->initialize();;
        $plainTextStatement = $statement->getPlainText();
        $expectedPlainString = "Rental Record for Susan Ross\n\tPrognosis Negative\t9\n\tThe Pain and the Yearning\t2\n\tSack Lunch\t1.5\nAmount owed is 12.5\nYou earned 4 frequent renter points";

        $this->assertSame($expectedPlainString, $plainTextStatement);
    }

    public function testGetHTML()
    {
        $statement = $this->initialize();
        $HTMLTextStatement = $statement->getHTML();
        $expectedHTMLString = "<h1>Rentals for <em>Susan Ross</em></h1><p>Prognosis Negative: 9</p><p>The Pain and the Yearning: 2</p><p>Sack Lunch: 1.5</p><p>Amount owed is <em>12.5</em></p><p>You earned <em>4</em> frequent renter points</p>";

        $this->assertSame($expectedHTMLString, $HTMLTextStatement);
    }
}
