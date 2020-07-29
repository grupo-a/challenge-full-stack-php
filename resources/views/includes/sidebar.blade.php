<style>
    .offcanvas-collapse {
        position: fixed;
        top: 56px;
        bottom: 0;
        left: 0;
        padding-right: 1rem;
        padding-left: 1rem;
        align-items: start;
    }

    .navbar-expand-lg .navbar-nav {
        -ms-flex-direction: column;
        flex-direction: column;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <a class="navbar-brand mr-auto" href="#">MÓDULO ACADÊMICO</a>
    <div class="navbar-collapse offcanvas-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('students.list')}}">Alunos <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Funcionários</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Salas</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Sala 1</a>
                    <a class="dropdown-item" href="#">Sala 2</a>
                    <a class="dropdown-item" href="#">Sala 3</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
