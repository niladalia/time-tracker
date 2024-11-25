<?php

namespace App\Shared\Domain\Utils;

use DateTime;

class SecondsCalculator
{
    public function __construct() {}

    public static function calculate(DateTime $dateOne, DateTime $dateTwo): int
    {
        return $dateOne->getTimestamp() - $dateTwo->getTimestamp();
    }
}
