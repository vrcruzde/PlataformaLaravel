
<x-instructor-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nuevo Curso
        </h2>

        <x-validation-errors class="mb-4"/>


    </x-slot>

    <x-container class="mt-12" width="4xl">
    

        <div class=" bg-white rounded-lg shadow-lg p-6">

            <form action="{{route('instructor.courses.store')}}" method="POST">

                @csrf

                <h2 class="text-2xl uppercase text-center mb-4">
                    Completa está información para crear un curso
                </h2>

                <div mb-4>
                    <x-label mb-2>
                        Nombre del curso
                    </x-label>
                    <x-input placeholder='Nombre del curso' 
                        class="w-full"
                        name="title"
                        value="{{old('title')}}"
                        oninput="string_to_slug(this.value,'#slug')"
                    /> 
                </div>

                <div mb-4>
                    <x-label class="mb-1">
                        Slug del curso
                    </x-label>
                    <x-input 
                        id="slug"
                        placeholder='Slug del curso' 
                        class="w-full"
                        name="slug"
                        value="{{old('slug')}}"
                    />
                </div>

                <div class="grid grid-cols-3 gap-4">
                    
                    <div>
                        <x-label class="mb-1">
                            Categorías
                        </x-label>
                        <x-select class="w-full" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->name}}</option>   
                                    @selected(old('category_id') == $category->id)                             
                            @endforeach
                        </x-select>
                    </div>

                    <div>
                        <x-label class="mb-1">
                            Niveles
                        </x-label>
                        <x-select class="w-full" name="level_id" >
                            @foreach ($levels as $level)
                                <option value="{{$level->id}}">
                                    {{$level->name}}</option>   
                                    @selected(old('level_id') == $level->id)                             
                            @endforeach
                        </x-select>
                    </div>

                    <div>
                        <x-label class="mb-1">
                            Precio
                        </x-label>
                        <x-select class="w-full" name="price_id" >
                            @foreach ($prices as $price)
                                <option value="{{$price->id}}">
                                    @selected(old('price_id') == $price->id)    
                                    @if ($price->value == 0)
                                        Gratis
                                    @else
                                        {{$price->value}} US$  (nivel {{$loop->index}})
                                    @endif
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <x-button class="mt-4">
                        Crear curso
                    </x-button>
                </div>

            </form>
        </div>


    </x-container>

</x-instructor-layout>    