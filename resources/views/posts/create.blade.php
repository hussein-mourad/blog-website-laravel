<x-layout>
    <section class="container">
        <x-flash-success />
        <div class="pt-5">
            <form method="post" action="/posts">
                @csrf
                <h2 class="mb-4">Add Post</h2>
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title"
                        placeholder="Enter Post Title" required value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger" for="title">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="postContent">Content</label>
                    <textarea name="content" class="form-control" id="postContent" rows="3" placeholder="Enter Post Content" required>{{ old('content') }}</textarea>
                    @error('content')
                        <small class="text-danger" for="title">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <select name="category" class="form-control" id="category" value="{{ old('category') }}">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger" for="category">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="thumbnail" class="form-label">Upload Post Thumbnail</label>
                    <input name="thumbnail" type="file" class="form-control" id="thumbnail"
                        value="{{ old('thumbnail') }}">
                    @error('thumbnail')
                        <small class="text-danger" for="thumbnail">{{ $message }}</small>
                    @enderror
                </div>
                <input name="submit" type="submit" class="btn btn-primary" value="Add Post" />
            </form>
        </div>
    </section>
</x-layout>
