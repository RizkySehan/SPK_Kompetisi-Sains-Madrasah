<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'criteria_id',
        'value',
    ];

    // Relasi ke siswa
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relasi ke kriteria
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
