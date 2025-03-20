<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Level;
use App\Models\Price;
use Illuminate\Support\Facades\Storage;
use App\Models\Requirement;



class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //obtener los cursos del instructor autenticado
        $courses = Course::where('user_id', auth()->user()->id)->get();
        //retornar la vista con los cursos
        return view('instructor.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //importar las categorias de los cursos
        $categories = Category::all();
        $levels = Level::all();
        $prices = price::all();

        return view('instructor.courses.create', compact('categories', 'levels', 'prices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // return $request->all();
        
        //validar los datos y guardarlos en data

        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:courses',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
        ]);

        $data ['user_id'] = auth()->user()->id; // se almacena el id del usuario autenticado

        $course = Course::create($data); // se alamcena curso en variable course    
        //redireccionar a la pagina de edicion del curso
        return redirect()->route('instructor.courses.edit', $course);

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //importar los cursos seleccionados
        $categories = Category::all();
        $levels = Level::all();
        $prices = Price::all();

        
        return view('instructor.courses.edit', compact('course', 'categories', 'levels', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //validar los datos y guardarlos en data
        

         $data = $request->validate([
            'title'=> 'required|max:255',
            'slug'=> "required|max:255|unique:courses,slug,".$course->id,
            'summary'=> 'nullable|max:1000',
            'description'=> 'nullable',
            'category_id'=> 'required|exists:categories,id',
            'level_id'=> 'required|exists:levels,id',
            'price_id'=> 'required|exists:prices,id',
        ]);

        //se pregunta existencia de imagen
        if($request->hasFile('image')){
            //se elimina la imagen anterior
            if($course->image_path){
                Storage::delete($course->image_path);
            }
            //se almacena la nueva imagen
            
            $data['image_path'] = Storage::put('courses/image', $request->file('image'));          
        }

        $course->update($data); // se alamcena curso en variable course

        //session()->flash('flash.bannerStyle', 'danger');//estilo de la alerta rojo
        session()->flash('flash.banner', 'Curso actualizado con éxito');

        //redireccionar a la pagina de edicion del curso
        return redirect()->route('instructor.courses.edit', $course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function video(Course $course){
        return view('instructor.courses.video', compact('course'));
    }

    public function goals(Course $course){
        return view('instructor.courses.goals', compact('course'));
    }

    public function requirements(Course $course){
        return view('instructor.courses.requirements', compact('course'));
    }

    public function curriculum(Course $course){
        return view('instructor.courses.curriculum', compact('course'));
    }
}
