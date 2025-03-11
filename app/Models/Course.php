<?php

namespace App\Models;

use App\Enums\CourseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;


class Course extends Model
{
    use HasFactory;
    
    //habilitamos asignacion masiva de propiedades
    protected $fillable =[
        'title',
        'slug',
        'summary',
        'description',
        'status',
        'image_path',
        'video_path',
        'Welcome_message',
        'Goodby_message',
        'observation',
        'user_id',
        'level_id',
        'price_id',
        'category_id',
    ];

    protected $casts = [
        'status' => CourseStatus::class

    ];

    protected function image(): Attribute
    {
        return new Attribute (
            get: function()
            {
                return $this->image_path ? Storage::url($this->image_path) : 'https://w7.pngwing.com/pngs/819/548/png-transparent-photo-image-landscape-icon-images-thumbnail.png';
            }
        );       
    }
   

    //para saber quien realizo el curso y los que se matricularon
    // Relaciones 
    public function teacher(){
        return $this->belongsTo(User::class);
    }

    //para saber el nivel del curso
    public function level(){
        return $this->belongsTo(Level::class);
    }

    //para saber el precio del curso
    public function price(){
        return $this->belongsTo(Price::class);
    }

    //para saber la categoria del curso
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
