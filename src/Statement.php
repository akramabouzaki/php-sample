<?php

class Statement
{
    private $totalAmount = 0;
    private $frequentRenterPoints = 0;
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getPlainText(): string
    {
        //reset frequent renter points & total amount before we update them for the current statement
        $this->frequentRenterPoints = 0;
        $this->totalAmount = 0;
        
        $result = "Rental Record for " . $this->customer->getName() . "\n";

        // determine amounts for each line
        foreach ($this->customer->getRentals() as $rental) {
            $thisAmount = $rental->getRentalPrice();
            $this->frequentRenterPoints += $rental->getFrequentRenterPoints();

            // show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" .
                $thisAmount . "\n";
            $this->totalAmount += $thisAmount;
        }

        // add footer lines
        $result .= "Amount owed is " . $this->totalAmount . "\n";
        $result .= "You earned " . $this->frequentRenterPoints .
            " frequent renter points";

        return $result;
    }

    public function getHTML(): string
    {
        //reset frequent renter points & total amount before we update them for the current statement
        $this->frequentRenterPoints = 0;
        $this->totalAmount = 0;

        $result = "<h1>Rentals for <em>" . $this->customer->getName() . "</em></h1>";

        // determine amounts for each line
        foreach ($this->customer->getRentals() as $rental) {
            $thisAmount = $rental->getRentalPrice($rental);
            $this->frequentRenterPoints += $rental->getFrequentRenterPoints($rental);

            // show figures for this rental
            $result .= "<p>" . $rental->getMovie()->getTitle() . ": " .
                $thisAmount . "</p>";
            $this->totalAmount += $thisAmount;
        }

        // add footer lines
        $result .= "<p>Amount owed is <em>" . $this->totalAmount . "</em></p>";
        $result .= "<p>You earned <em>" . $this->frequentRenterPoints .
            "</em> frequent renter points</p>";

        return $result;
    }

}