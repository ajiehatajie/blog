<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('content');
            $table->dateTime('published_at');
            $table->string('thumbnails');
            $table->tinyInteger('status')->default(1);
            $table->mediumInteger('views')->default(0);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('taggings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('desc');
            $table->timestamps();
        });

        Schema::create('post_tags', function(Blueprint $table) {
           $table->increments('id');
           $table->integer('post_id')->unsigned();
           $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
           $table->integer('tagging_id')->unsigned();
           $table->foreign('tagging_id')->references('id')->on('taggings')->onDelete('cascade');
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
        Schema::drop('posts');
        Schema::drop('taggings');
        Schema::drop('post_tags');

    }
}
