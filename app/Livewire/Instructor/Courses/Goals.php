<?php

namespace App\Livewire\Instructor\Courses;
use Illuminate\attibutes\validate;
use App\Models\Goal;
use App\Models\Course;
use Illuminate\attibutes\dispatch;



use Livewire\Component;

class Goals extends Component
{
    public $course;

    public $goals;

    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount($course)
    {

        $this->goals = Goal::where('course_id',$course->id)->get()->toArray();
    }

       
    public function store()
    {
        $this->validate();

        $this->course->goals()->create([
            'name' => $this->name
        ]);
        
       // $this->goals = Goal::where('course_id', $course->id)->get()->toArray();
       $this->goals = Goal::where('course_id', $this->course->id)->get()->toArray();

        $this->reset('name');

    }

    public function destroy($goalId){
        
        // Eliminar la meta
        Goal::find($goalId)->delete();    
         
        // Actualizar la lista de metas después de eliminar
        $this->goals = Goal::where('course_id', $this->course->id)->get()->toArray();
    }

   
    public function render()
    {
        return view('livewire.instructor.courses.goals');
    }

    public function update()
    {
        $this->validate([
            'goals.*.name' => 'required|string|max:255',
        ]);

        foreach ($this->goals as $goal) {
            Goal::find($goal['id'])->update([
                'name' => $goal['name']
            ]);
        }

        $this->dispatch('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Los objetivos se han actualizado correctamente'
        ]);

    }    
    
}
