<!doctype html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta name="auth-token" content="">
    @include('includes.admin.head')
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="login-page bg-body-secondary">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <a
                href="#"
                class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
            >
                <h1 class="mb-0"><b>Almaty</b>Resort</h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <form id="loginForm">
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="loginEmail" type="email" name="email" class="form-control" value="" placeholder="" />
                        <label for="loginEmail">Email</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="loginPassword" type="password" name="password" class="form-control" placeholder="" />
                        <label for="loginPassword">Password</label>
                    </div>
                    <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                </div>
                <!--begin::Row-->
                <div class="row">
                    <div class="col-8 d-inline-flex align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            <label class="form-check-label" for="flexCheckDefault"> Запомнить меня </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Войти</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </form>
            <!-- /.social-auth-links -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
    crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const token = localStorage.getItem('auth_token');
        if (token) {
            document.querySelector('meta[name="auth-token"]').setAttribute('content', token);
        }
    });
    $(document).ready(function () {
        $("#loginForm").on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{route('login')}}", // Получаем URL из атрибута action
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    console.log(localStorage.getItem('auth_token'))
                    localStorage.setItem('auth_token', response.access_token);
                    // location.reload();
                },
                error: function (error) {
                }
            });
        });
    });
</script>
<!--end::OverlayScrollbars Configure-->
<!--end::Script-->
</body>
<!--end::Body-->
</html>
