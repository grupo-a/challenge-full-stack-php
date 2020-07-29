<!doctype html>
@include('sweetalert::alert')
<html>
<head>
    @include('includes.head')
</head>
<style>
    body {
        font-family: "Lato", sans-serif;
    }

    .sidenav {
        height: 100%;
        background-image: url({{url('storage/login_background.jpg')}});
        overflow-x: hidden;
        padding-top: 20px;
    }


    .main {
        padding: 0px 10px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }
    }

    @media screen and (max-width: 450px) {
        .login-form {
            margin-top: 10%;
        }
    }

    @media screen and (min-width: 768px) {
        .main {
            margin-left: 40%;
        }

        .sidenav {
            width: 40%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
        }

        .login-form {
            margin-top: 80%;
        }
    }


    .login-main-text {
        margin-top: 20%;
        padding: 60px;
        color: #fff;
    }

    .login-main-text h2 {
        font-weight: 300;
    }

    .btn-dark-purple {
        background-color: #170040 !important;
        color: #fff;
    }
</style>
<body>
<div class="container">
    <div class="sidenav">
        <div class="login-main-text">
            <h2>Instituição<br> Página de Login</h2>
            <p>Faça login para cadastrar as matrículas dos usuários</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form id="login" action="javascript:void(0);" onsubmit="submitForm()" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>E-mail: </label>
                        <input name="email" type="text" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="form-group">
                        <label>Senha: </label>
                        <input name="password" type="password" class="form-control" placeholder="Senha" required>
                    </div>
                    <button type="submit" class="btn btn-dark-purple">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm() {
        $.ajax({
            url: '{{url('/login')}}',
            type: 'POST',
            data: $('#login').serialize(),
            success: function (data) {
                if (data.success) {
                    window.location = data.url
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Oops...', 'Email ou senha incorretos, tente novamente.', 'error')
            },
        });
    }
</script>
</body>
</html>
