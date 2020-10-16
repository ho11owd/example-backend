<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('official_id')->unique();
            $table->string('user_id')->constrained('userss', 'id');
            $table->string('details');
            $table->foreignId('contract_type_id')->constrained('contract_types', 'id');
            $table->timestamps();
        });

        Schema::create('contract_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps('2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_types');
        Schema::dropIfExists('contracts');
    }
}
