<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Gender;
use App\TeacherStatus;
use App\Religion;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('sphoto');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('hall');
            $table->string('session');
            $table->string('department');
            $table->string('sid');
            $table->string('location');
            $table->string('status')->default(TeacherStatus::Active->value);
            $table->string('gender')->default(Gender::Male->value);
            $table->string('religion')->default(Religion::Islam->value);
            $table->string('mobile_number');
            $table->unsignedBiginteger('user_id');
            $table->timestamps();


            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
