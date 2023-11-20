<?php

namespace App\Enums;

enum StatusKegiatanEnum : string {
    case BARU = 'baru';
    case SEDANG = 'Sedang Dikerjakan';
    case MENUNGGU = 'Menunggu';
    case SELESAI = 'Selesai';
    case DIBATALKAN = 'Dibatalkan';
}
