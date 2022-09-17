<?php

use App\Http\Common\db\DBTables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTables::PRODUCTS, function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->constrained();

            $table->string('name');
            $table->text('details');
            $table->float('price');

            DBTables::timestamps($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTables::PRODUCTS);
    }
}
