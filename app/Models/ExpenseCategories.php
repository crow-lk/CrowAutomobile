<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategories extends Model
{
    protected $table = 'expense_categories';
    protected $fillable = [
        'name'
    ];
}
