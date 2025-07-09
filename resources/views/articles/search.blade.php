@extends('layouts.app')

@section('title', 'Search Results for: ' . $searchQuery)
@section('meta_description', 'Search results for insurance articles about ' . $searchQuery)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4">Search Results for: "{{ $searchQuery }}"</h1>

            @if($results->count())
            <div class="alert alert-info">
                Found {{ $results->total() }} results
            </div>

            @foreach($results as $article)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h2 class="h4">
                        <a href="{{ route('articles.show', [
                                'country' => strtolower($article->country),
                                'category_slug' => $article->category->slug,
                                'article_slug' => $article->slug
                            ]) }}" class="text-decoration-none">
                            {{ $article->title }}
                        </a>
                    </h2>
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-primary me-2">{{ strtoupper($article->country) }}</span>
                        <span class="text-muted">{{ $article->category->name }}</span>
                    </div>
                    <p class="card-text">{{ Str::limit(strip_tags($article->description), 200) }}</p>
                    <small class="text-muted">Last updated {{ $article->updated_at->diffForHumans() }}</small>
                </div>
            </div>
            @endforeach

            {{ $results->links() }}
            @else
            <div class="alert alert-warning">
                No results found for "{{ $searchQuery }}"
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('articles.by_country', 'us') }}" class="btn btn-primary">
                    Browse All Articles
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection