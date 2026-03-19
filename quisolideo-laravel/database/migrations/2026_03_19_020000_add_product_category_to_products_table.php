<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'product_category_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreignId('product_category_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('product_categories')
                    ->nullOnDelete();
            });
        }

        // Ensure a default category exists so existing products remain visible.
        if (Schema::hasTable('product_categories') && Schema::hasTable('products')) {
            $categoryId = DB::table('product_categories')->where('slug', 'catalogue')->value('id');

            if (!$categoryId) {
                $now = now();
                $categoryId = DB::table('product_categories')->insertGetId([
                    'name' => 'Catalogue',
                    'slug' => 'catalogue',
                    'description' => 'Tous nos produits.',
                    'image' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            DB::table('products')
                ->whereNull('product_category_id')
                ->update(['product_category_id' => $categoryId]);
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'product_category_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropConstrainedForeignId('product_category_id');
            });
        }
    }
};
