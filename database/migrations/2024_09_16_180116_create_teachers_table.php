<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\TeacherStatus;
use App\Gender;
use App\Religion;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('tphoto');
            $table->string('designation');
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
        Schema::dropIfExists('teachers');
    }
};
