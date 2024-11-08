<?php

namespace App\Enums;

use Filament\Support\Contracts;

enum StatusSetoran: string 
    implements Contracts\HasLabel, Contracts\HasColor, Contracts\HasIcon 
{
    case Pending        = 'Pending';
    case Terverifikasi  = 'Terverifikasi';
    case Ditolak        = 'Ditolak';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending       => 'Pending',
            self::Terverifikasi => 'Terverifikasi',
            self::Ditolak       => 'Ditolak',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Pending       => 'warning',
            self::Terverifikasi => 'success',
            self::Ditolak       => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Pending       => 'heroicon-o-clock',
            self::Terverifikasi => 'heroicon-o-check-circle',
            self::Ditolak       => 'heroicon-o-x-circle',
        };
    }
}
