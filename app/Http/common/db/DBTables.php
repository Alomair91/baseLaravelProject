<?php


namespace App\Http\common\db;


use Illuminate\Support\Facades\DB;

class DBTables
{

    const PERSONAL_ACCESS_TOKENS = "personal_access_tokens";
    const FAILED_JOBS = "failed_jobs";

    // user
    const USERS = "users";

    // products
    const CATEGORIES = "categories";
    const BRANDS = "brands";
    const PRODUCTS = "products";


    public static function timestamps(&$table){
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        $table->softDeletes();
    }
}
