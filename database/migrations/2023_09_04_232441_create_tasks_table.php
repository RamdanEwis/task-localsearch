<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('due_date')->nullable();
            $table->longText('description')->nullable();
            $table->string('status')->default(\App\Enum\TaskStatus::PROCESSING->value);

            /*relationship With User The User Has MAny TAsks*/
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
