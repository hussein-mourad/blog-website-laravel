<x-layout>
    <section class="container">
        <x-flash-success />
        <div class="py-5">
            <form method="post" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <h2 class="mb-4">Edit Post</h2>
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title"
                        placeholder="Enter Post Title" required value="{{ $post->title }}">
                    @error('title')
                        <small class="text-danger" for="title">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="postContent">Content</label>
                    <textarea name="content" class="form-control" id="postContent" rows="3" placeholder="Enter Post Content" required>{{ $post->content }}</textarea>
                    @error('content')
                        <small class="text-danger" for="title">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <select name="category_id" class="form-control" id="category" value="{{ $post->category }}">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
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
                {{-- <div class="d-flex justify-content-center">
                    <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/imgs/default_image.png') }}"
                        class="img-fluid shadow-2-strong rounded-5 mb-4" alt="" />
                </div> --}}
                <input name="submit" type="submit" class="btn btn-primary" value="Edit Post" />
            </form>
        </div>
    </section>
</x-layout>
