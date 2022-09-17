<?php

namespace App\Http\Common\db;

trait DBUtil
{
    // user
    public static function users(string $col = null): string
    {
        return DBTables::USERS . self::col($col);
    }

    // products
    public static function categories(string $col = null): string
    {
        return DBTables::CATEGORIES . self::col($col);
    }

    public static function brands(string $col = null): string
    {
        return DBTables::BRANDS . self::col($col);
    }

    public static function products(string $col = null): string
    {
        return DBTables::PRODUCTS . self::col($col);
    }


    public static function col(string $col = null): string
    {
        return $col == null ? "" : ".$col";
    }
}
