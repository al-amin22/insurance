@extends('layouts.app')

{{-- SEO tags --}}
@section('title', $category->name . ' – CoverInsight')
@section('meta_description', "Explore the latest insights, tips and news on {$category->name} at CoverInsight. Stay informed with expert advice and up‑to‑date articles.")

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
    </ol>
</nav>

<article>
    <h1>{{ $category->name }}</h1>
    {{-- If you want some description text, you could hard‑code or pull from another source here --}}
</article>

{{-- Related Articles --}}
<nav aria-labelledby="related-heading" class="related-articles">
    <h2 id="related-heading">Latest Articles in {{ $category->name }}</h2>
    <ul itemscope itemtype="https://schema.org/ItemList">
        @foreach($relatedArticles as $i => $a)
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <meta itemprop="position" content="{{ $i + 1 }}" />
            <a itemprop="url" href="{{ route('articles.show', ['slug' => $a->slug]) }}">
                <span itemprop="name">{{ Str::limit($a->title, 60) }}</span>
            </a>
            <small class="text-muted" itemprop="datePublished">{{ $a->created_at->format('Y-m-d') }}</small>
        </li>
        @endforeach
    </ul>

    {{-- If paginated --}}
    {{ $relatedArticles->appends(request()->query())->links() }}
</nav>
@endsection