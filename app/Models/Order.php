<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const ORDER_COMPLETED = '1';

    /**
     * @var array
     */
    protected array $fillable = ['user_id', 'image_id', 'status'];
}
