<div class="col-md-4 mb-4">
    <div class="card h-100">
        <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
        <div class="card-body">
            <small class="text-muted">
                {{ $post->category }} · {{ $post->published_at->format('d/m/Y') }}
            </small>
            <h5 class="card-title mt-2">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->excerpt }}</p>
        </div>
    </div>
</div>