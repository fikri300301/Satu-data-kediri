<?php

namespace App\Models;

use App\Models\User;
use App\Models\dinas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class dataset extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'datasets';
    public function dinass(): BelongsTo
    {
        return $this->belongsTo(dinas::class, 'dinass_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
