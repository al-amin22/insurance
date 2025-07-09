<?php

// app/Models/InsuranceArticle.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceArticle extends Model
{
    protected $table = 'insurance_articles';

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'slug',
        'content',
        'image_path',
        'country',
        'category_id',
        'visit_count'
    ];

    public function category()
    {
        return $this->belongsTo(InsuranceCategory::class, 'category_id');
    }

    // public function seoEvaluation()
    // {
    //     return $this->hasOne(InsuranceSeoEvaluation::class, 'article_id');
    // }

    public function relatedArticles()
    {
        return $this->belongsToMany(
            InsuranceArticle::class,
            'insurance_article_relations',
            'article_id',
            'related_article_id'
        )->withPivot('relation_strength', 'relation_type');
    }
}
