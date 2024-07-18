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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->string("avatar")->nullable();
            $table->string("full_name")->nullable();
            $table->integer("year")->min(1111)->max(9999);
            $table->integer("month")->min(1)->max(12);
            $table->integer("day")->min(0)->max(30);
            $table->enum("gender" , ["male" , "female","other"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
