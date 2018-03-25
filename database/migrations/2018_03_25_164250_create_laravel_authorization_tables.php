<?php

use Enea\Authorization\Support\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelAuthorizationTables extends Migration
{
    public function up(): void
    {
        Schema::create(Config::roleTableName(), $this->getGrantableStructure());
        Schema::create(Config::permissionTableName(), $this->getGrantableStructure());
        Schema::create(Config::userRoleTableName(), $this->getAuthorizationsStructure(Config::roleTableName()));
        Schema::create(Config::userPermissionTableName(), $this->getAuthorizationsStructure(Config::permissionTableName()));

        Schema::create(Config::rolePermissionTableName(), function (Blueprint $table): void {
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on(Config::roleTableName());

            $table->unsignedInteger('permission_id');
            $table->foreign('permission_id')->references('id')->on(Config::permissionTableName());

            $table->primary(['role_id', 'permission_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Config::rolePermissionTableName());
        Schema::dropIfExists(Config::userPermissionTableName());
        Schema::dropIfExists(Config::userRoleTableName());
        Schema::dropIfExists(Config::permissionTableName());
        Schema::dropIfExists(Config::roleTableName());
    }

    private function getGrantableStructure(): Closure
    {
        return function (Blueprint $table): void {
            $table->increments('id');
            $table->string('secret_name', 60)->unique();
            $table->string('display_name', 60);
            $table->string('description')->nullable();
            $table->timestamps();
        };
    }

    private function getAuthorizationsStructure($tableName): Closure
    {
        return function (Blueprint $table) use ($tableName): void {
            $table->increments('id');

            $table->unsignedInteger('authorizable_id');
            $table->string('authorizable_type', 100);
            $table->index(['authorizable_id', 'authorizable_type']);

            $name = str_singular($tableName);
            $table->unsignedInteger("{$name}_id");
            $table->foreign("{$name}_id")->references('id')->on($tableName);

            $table->timestamps();
        };
    }
}
