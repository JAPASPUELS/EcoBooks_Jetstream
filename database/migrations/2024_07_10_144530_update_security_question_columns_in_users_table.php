<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateSecurityQuestionColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Verificar y eliminar las columnas existentes
            if (Schema::hasColumn('users', 'security_question')) {
                $table->dropColumn('security_question');
            }
            if (Schema::hasColumn('users', 'security_answer')) {
                $table->dropColumn('security_answer');
            }
            if (Schema::hasColumn('users', 'security_question_enabled')) {
                $table->dropColumn('security_question_enabled');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            // Volver a crear las columnas
            $table->string('security_question')->nullable();
            $table->string('security_answer')->nullable();
            $table->boolean('security_question_enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar las columnas nuevamente
            if (Schema::hasColumn('users', 'security_question')) {
                $table->dropColumn('security_question');
            }
            if (Schema::hasColumn('users', 'security_answer')) {
                $table->dropColumn('security_answer');
            }
            if (Schema::hasColumn('users', 'security_question_enabled')) {
                $table->dropColumn('security_question_enabled');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            // Volver a crear las columnas en reversa
            $table->string('security_question')->nullable();
            $table->string('security_answer')->nullable();
            $table->boolean('security_question_enabled')->default(false);
        });
    }
}
