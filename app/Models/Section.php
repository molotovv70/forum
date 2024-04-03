<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function branches()
    {
        return $this->hasMany(Branch::class, 'section_id', 'id');
    }
}
