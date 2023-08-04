<x-layout>
    <section class="vh-100 d-flex justify-content-center">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('assets/imgs/banner.webp') }}" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <h1 class="pb-4">Login</h1>
                    <form action="/users/auth" method="POST">
                        @csrf
                        <!-- Email input -->
                        <div class="form-group mb-4">
                            <label class="form-label" for="emailField">Email address</label>
                            <input name="email" type="email" id="emailField" class="form-control form-control-lg"
                                placeholder="Enter email address" />
                        </div>

                        <!-- Password input -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="passwordField">Password</label>
                            <input name="password" id="passwordField" type="password"
                                class="form-control form-control-lg" placeholder="Enter password" />
                        </div>
                        @error('failed')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <input type="submit" value="Login" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;" />
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="/signup"
                                    class="link-primary">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
