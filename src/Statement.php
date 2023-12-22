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

    public function getRentalPrice(Rental $rental): float
    {
        // determine price for a rental
        $thisAmount = 0.0;
        switch ($rental->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $thisAmount += 2;
                if ($rental->getDaysRented() > 2)
                    $thisAmount += ($rental->getDaysRented() - 2) * 1.5;
                break;
            case Movie::NEW_RELEASE:
                $thisAmount += $rental->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                $thisAmount += 1.5;
                if ($rental->getDaysRented() > 3)
                    $thisAmount += ($rental->getDaysRented() - 3) * 1.5;
                break;
        }

        return $thisAmount;
    }

    public function getFrequentRenterPoints(Rental $rental): int
    {
        // add bonus for a two day new release rental
        if (
            ($rental->getMovie()->getPriceCode() == Movie::NEW_RELEASE) &&
            $rental->getDaysRented() > 1
        ) {
            return 2;
        }
        return 1;
    }

    public function getPlainText(): string
    {
        $result = "Rental Record for " . $this->customer->getName() . "\n";

        // determine amounts for each line
        foreach ($this->customer->getRentals() as $rental) {
            $thisAmount = $this->getRentalPrice($rental);
            $this->frequentRenterPoints += $this->getFrequentRenterPoints($rental);

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
        return "";
    }

}


?>