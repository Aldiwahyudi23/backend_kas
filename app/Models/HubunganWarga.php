<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganWarga extends Model
{
    use HasFactory;

    public function data_warga()
    {
        return $this->belongsTo(DataWarga::class);
    }
}
