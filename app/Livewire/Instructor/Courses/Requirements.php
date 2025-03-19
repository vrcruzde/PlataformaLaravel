<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;
use Illuminate\attibutes\validate;
use App\Models\Requirement;
use App\Models\Course;
use Illuminate\attibutes\dispatch;

class Requirements extends Component
{

    // recibimos la informacion del curso
    public $course;

    public $requirements;// para almacenar los requisitos del curso

    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount($course)
    {

        $this->requirements = Requirement::where('course_id',$course->id)->get()->toArray();
    }

    public function store()
    {
        $this->validate();

        $this->course->requirements()->create([
            'name' => $this->name
        ]);
        
       
       $this->requirements = Requirement::where('course_id', $this->course->id)->get()->toArray();

        $this->reset('name');

    }

    public function update()
    {
        $this->validate([
            'requirements.*.name' => 'required|string|max:255',
        ]);

        foreach ($this->requirements as $requirement) {
            Requirement::find($requirement ['id'])->update([
                'name' => $requirement ['name']
            ]);
        }

        $this->dispatch('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Los requisitos se han actualizado correctamente'
        ]);

    }    

    public function destroy($requirementId){
        
        // Eliminar el requisito
        Requirement::find($requirementId)->delete();    
         
        // Actualizar la lista de requisitos después de eliminar
        $this->requirement = Requirement::where('course_id', $this->course->id)->get()->toArray();
    }


    public function render()
    {
        return view('livewire.instructor.courses.requirements');
    }
}
