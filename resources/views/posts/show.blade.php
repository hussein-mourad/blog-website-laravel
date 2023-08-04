<x-layout>
    <style>
        .dropdown:hover>.dropdown-menu {
            display: block;
        }

        .dropdown>.dropdown-toggle:active {
            /*Without this, clicking will make it sticky*/
            pointer-events: none;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
    <div class="p-5 text-center bg-light">
        <h1 class="mb-0 h4">{{ $post->title }}</h1>
    </div>
    <!--Section: Post data-mdb-->
    <section class="border-bottom mb-3">
        <div class="d-flex justify-content-center">
            <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('assets/imgs/default_image.png') }}"
                class="img-fluid shadow-2-strong rounded-5 mb-4" alt="" />
        </div>
        <div class="row align-items-center mb-4">
            <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
                <img src="{{ asset('assets/imgs/default-avatar.jpg') }}" class="rounded-5 shadow-1-strong me-2"
                    height="35" alt="" loading="lazy" />
                <span> Published <u>{{ $post->created_at->format('F j, Y') }}</u> by
                    <span class="text-dark">{{ $post->user->first_name . ' ' . $post->user->last_name }} </span>
                </span>
            </div>
        </div>

    </section>


    <!--Section: Text-->
    <section class="mb-3">
        <p>{{ $post->content }}</p>
    </section>
</x-layout>
