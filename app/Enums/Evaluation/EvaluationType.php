<?php

namespace App\Enums\Evaluation;

enum EvaluationType: string
{
    case ORDINARY = 'ordinary';
    case EXTRAORDINARY = 'extraordinary';

    /**
     * Get all the values of the enum.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
