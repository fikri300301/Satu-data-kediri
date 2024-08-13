<?php

namespace App\Models;

use App\Models\dataset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class dinas extends Model
{
    use HasFactory;

    protected $table = 'dinass';
    protected $guarded = ['id'];

    public function datasets()
    {
        return $this->hasMany(dataset::class, 'dinass_id');
    }
}
