<?php

// app/Models/InsuranceCategory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceCategory extends Model
{
    protected $table = 'insurance_categories';

    protected $fillable = ['name', 'slug', 'visit_count'];

    public function articles()
    {
        return $this->hasMany(InsuranceArticle::class, 'category_id');
    }
}
