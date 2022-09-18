<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @auth
        <a class="navbar-brand" href="{{ route('management.dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('questions.index') }}">Question</a>
                </li>
                <li class="nav-item active">
                    <form action="{{ route('management.signOut') }}" method="post">
                        {{ csrf_field() }}
                        <button class="nav-link btn btn-light" type="submit">signOut</button>
                    </form>
                </li>
            </ul>
        </div>
    @else
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('management/login') }}">Management Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            </ul>
        </div>
    @endauth

</nav>