<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'selection',
    ];

    protected function casts(): array
    {
        return [
            'selection' => 'array',
        ];
    }

    /**
     * Get the user who owns the prompt.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
