<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentNumber',
        'name',
        'email',
        'contactNumber',
        'year',
        'section_id',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
