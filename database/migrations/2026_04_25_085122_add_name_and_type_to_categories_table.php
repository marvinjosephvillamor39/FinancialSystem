<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('categories', 'name') || ! Schema::hasColumn('categories', 'type')) {
            Schema::table('categories', function (Blueprint $table) {
                if (! Schema::hasColumn('categories', 'name')) {
                    $table->string('name');
                }

                if (! Schema::hasColumn('categories', 'type')) {
                    $table->enum('type', ['income', 'expense']);
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $columns = array_values(array_filter([
                Schema::hasColumn('categories', 'name') ? 'name' : null,
                Schema::hasColumn('categories', 'type') ? 'type' : null,
            ]));

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
