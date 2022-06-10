<?php

namespace App\DataTransferObjects;

use App\Models\Finance;
use Spatie\DataTransferObject\DataTransferObject;

/** @typescript */
class FinanceData extends DataTransferObject
{
    public string $description;
    public int $amount;
    public string $type;

    public static function from(Finance $finance): self
    {
        return new static([
            'description' => $finance->description,
            'amount' => $finance->amount,
            'type' => $finance->type,
        ]);
    }
}
