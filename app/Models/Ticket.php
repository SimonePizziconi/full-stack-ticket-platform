<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'operator_id',
        'category_id'
    ];

    // Relazioni
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
