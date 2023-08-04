<x-layout>
    <section class="vh-100 d-flex justify-content-center">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5 d-flex justify-content-center align-items-center">
                    <img src="assets/imgs/banner.webp" class="img-fluid banner" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <h1 class="pb-4">Signup</h1>
                    <form action="forms/auth/handleSignup.php" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="firstNameField">First name</label>
                                    <input name="first_name" type="text" id="firstNameField" class="form-control"
                                        placeholder="Enter first name" />

                                    <small class="text-danger" for="firstNameField"></small>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="lastNameField">Last name</label>
                                    <input name="last_name" type="text" id="lastNameField" class="form-control"
                                        placeholder="Enter last name" />
                                    <small class="text-danger" for="lastNameField"></small>
                                </div>
                            </div>
                        </div>
                        <!-- Email input -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="emailField">Email address</label>
                            <input name="email" type="email" id="emailField" class="form-control form-control-lg"
                                placeholder="Enter email address" />
                            <small class="text-danger" for="emailField"></small>
                        </div>

                        <!-- Password input -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="passwordField">Password</label>
                            <input name="password" id="passwordField" type="password"
                                class="form-control form-control-lg" placeholder="Enter password" />
                            <small class="text-danger" for="passwordField"></small>
                        </div>
                        <!-- <small class="small text-danger" for="passwordField">Error not password</label> -->

                        <!-- Confim Password input -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="confirmPasswordField">Confirm password</label>
                            <input name="password_confirmation" id="confirmPasswordField" type="password"
                                class="form-control form-control-lg" placeholder="Confirm password" />
                            <small class="text-danger" for="confirmPasswordField"></small>
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
