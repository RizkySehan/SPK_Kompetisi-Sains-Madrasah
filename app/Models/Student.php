<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'nisn',
        'tgl_lahir',
        'tlp',
        'jk',
        'address',
        'class',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function selectionResults()
    {
        return $this->hasMany(SelectionResult::class);
    }
}
