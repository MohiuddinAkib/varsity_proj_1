<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_activities', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("location");
            $table->enum("type", ["education"]);
            $table->timestamp("activity_date");
            $table->json("volunteers")->default(new Expression("(JSON_ARRAY())"));
            $table->foreignId("organization_id")->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_activities');
    }
}
