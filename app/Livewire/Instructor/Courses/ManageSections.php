<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use App\Models\Section;
use Livewire\Component;
use App\observers\SectionObserver;



class ManageSections extends Component
{

    public $course;
    public $name;

    public $sections;//para mostrar las secciones del curso 

    public $sectionEdit=[
        'name'=> null,
        'id' => null
    ];

    public $sectionPositionCreate = [

    ];

    public function mount(){
        $this->getSections();        
    }

    public function getSections(){

        $this->sections = Section::where('course_id', $this->course->id)
            ->orderBy('position', 'asc')
            ->get();

    }

    public function store(){
        $this->validate([
            'name' => 'required'
        ]);       
        
        // creo nueva seccion
        $this->course->sections()->create([
            'name' => $this->name,            
        ]);

        $this->reset('name');

        $this->getSections();  //Actualizo las secciones
    }

    public function storePosition($sectionId){
       // dd($this->sectionPositionCreate);

       $this->validate([
           "sectionPositionCreate.{$sectionId}.name" => 'required'
       ]);

       $position = Section::find($sectionId)->position;

       Section::where('course_id', $this->course->id)
        ->where('position', '>=', $position)
        ->increment('position');

        $this->course->sections()->create([
            'name' => $this->sectionPositionCreate[$sectionId]['name'],
            'position' => $position
        ]);
        
        $this->getSections();
        return $this->redirectRoute('instructor.courses.curriculum',$this->course,true,true);

        $this->reset("sectionPositionCreate.{$sectionId}");
    }

    public function edit(Section $section){
        $this->sectionEdit = [
            'name' => $section->name,
            'id' => $section->id
        ];
    }

    public function update(){
        $this->validate([
            'sectionEdit.name' => 'required'
        ]);

        Section::find($this->sectionEdit['id'])->update([
            'name' => $this->sectionEdit['name']
        ]);
        
        $this->reset('sectionEdit');

        $this->getSections();    
    }

    public function destroy(Section $section){
        $section->delete();
        $this->getSections();

        $this->dispatch('swal',[
            "title" => "Eliminado",
            "text" => "La sección se ha eliminado correctamente",
            "icon" => "success"
        ]);
    }
        
    public function sortSections($sorts){

            foreach ($sorts as $position => $sectionId) {
            Section::find($sectionId)->update([
                'position' => $position + 1
            ]);
        }

        $this->getSections();
    }
    public function render()
    {
        return view('livewire.instructor.courses.manage-sections');
    }
}
