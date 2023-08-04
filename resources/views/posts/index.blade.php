<x-layout>
    <div class="pt-4">
        @unless (count($posts) == 0)
            @foreach ($categories as $category)
                <h1 class="mt-5"><?= $post->category ?></h1>
                <hr class="mb-4" />
                <h2>{{ $category->name }}</h2>
                <ul>
                    @foreach ($category->posts as $post)
                        <li>{{ $post->title }}</li>
                    @endforeach
                </ul>
            @endforeach
            @foreach ($posts as $post)
                @php
                    $maxCharacters = 120;
                    $suffix = '...Read more';
                    $truncatedContent = Str::limit($post->content, $maxCharacters, $suffix);
                @endphp
                <a href="/posts/{{ $post->id }}">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/imgs/default_image.png') }}"
                                    alt="thumbnail" class="img-fluid rounded-start" />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">
                                        {{ $truncatedContent }}
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">By:
                                            {{ $post->user->first_name . ' ' . $post->user->last_name }} </small>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">Last updated
                                            {{ $post->updated_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <p>No posts found</p>
        @endunless
    </div>
</x-layout>
