<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('transactions')]
class Transaction
{
    public const FUEL_TYPE_DIESEL_KEY = "diesel";
    public const FUEL_TYPE_GASOLINE_95_KEY = "gasoline95";
    public const FUEL_TYPE_GASOLINE_98_KEY = "gasoline98";
    public const FUEL_TYPE_ELECTRICITY_KEY = "electricity";
    public const FUEL_TYPE_CNG_KEY = "cng";

    public const FUEL_TYPE_DIESEL_VALUE = "Diesel";
    public const FUEL_TYPE_GASOLINE_95_VALUE = "E95";
    public const FUEL_TYPE_GASOLINE_98_VALUE = "E98";
    public const FUEL_TYPE_ELECTRICITY_VALUE = "Electricity";
    public const FUEL_TYPE_CNG_VALUE = "CNG";


    public const ALLOWED_FUEL_TYPES_VALUES = [
        self::FUEL_TYPE_DIESEL_VALUE,
        self::FUEL_TYPE_GASOLINE_95_VALUE,
        self::FUEL_TYPE_GASOLINE_98_VALUE,
        self::FUEL_TYPE_ELECTRICITY_VALUE,
        self::FUEL_TYPE_CNG_VALUE
    ];

    #[Id]
    #[Column, GeneratedValue]
    private int $id;
    #[Column]
    private DateTime $date;
    #[Column]
    private string $cardNumber;
    #[Column]
    private string $vehicleNumber;
    #[Column]
    private string $product;
    #[Column]
    private float $amount;
    #[Column]
    private float $totalSum;
    #[Column]
    private string $currency;
    #[Column]
    private string $country;
    #[Column]
    private string $countryIso;
    #[Column]
    private string $fuelStation;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return string
     */
    public function getVehicleNumber(): string
    {
        return $this->vehicleNumber;
    }

    /**
     * @param string $vehicleNumber
     */
    public function setVehicleNumber(string $vehicleNumber): void
    {
        $this->vehicleNumber = $vehicleNumber;
    }

    /**
     * @return string
     */
    public function getProduct(): string
    {
        return $this->product;
    }

    /**
     * @param string $product
     */
    public function setProduct(string $product): void
    {
        $this->product = $product;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getTotalSum(): float
    {
        return $this->totalSum;
    }

    /**
     * @param float $totalSum
     */
    public function setTotalSum(float $totalSum): void
    {
        $this->totalSum = $totalSum;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountryIso(): string
    {
        return $this->countryIso;
    }

    /**
     * @param string $countryIso
     */
    public function setCountryIso(string $countryIso): void
    {
        $this->countryIso = $countryIso;
    }

    /**
     * @return string
     */
    public function getFuelStation(): string
    {
        return $this->fuelStation;
    }

    /**
     * @param string $fuelStation
     */
    public function setFuelStation(string $fuelStation): void
    {
        $this->fuelStation = $fuelStation;
    }
}