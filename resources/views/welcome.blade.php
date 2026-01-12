<!doctype html>
<html lang="id">
  <head>
    <title>{{ env('APP_NAME') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- [Page specific CSS] end -->
    <!-- [Google Font] Family -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}" />
  </head>

  <body class="landing-page">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Nav ] start -->
    <nav class="navbar navbar-expand-md navbar-light default">
      <div class="container">
        <a class="navbar-brand f-w-500 d-flex align-items-center gap-2" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 10l-.85 8.507a1.357 1.357 0 0 0 1.35 1.493h.146a2 2 0 0 0 1.857 -1.257l.994 -2.486a2 2 0 0 1 1.857 -1.257h1.292a2 2 0 0 1 1.857 1.257l.994 2.486a2 2 0 0 0 1.857 1.257h.146a1.37 1.37 0 0 0 1.364 -1.494l-.864 -9.506h-8c0 -3 -3 -5 -6 -5l-3 6l2 2l3 -2z" />
                <path d="M22 14v-2a3 3 0 0 0 -3 -3" />
            </svg>
            My Pekerjaan Gua
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="btn btn-secondary" href="{{ route('login') }}"
                >Masuk</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- [ Nav ] start -->
    <!-- [ Header ] start -->
    <header id="home">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-lg-9 col-xl-8">
            <h1 class="mt-sm-3 mb-sm-4 f-w-600 wow fadeInUp" data-wow-delay="0.2s"
              >Buat Workspace<span class="text-primary"> Kamu</span></h1
            >
            <h4 class="mb-sm-4 text-muted wow fadeInUp" data-wow-delay="0.4s"
              >Pantau, Atur, Dan Selesaikan Pekerjaanmu dengan mudah tanpa kehilangan arah dengan <i>My Pekerjaan Gua</i></h4
            >
            <div class="my-3 my-xl-5 wow fadeInUp" data-wow-delay="0.6s">
              <a href="" class="btn btn-secondary me-2">Gabung Workspace</a>
              <a href="" class="btn btn-link-primary" target="_blank"
                >Buat Workspace</a
              >
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- [ Header ] End -->
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
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
    <!-- [Page Specific JS] start -->
    <script>
      // Start [ Menu hide/show on scroll ]
      let ost = 0;
      document.addEventListener('scroll', function () {
        let cOst = document.documentElement.scrollTop;
        if (cOst == 0) {
          document.querySelector('.navbar').classList.add('top-nav-collapse');
        } else if (cOst > ost) {
          document.querySelector('.navbar').classList.add('top-nav-collapse');
          document.querySelector('.navbar').classList.remove('default');
        } else {
          document.querySelector('.navbar').classList.add('default');
          document.querySelector('.navbar').classList.remove('top-nav-collapse');
        }
        ost = cOst;
      });
      // End [ Menu hide/show on scroll ]
    </script>
    <!-- [Page Specific JS] end -->
  </body>
</html>
