<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    private static $defaultPrimaryKey = 'id';

    private static $unnecessaryColumns = ['created_at', 'updated_at'];

    public static function updateData(array $columns, array $detail, string $primaryKey = null)
    {
        $primaryKey = $primaryKey ?? self::$defaultPrimaryKey;
        $data = array();
        foreach ($columns as $column) {
            if (!in_array($column, self::$unnecessaryColumns))
            $data[$column] = $detail[$column];
        }
        self::updateOrInsert([$primaryKey => $detail[$primaryKey]], $data);
    }
}
