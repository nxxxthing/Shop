<?php

use App\Providers\StorageServiceProvider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("author");
            $table->double("price");
            $table->string("image_name");
            $table->timestamps();
        });
        DB::table('products')->insert(
            array(
                'name' => 'Harry Potter',
                'author' => 'J.K. Rowling',
                'price' => '59.99',
                'image_name' => 'no_photo.jpg',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('products')) {
            $names = DB::table('products')->where('image_name', '<>', 'no_photo.jpg' )->get();
            foreach ($names as $name) {
                Storage::delete(StorageServiceProvider::IMG_PATH . $name->image_name);
            }
        }
        Schema::dropIfExists('products');
    }
};
