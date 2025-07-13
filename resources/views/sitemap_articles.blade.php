<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($articles as $article)
    @if ($article->category && $article->country && $article->slug)
    <url>
        <loc>{{ url(strtolower($article->country) . '/' . $article->category->slug . '/' . $article->slug) }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($article->updated_at)->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endif
    @endforeach
</urlset>
