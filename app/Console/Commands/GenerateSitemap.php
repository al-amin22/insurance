<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InsuranceArticle;
use App\Models\InsuranceCategory;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        // Add categories
        InsuranceCategory::chunk(100, function ($categories) use ($sitemap) {
            foreach ($categories as $category) {
                $sitemap->add(Url::create(route('categories.show', [
                    'country' => 'us',
                    'slug' => $category->slug
                ]))
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
            }
        });

        // Add articles
        InsuranceArticle::chunk(100, function ($articles) use ($sitemap) {
            foreach ($articles as $article) {
                $sitemap->add(Url::create(route('articles.show', [
                    'country' => strtolower($article->country),
                    'category_slug' => $article->category->slug,
                    'article_slug' => $article->slug
                ]))
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setLastModificationDate($article->updated_at));
            }
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
