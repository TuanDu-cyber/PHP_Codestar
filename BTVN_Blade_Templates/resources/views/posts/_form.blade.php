<div class="form-container">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($post))
        @method('PUT')
        @endif

        <label for="title">Tiêu đề</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" placeholder="Tiêu đề bài viết..">
        @error('title')
        <p class="error">{{ $message }}</p>
        @enderror

        <label for="category">Chuyên mục</label>
        <select id="category" name="category">
            <option value="">-- Chọn chuyên mục --</option>
            @foreach ($categories as $slug => $label)
            <option value="{{ $slug }}" @selected(old('category', $post->category ?? '') === $slug)>{{ $label }}</option>
            @endforeach
        </select>
        @error('category')
        <p class="error">{{ $message }}</p>
        @enderror

        <label for="content">Nội dung</label>
        <textarea id="content" name="content" style="height:250px" placeholder="Nội dung bài viết..">{{ old('content', $post->content ?? '') }}</textarea>
        @error('content')
        <p class="error">{{ $message }}</p>
        @enderror

        <label for="image_file">
            Ảnh bài viết <span class="hint">(jpg, png, webp, tối đa 2MB)</span>
        </label>
        @if (isset($post) && $post->image)
        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="preview">
        <span class="hint">Ảnh hiện tại. Chọn ảnh mới nếu muốn thay.</span>
        @endif
        <input type="file" id="image_file" name="image_file" accept="image/*">
        @error('image_file')
        <p class="error">{{ $message }}</p>
        @enderror

        <input type="submit" value="{{ $button }}">
    </form>
</div>