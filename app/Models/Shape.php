<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Shape
 *
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class Shape extends Model
{
    protected $table = 'shapes';

    protected $fillable = [
        'id',
        'name',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];
}
