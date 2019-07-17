@extends('layout.common')
@section('titlt','购物车列表')
@section('pages section')
    <!-- cart -->
    <div class="cart section">
        <div class="container">
            <div class="pages-head">
                <h3>CART</h3>
            </div>
            <div class="content">
                @foreach($cart as $v)
                    <div class="cart-1">
                        <div class="row">
                            <div class="col s5">
                                <h5>Image</h5>
                            </div>
                            <div class="col s7">
                                <img src='{{asset("$v->goods_pic")}}' alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s5">
                                <h5>Name</h5>
                            </div>
                            <div class="col s7">
                                <h5><a href="">{{$v->goods_name}}</a></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s5">
                                <h5>Quantity</h5>
                            </div>
                            <div class="col s7">
                                <input value="{{$v->goods_num}}" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s5">
                                <h5>Price</h5>
                            </div>
                            <div class="col s7">
                                <h5>${{$v->goods_price}}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s5">
                                <h5>Action</h5>
                            </div>
                            <div class="col s7">
                                <h5><i class="fa fa-trash"></i></h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="total">
                <div class="row">
                    <div class="col s7">
                        <h6>Total</h6>
                    </div>
                    <div class="col s5">
                        <h6>${{$total}}</h6>
                    </div>
                </div>
            </div>
            <a class="btn button-default" href="{{url('home/order_create')}}?total={{$total}}">去结账</a>
        </div>
    </div>
    <!-- end cart -->
@endsection