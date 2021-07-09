<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->text('category_name', 120);
            $table->text('category_desc', 255);
            $table->timestamps();
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->text('author_name');
            $table->text('author_bio', 255);
            $table->timestamps();
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('author_id')->constrained('authors');
            $table->text('book_title');
            $table->text('book_summary');
            $table->decimal('book_price', 5, 2);
            $table->text('book_cover_photo', 20);
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->text('review_title', 120);
            $table->text('review_details');
            $table->dateTime('review_date', 0);	
            $table->enum('rating_start', ['1', '2', '3', '4', '5']);
            $table->timestamps();
        });

        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->date('discount_start_date');
            $table->date('discount_end_date');
            $table->decimal('discount_price', 5, 2);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('order_date', 0);
            $table->decimal('order_amount', 8, 2);
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('book_id')->constrained('books');
            $table->unsignedTinyInteger('quantity');
            $table->decimal('price', 5, 2);
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
        
        Schema::dropIfExists('order_items');
        
        Schema::dropIfExists('orders');
        
        Schema::dropIfExists('discounts');
        
        Schema::dropIfExists('reviews');
        
        Schema::dropIfExists('books');
        
        Schema::dropIfExists('authors');
        
        Schema::dropIfExists('categories');
    }
}
