<?php

use PHPUnit\Framework\TestCase;

$codedir = './src';

require_once("$codedir/Movie.php");
require_once("$codedir/Rental.php");
require_once("$codedir/Customer.php");
require_once("$codedir/Statement.php");


final class StatementTest extends TestCase
{
    private function initialize(): Statement{
        $prognosisNegative = new Movie("Prognosis Negative", Movie::NEW_RELEASE);
        $sackLunch = new Movie("Sack Lunch", Movie::CHILDRENS);
        $painAndYearning = new Movie("The Pain and the Yearning", Movie::REGULAR);
        $prognosisRental = new Rental($prognosisNegative, 3);
        $painRental = new Rental($painAndYearning, 1);
        $sackRental = new Rental($sackLunch, 1);

        $customer = new Customer("Susan Ross");
        $customer->addRental($prognosisRental);
        $customer->addRental($painRental);
        $customer->addRental($sackRental);

        $statement = new Statement($customer);
        return $statement;
    }
    public function testGetRentalPrice()
    {
        $prognosisNegative = new Movie("Prognosis Negative", Movie::NEW_RELEASE);
        $prognosisRental = new Rental($prognosisNegative, 3);
        $customer = new Customer("Susan Ross");
        $customer->addRental($prognosisRental);
        $statement = new Statement($customer);

        $this->assertSame(9.0, $statement->getRentalPrice($prognosisRental));
    }

    public function testGetFrequentRenterPoints()
    {
        $prognosisNegative = new Movie("Prognosis Negative", Movie::NEW_RELEASE);
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
