<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/css/bootstrap.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />
    <title>Dashboard</title>
  </head>
  <body>
    <div id="wrapper">
      <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid p-0">
          <div id="header-logo" class="seller-center-logo">
            <div
              class="d-flex justify-content-center align-items-center h-100 w-100"
            >
              {{-- <img src="{{ asset('assets/images/logo-with-text.png') }}" alt="Mobvex" /> --}}
              <h5 class="fw-bolder text-primary m-0">Trisecure</h5>
            </div>
          </div>
        </div>
      </header>
      <div id="content" class="login-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
              <div class="col-lg-5 col-sm-10 col-12 col-md-8 mt-5">
                <div id="login-container">
                  <h2>Driver Login</h2>
                  <form action="" method="post">
                    <div class="input-group mb-3 mt-4">
                      <span class="input-group-text"
                        ><i class="fa-solid fa-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Email"
                      />
                    </div>
                    <div class="input-group mb-3 mt-4">
                      <span class="input-group-text"
                        ><i class="fa-solid fa-lock"></i
                      ></span>
                      <input
                        type="password"
                        class="form-control"
                        placeholder="Password"
                      />
                    </div>
                    <button type="button" class="btn btn-primary w-100">
                      Login
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div style="background-color: red; width: 100px; height: 1000px"></div> -->
      <footer style="margin-left: 0">
        Copyright. &copy; 2023 All Rights Reserved
      </footer>
    </div>
    <script
      type="text/javascript"
      src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"
    ></script>
  </body>
</html>
