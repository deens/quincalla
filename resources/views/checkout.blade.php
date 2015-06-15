<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quincalla</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
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
                </ul>
                {!! Form::open(['route' => 'search.index', 'method' => 'get', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                    <div class="form-group">
                      <input type="text" name="query" value="{{ $query or ''}}" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                {!! Form::close() !!}
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('cart.index') }}">Shopping Cart ({{ $cart_count }})</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                    @else
                        <li><a href="{{ url('/account') }}">My Account</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-9">
                @yield('content')
            </div>
            <div class="col-md-3">
                <div class="order-summary well well-sm">
                    <h3>Order Summary</h3>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>{{ $cart_count }} Item(s)</td>
                            <td class="price">${{ number_format($cart_total, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td class="price"><span class="success">$0.00</span></td>
                        </tr>
                        <tr>
                            <td>Taxation</td>
                            <td class="price">$0.00</td>
                        </tr>
                        <tr class="total">
                            <td> Total </td>
                            <td class="price">${{ number_format($cart_total, 2) }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a class="" href="{{ url('cart')}}">edit cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <hr>
    <div class="container">
        <footer>
            <div class="row text-center">
                <div class="col-lg-12">
                    <p>Copyright &copy; Quincalla 2015</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="{{ url('js/checkout.js') }}"></script>
</body>
</html>

