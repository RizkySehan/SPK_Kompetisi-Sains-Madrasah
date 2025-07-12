<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectionResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'yi',
        'cluster',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
