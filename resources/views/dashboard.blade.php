<x-layout>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            .sidebar-content {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }
    </style>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <a href="#" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                </a>
            </div>
        </div>
    </nav>
    <div class="sidebar-content">
        <!-- Section: Main chart -->
        <section class="mb-4">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @unless (auth()->id() == $user->id)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/imgs/default_image.png') }}" alt=""
                                            style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">
                                                {{ $user->first_name . ' ' . $user->last_name }}</p>
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->created_at->format('h:m d/m/Y') }}</td>
                                <td>
                                    <form action="/users/{{ $user->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input name="id" value="{{ $user->id }}" type="hidden" />
                                        <button class=" btn btn-link btn-floating text-muted" type="submit"><i
                                                class="fas fa-xl fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endunless
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- Section: Main chart -->

        <!--Section: Statistics with subtitles-->
        <section>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fas fa-pencil-alt text-info fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Posts</h4>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">{{ count($posts) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Comments</h4>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">{{ count($comments) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="far fa-thumbs-up text-primary fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Reactions</h4>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">{{ count($reactions) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="far fa-user text-danger fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Users</h4>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">{{ count($users) }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Statistics with subtitles-->
    </div>
</x-layout>
