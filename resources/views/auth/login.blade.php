@extends('layouts.guest')
@section('content')
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        <h4 class="text-center mb-4">Sign in your account</h4>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('login') }}" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="mb-1"><strong>Email</strong></label>
                                <input type="email" class="form-control" type="email" name="email"
                                    :value="old('email')" placeholder="example.com" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="mb-1"><strong>Password</strong></label>
                                <input type="password" class="form-control" placeholder="*********" name="password" required
                                    autocomplete="current-password">
                            </div>
                            <div class="row d-flex justify-content-between mt-4 mb-2">
                                <div class="mb-3">
                                    <div class="form-check custom-checkbox ms-1">
                                        <input type="checkbox" class="form-check-input" id="basic_checkbox_1"
                                            name="remember">
                                        <label class="form-check-label" for="basic_checkbox_1">Remember my
                                            preference</label>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="mb-3">
                                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </form>
                        {{-- <div class="new-account mt-3">
                            <p>Don't have an account? <a class="text-primary" href="./page-register.html">Sign up</a></p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('extended-js')
    <script>
        $(function() {
            $("form").submit(function(e) {
                e.preventDefault();
                if ($(this).valid()) {
                    $(this).find(":submit").prop('disabled', true).html(
                        'Logging in... <div class="spinner-border spinner-border-sm loader" role="status"></div>'
                        );
                    this.submit()
                }
            });
        });
    </script>
@endpush
