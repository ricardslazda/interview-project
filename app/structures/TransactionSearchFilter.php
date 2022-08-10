<?php

declare(strict_types=1);

namespace App\Structures;

class TransactionSearchFilter
{
    public ?string $from;
    public ?string $to;
    public ?string $fuelCard;
    public ?string $vehicleNumber;
    public ?string $productType;
}