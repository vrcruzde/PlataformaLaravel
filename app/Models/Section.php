<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\SectionObserver;

#[observerBy([SectionObserver::class])]
class Section extends Model
{
    //
    use hasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'position',
    ];

    //relación de uno a muchos inversa
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
