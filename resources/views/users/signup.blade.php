<x-layout container="false">
    <style>
        #content {
            margin-top: 0;
        }
    </style>
    <section class="vh-100 d-flex justify-content-center pt-5">
        <div class="container-fluid">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5 d-flex justify-content-center align-items-center">
                    <img src="assets/imgs/banner.webp" class="img-fluid banner" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <h1 class="pb-4">Signup</h1>
                    <form action="/users" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="firstNameField">First name</label>
                                    <input name="first_name" type="text" id="firstNameField" class="form-control"
                                        placeholder="Enter first name" value="{{ old('first_name') }}" />
                                    @error('first_name')
                                        <small class="text-danger" for="firstNameField">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="lastNameField">Last name</label>
                                    <input name="last_name" type="text" id="lastNameField" class="form-control"
                                        placeholder="Enter last name" value="{{ old('last_name') }}" />
                                    @error('last_name')
                                        <small class="text-danger" for="lastNameField">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Email input -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="emailField">Email address</label>
                            <input name="email" type="email" id="emailField" class="form-control form-control-lg"
                                placeholder="Enter email address" value="{{ old('email') }}" />

                            @error('email')
                                <small class="text-danger" for="emailField">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="passwordField">Password</label>
                            <input name="password" id="passwordField" type="password"
                                class="form-control form-control-lg" placeholder="Enter password"
                                value="{{ old('password') }}" />
                            <small class="text-danger" for="passwordField"></small>
                        </div>
                        @error('password')
                            <small class="small text-danger" for='passwordField'>{{ $message }}</small>
                        @enderror

                        <!-- Confim Password input -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="confirmPasswordField">Confirm password</label>
                            <input name="password_confirmation" id="confirmPasswordField" type="password"
                                class="form-control form-control-lg" placeholder="Confirm password"
                                value="{{ old('password') }}" />
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <input type="submit" value="Signup" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;" />
                            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="/login"
                                    class="link-primary">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </x-layout>
