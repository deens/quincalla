@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="thumbnail">
                <img src="http://placehold.it/420x420" alt="">
                <hr>
                <div class="thumbnail-preview text-center">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="http://placehold.it/100x100" alt="">
                        </div>
                        <div class="col-md-4">
                            <img src="http://placehold.it/100x100" alt="">
                        </div>
                        <div class="col-md-4">
                            <img src="http://placehold.it/100x100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <h1>{{ $product->name }}</h1>

            <div class="ratings">
                <p class="pull-right">5 reviews | <a href=""> Write a review</a></p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </p>
            </div>

            <hr>

            <div class="pricing">
                <div class="row">
                    <div class="col-md-4">
                        <h2>${{ $product->price }}</h2>
                    </div>
                    <div class="col-md-8">
                        {!! Form::open(['route' => 'cart.store', 'method' => 'POST', 'class' => 'form-inline']) !!}
                            {!! Form::hidden('product', $product->slug) !!} 
                            <div class="form-group">
                                {!! Form::label('qty', 'Quantity:') !!}
                                {!! Form::text('qty', '1', ['class' => 'form-control']) !!} 
                                {!! Form::submit('Add To Shopping Bag', ['class' => 'btn btn-danger']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <hr>

            <div class="description">
                <h3>Product Description</h3>
                <p>{{ $product->description }}</p>
            </div>

            <hr>
            <div class="rating-reviews">

                <h3 class="text-left">Ratings & Reviews</h3>
                <div class="well">

                    <div class="text-right">
                        <a class="btn btn-success">Leave a Review</a>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Anonymous
                            <span class="pull-right">10 days ago</span>
                            <p>Ipsum placeat inventore voluptatem totam deleniti vitae natus. Adipisci quasi tenetur dignissimos cupiditate quos reprehenderit. Culpa amet consequuntur in quo tempore sint nam. Animi qui quibusdam aperiam necessitatibus debitis eum.</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Anonymous
                            <span class="pull-right">12 days ago</span>
                            <p>Ipsum placeat inventore voluptatem totam deleniti vitae natus. Adipisci quasi tenetur dignissimos cupiditate quos reprehenderit. Culpa amet consequuntur in quo tempore sint nam. Animi qui quibusdam aperiam necessitatibus debitis eum.</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Anonymous
                            <span class="pull-right">15 days ago</span>
                            <p>Ipsum placeat inventore voluptatem totam deleniti vitae natus. Adipisci quasi tenetur dignissimos cupiditate quos reprehenderit. Culpa amet consequuntur in quo tempore sint nam. Animi qui quibusdam aperiam necessitatibus debitis eum.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop
