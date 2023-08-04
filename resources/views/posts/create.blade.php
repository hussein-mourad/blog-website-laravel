<x-layout>
    <section class="container">
        <div class="pt-5">
            <form action="/posts" method="post" enctype="multipart/form-data">
                @csrf
                <h2 class="mb-4">Add Post</h2>
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title"
                        placeholder="Enter Post Title" required>
                    {{-- <small class="text-danger" for="title"></small> --}}
                </div>
                <div class="form-group mb-3">
                    <label for="postContent">Content</label>
                    <textarea name="content" class="form-control" id="postContent" rows="3" placeholder="Enter Post Content" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <select name="category" class="form-control" id="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    {{-- <small class="text-danger" for="category"></small> --}}
                </div>
                <div class="form-group mb-4">
                    <label for="thumbnail" class="form-label">Upload Post Thumbnail</label>
                    <input name="thumbnail" type="file" class="form-control" id="thumbnail">
                    {{-- <small class="text-danger" for="thumbnail"></small> --}}
                </div>
                <input name="submit" type="submit" class="btn btn-primary" value="Add Post" />
            </form>
        </div>
    </section>
</x-layout>
