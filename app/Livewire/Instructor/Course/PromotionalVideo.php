<?php

namespace App\Livewire\Instructor\Course;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PromotionalVideo extends Component
{
    use WithFileUploads;

    public $course; // Variable to store the course  
    public $video;  // Variable to store the video

    // Definir reglas de validación correctamente
    protected $rules = [
        'video' => 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
    ];

    public function save()
    {
        // Validar antes de guardar
        $this->validate();

        // Guardar el video en la carpeta deseada
        $this->course->video_path = $this->video->store('courses/promotional-videos', 'public');
        $this->course->save();

        // return redirect()->route('instructor.courses.video', $this->course);

        return redirect()->route('instructor.courses.video', $this->course, true, true);
    }

    public function render()
    {
        return view('livewire.instructor.course.promotional-video');
    }
}