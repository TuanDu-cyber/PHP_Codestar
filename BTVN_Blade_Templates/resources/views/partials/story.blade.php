<div class="story {{ $extra ?? '' }}">
    <a href="{{ route('article.show', $post) }}">
        <div class="story-img">
            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
        </div>
        <div class="story-headline">
            <h3>{{ $post->title }}</h3>
            <p class="exact-time">{{ $post->published_at->format('H:i') }}h</p>
        </div>
    </a>
</div>