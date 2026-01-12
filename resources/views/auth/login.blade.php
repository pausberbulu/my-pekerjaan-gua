<!doctype html>
<html lang="id">
  <!-- [Head] start -->
  <head>
    <title>{{ $title ?? 'Dashboard' }} | {{ env('APP_NAME') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies."
    />
    <meta
      name="keywords"
      content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard"
    />
    <meta name="author" content="codedthemes" />

    <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body>
    <div class="auth-main">
        <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5">
            <div class="card-body">
                 <a class="navbar-brand f-w-500 d-flex align-items-center gap-2 justify-content-center" href="{{ route('welcome') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 10l-.85 8.507a1.357 1.357 0 0 0 1.35 1.493h.146a2 2 0 0 0 1.857 -1.257l.994 -2.486a2 2 0 0 1 1.857 -1.257h1.292a2 2 0 0 1 1.857 1.257l.994 2.486a2 2 0 0 0 1.857 1.257h.146a1.37 1.37 0 0 0 1.364 -1.494l-.864 -9.506h-8c0 -3 -3 -5 -6 -5l-3 6l2 2l3 -2z" />
                        <path d="M22 14v-2a3 3 0 0 0 -3 -3" />
                    </svg>
                    My Pekerjaan Gua
                </a>
                <div class="row">
                <div class="d-flex justify-content-center">
                    <div class="auth-header">
                    <h2 class="text-secondary mt-5"><b>Halo, Selamat Datang Kembali</b></h2>
                    </div>
                </div>
                </div>
                <h5 class="my-4 d-flex justify-content-center">Masuk menggunakan nama pengguna dan kata sandi</h5>
                @if (session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
                    <i class="ti ti-circle-check fs-3"></i>
                    <span class="mt-1">{{ session('success') }}</span>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
                    <i class="ti ti-x fs-3"></i>
                    <span class="mt-1">{{ session('error') }}</span>
                </div>
                @endif
                <form action="{{ route('authenticate') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Nama pengguna" required />
                    <label for="floatingInput">Nama pengguna</label>
                    </div>
                    <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput1" name="password" placeholder="Kata sandi" required />
                    <label for="floatingInput1">Kata Sandi</label>
                    </div>
                    <div class="d-flex mt-1 justify-content-between">
                    {{-- <h5 class="text-secondary">Forgot Password?</h5> --}}
                    </div>
                    <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-secondary">Masuk</button>
                    </div>
                </form>
                <hr />
                <a href="{{ route('register') }}" class="d-flex justify-content-center">Belum Punya Akun?</a>
            </div>
            </div>
        </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script>
    layout_change('light');
    </script> 
    <script>
    font_change('Roboto');
    </script>
    <script>
    change_box_container('false');
    </script>
    <script>
    layout_caption_change('true');
    </script>
    <script>
    layout_rtl_change('false');
    </script>
    <script>
    preset_change('preset-1');
    </script>
  </body>
  <!-- [Body] end -->
</html>