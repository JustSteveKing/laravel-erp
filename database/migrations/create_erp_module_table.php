<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // vendor/package
            $table->string('pretty_name')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('version')->nullable();
            $table->string('author_name')->nullable();
            $table->string('author_url')->nullable();
            $table->string('module_url')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }
};
