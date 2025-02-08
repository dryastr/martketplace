<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets-auth/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets-auth/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-auth/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets-auth/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets-auth/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-auth/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets-auth/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ asset('assets-auth/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets-auth/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-2">Selamat Datang! 👋</h4>
                        <p class="mb-4">Silahkan daftar untuk membuat akun baru</p>

                        {!! Form::open(['route' => 'register', 'method' => 'post']) !!}
                        @csrf

                        <div class="mb-3">
                            {!! Form::label('name', 'Nama', ['class' => 'form-label']) !!}
                            {!! Form::text('name', null, [
                                'class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : ''),
                                'required' => true,
                                'placeholder' => 'Nama lengkap',
                                'autocomplete' => 'name',
                            ]) !!}
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                            {!! Form::email('email', null, [
                                'class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : ''),
                                'required' => true,
                                'placeholder' => 'Email aktif',
                                'autocomplete' => 'email',
                            ]) !!}
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
                            <div class="input-group input-group-merge">
                                {!! Form::password('password', [
                                    'class' => 'form-control ' . ($errors->has('password') ? 'is-invalid' : ''),
                                    'required' => true,
                                    'placeholder' => 'Masukkan password',
                                    'autocomplete' => 'new-password',
                                ]) !!}
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {!! Form::label('password_confirmation', 'Konfirmasi Password', ['class' => 'form-label']) !!}
                            <div class="input-group input-group-merge">
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control',
                                    'required' => true,
                                    'placeholder' => 'Konfirmasi password',
                                    'autocomplete' => 'new-password',
                                ]) !!}
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            {!! Form::submit('Daftar', ['class' => 'btn btn-primary d-grid w-100']) !!}
                        </div>

                        <div class="text-center mt-3">
                            <span>Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a></span>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets-auth/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets-auth/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets-auth/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets-auth/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets-auth/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets-auth/js/main.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
