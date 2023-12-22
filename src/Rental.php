<?php

class Rental
{
    private $movie;
    private $daysRented;

    public function __construct(Movie $movie, int $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function getDaysRented(): int
    {
        return $this->daysRented;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }
    public function getRentalPrice(): float
    {
         // determine price for a rental
         $classification = $this->getMovie()->getClassification();
         $freeDays = $classification->getFreeOfChargeDays();
         $thisAmount = $classification->getBaseCost();
         if($this->getDaysRented() > $freeDays)
         {
             $thisAmount += ($this->getDaysRented() - $freeDays) * $classification->getRentalMultiplier();
         }
        
        return $thisAmount;  
    }

    public function getFrequentRenterPoints(): int
    {
        // add bonus for a two day new release rental
        if (($this->getMovie()->getClassification()->getFrequentRenterPointsBonus()) &&
            $this->getDaysRented() > 1) 
        {
            return 2;
        }
        
        return 1;
    }
}