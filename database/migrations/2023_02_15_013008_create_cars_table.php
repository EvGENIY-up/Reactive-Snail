<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('type', 50);
            $table->text('img')->nullable();
            $table->foreignId('status_id')->nullable()->constrained('statuses')
                ->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('person_id')->nullable()->constrained('people')
                ->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
