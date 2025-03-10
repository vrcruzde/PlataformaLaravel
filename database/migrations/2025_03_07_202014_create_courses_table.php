<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            
            $table-> String ('title');
            $table-> String ('slug')->unique();// para las url amigables
            

            $table-> text('summary')->nullable();// se tendra resumen del curso
            $table-> text('description')->nullable();

            $table-> integer('status')->default(1); // estado del curso 1 activo, 0 inactivo

            $table-> String ('image-path')->nullable(); // puede ir imagen o no
            $table-> String ('video-path')->nullable(); 

            $table-> text('Welcome_message')->nullable();
            $table-> text('Goodby_message')->nullable();

            $table-> text('observation')->nullable();

            //llaves foraneas haciendo referencia a ID de otras tablas
            
            $table->foreignId('user_id')->constrained();// es el id del usuario que creo el curso
            $table-> foreignId('level_id')->constrained();// es el id del nivel del curso
            $table-> foreignId('price_id')->constrained();// es el id del precio del curso
            $table->foreignId('category_id')->constrained();// es el id de la categoria del curso


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
