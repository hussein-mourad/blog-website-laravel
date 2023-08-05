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
                        <a href="/posts/{{ $post->id }}/edit" class=" btn btn-link btn-floating text-muted"
                            type="submit"><i class="fas fa-xl fa-pen"></i></a>
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

    <!--Section: Comments-->
    @if ($post->comments)
        <section class="border-bottom mb-3">
            <p class="text-center"><strong>Comments: {{ count($post->comments) }}</strong></p>
            @foreach ($post->comments as $comment)
                @unless ($comment->comment_id)
                    <div class="d-flex flex-start mb-3">
                        <img class="rounded-circle shadow-1-strong me-3" src="{{ asset('assets/imgs/default-avatar.jpg') }}"
                            alt="avatar" width="65" height="65" />
                        <div class="flex-grow-1 flex-shrink-1">
                            <div class="">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-1">
                                        {{ $comment->user->first_name . ' ' . $comment->user->last_name }} <span
                                            class="small ms-1">{{ $comment->updated_at->diffForHumans() }}</span>
                                    </p>
                                    <div class="d-flex">
                                        <button class="btn btn-link"
                                            onclick="showReplyForm({{ 'replyForm' . $comment->id }})"><i
                                                class="fas fa-reply fa-xs me-2"></i><span class="small">
                                                reply</span></button>
                                        <form action="/comments/{{ $comment->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class=" btn btn-link btn-floating text-muted" type="submit"><i
                                                    class="fas fa-xl fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <p class="small mb-0">
                                    {{ $comment->content }}
                                </p>
                            </div>
                            @foreach ($comment->replies as $reply)
                                <div class="d-flex flex-start mt-4">
                                    <div class="me-3">
                                        <img class="rounded-circle shadow-1-strong"
                                            src="{{ asset('assets/imgs/default-avatar.jpg') }}" alt="avatar"
                                            width="65" height="65" />
                                    </div>
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1">
                                                    {{ $reply->user->first_name . ' ' . $reply->user->last_name }} <span
                                                        class="small ms-1">
                                                        {{ $reply->updated_at->diffForHumans() }}</span>
                                                </p>
                                                <form action="/comments/{{ $reply->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class=" btn btn-link btn-floating text-muted" type="submit"><i
                                                            class="fas fa-xl fa-trash-can"></i></button>
                                                </form>
                                            </div>
                                            <p class="small mb-0">
                                                {{ $reply->content }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @auth
                        <div class="mt-4 mb-5">
                            <form action="/comments/{{ $post->id }}" method='post'>
                                @csrf
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <div class="form-outline mb-3">
                                    <textarea class="form-control" name="content" id="reply" rows="2" placeholder="Enter your reply" required></textarea>
                                    <label for="reply" class="form-label">Leave a Reply</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Reply</button>
                            </form>
                        </div>
                    @endauth
                @endunless
            @endforeach
        </section>
    @endif

    @auth
        <section>
            <p class="text-center"><strong>Leave a comment</strong></p>

            <form action="/comments/{{ $post->id }}" method="post" id="leaveComment">
                @csrf
                <div class="form-outline mb-4">
                    <textarea class="form-control" id="form4Example3" rows="4" name="content" required></textarea>
                    <label class="form-label" for="form4Example3">Text</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">
                    Comment
                </button>
            </form>
        </section>
    @endauth
</x-layout>
