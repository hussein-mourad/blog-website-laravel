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

    @auth
        <section class="border-bottom mb-5">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">

                    </div>
                    <div>
                        <form>
                            <a href="#leaveComment" class="btn btn-link text-muted ps-0">
                                <i class="fa-xl fa-regular fa-comment me-2"></i><strong>Comment</strong>
                            </a>
                        </form>
                    </div>
                </div>
                @if (auth()->id() == $post->user_id || auth()->user()->role == 'admin')
                    <div class="d-flex justify-content-end">
                        <a href="/posts/{{ $post->id }}/edit" class=" btn btn-link btn-floating text-muted" type="submit"><i
                                class="fas fa-xl fa-pen"></i></a>
                        <form action="/posts/{{ $post->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button class=" btn btn-link btn-floating text-muted" type="submit"><i
                                    class="fas fa-xl fa-trash-can"></i></button>
                        </form>
                    </div>
                @endif
            </div>
        </section>
    @endauth


    <!--Section: Text-->
    <section class="mb-3">
        <p>{{ $post->content }}</p>
    </section>
</x-layout>
