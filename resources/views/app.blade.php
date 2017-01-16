<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quincalla</title>

        <link href="{{ asset(elixir('css/app.css')) }}" rel="stylesheet">

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img class="navbar-brand" src="{{ asset('images/logo.png')}}" alt="Quincalla">
                    <a class="navbar-brand" href="{{ url('/') }}">quincalla</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        @if(isset($collections) && $collections->count())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Collections<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($collections as $collection)
                                        <li><a href="{{ route('collections.show', [$collection->slug]) }}">{{ $collection->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        {!! Form::open(['route' => 'search.index', 'method' => 'get', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                            <div class="form-group">
                                <input type="text" name="query" value="{{ $query or ''}}" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        {!! Form::close() !!}

                        <li><a href="{{ route('cart.index') }}"> <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> ({{ $cart_count }})</a></li>
                        @if (Auth::guest())
                        @else
                            <li><a href="{{ url('/account') }}">My Account</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Alert messages -->
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
        </div>

        <!-- Content -->
        @yield('content')

        <!-- Footer -->
        <hr>
        <div class="container">
            <footer>
                <div class="row text-center">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Quincalla {{ date('Y') }}</p>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{ asset(elixir('js/app.js')) }}"></script>
    </body>
</html>
