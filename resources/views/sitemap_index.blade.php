<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/about') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/contact') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/policies/privacy') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ url('/policies/terms') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ url('/policies/licensing') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ url('/policies/dmca') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>

    {{-- Country & category --}}
    @foreach ($countries as $country)
    <sitemap>
        <loc>{{ url(strtolower($country)) }}</loc>
        <lastmod>{{ $now }}</lastmod>
    </sitemap>
    @foreach ($categories as $category)
    <sitemap>
        <loc>{{ url(strtolower($country) . '/category/' . $category->slug) }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($category->updated_at)->toAtomString() }}</lastmod>
    </sitemap>
    @endforeach
    @endforeach

    {{-- Article sitemap pages --}}
    @for ($i = 1; $i <= $totalPages; $i++)
        <sitemap>
        <loc>{{ url("/sitemap-articles-$i.xml") }}</loc>
        <lastmod>{{ $now }}</lastmod>
        </sitemap>
        @endfor
</sitemapindex>
