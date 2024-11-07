<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusJemaahPaket: string implements HasLabel, HasColor
{
    case BelumLunas = '0';
    case Lunas      = '1';

    public function getLabel(): string
    {
        return match ($this) {
            self::BelumLunas => 'Belum Lunas',
            self::Lunas      => 'Lunas',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::BelumLunas => 'danger',
            self::Lunas      => 'success',
        };
    }
}
