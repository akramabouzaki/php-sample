<?php

class Movie
{
    private $title;
    private $classification;

    public function __construct(string $title, Classification $classification)
    {
        $this->title = $title;
        $this->classification = $classification;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getClassification(): Classification
    {
        return $this->classification;
    }

    public function setClassification(Classification $classification)
    {
        $this->classification = $classification;
    }
}
