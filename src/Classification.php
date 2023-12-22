<?php

enum ClassificationType 
{
    case CHILDRENS;
    case REGULAR;
    case NEW_RELEASE;
}

class Classification 
{
    private $type;
    private $baseCost;
    private $freeOfChargeDays;
    private $rentalMultiplier;
    private $frequentRenterPointsBonus;

    public function __construct(ClassificationType $type, float $baseCost, int $freeOfChargeDays, float $rentalMultiplier, bool $frequentRenterPointsBonus)
    {
        $this->type = $type;
        $this->baseCost = $baseCost;
        $this->freeOfChargeDays = $freeOfChargeDays;
        $this->rentalMultiplier = $rentalMultiplier;
        $this->frequentRenterPointsBonus = $frequentRenterPointsBonus;
    }

    public function getType():ClassificationType
    {
        return $this->type;
    }

    public function setType(ClassificationType $type)
    {
        $this->type = $type;
    }

    public function getBaseCost():float
    {
        return $this->baseCost;
    }

    public function setBaseCost(float $baseCost)
    {
        $this->baseCost = $baseCost;
    }
    
    public function getFreeOfChargeDays():int
    {
        return $this->freeOfChargeDays;
    }

    public function setFreeOfChargeDays(int $freeOfChargeDays)
    {
        $this->freeOfChargeDays = $freeOfChargeDays;
    }

    public function getRentalMultiplier():float
    {
        return $this->rentalMultiplier;
    }

    public function setRentalMultiplier(float $rentalMultiplier)
    {
        $this->rentalMultiplier = $rentalMultiplier;
    }

    public function getFrequentRenterPointsBonus():bool
    {
        return $this->frequentRenterPointsBonus;
    }

    public function setFrequentRenterPointsBonus(bool $frequentRenterPointsBonus)
    {
        $this->frequentRenterPointsBonus = $frequentRenterPointsBonus;
    }

}