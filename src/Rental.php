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
         return 0.0;
    }

    public function getFrequentRenterPoints(): int
    {
        return 0;
    }
}