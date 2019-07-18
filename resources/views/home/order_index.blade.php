@extends('layout.common')
@section('title','保存订单页')
@section('pages section')
    <div class="checkout pages section">
        <div class="container">
            <div class="pages-head">
                <h3>CHECKOUT</h3>
            </div>
            <div class="checkout-content">
                <div class="row">
                    <div class="col s12">
                        <ul class="collapsible" data-collapsible="accordion">
                            <li>

                                <div class="collapsible-header"><h5>5 - Order Review</h5></div>
                                <div class="collapsible-body">
                                    <div class="order-review">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="cart-details">
                                                    <div class="col s5">
                                                        <div class="cart-product">
                                                            @foreach($obj as $v)
                                                            <h5><img src="{{$v->goods_pic}}" alt=""></h5>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col s7">
                                                        <div class="cart-product">
                                                            <img src="img/shop1.png" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="cart-details">
                                                    <div class="col s5">
                                                        <div class="cart-product">
                                                            @foreach($obj as $v)
                                                            =={{$v->goods_name}}==
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-review final-price">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="cart-details">
                                                    <div class="col s8">
                                                        <div class="cart-product">
                                                            <h5>总价</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col s4">
                                                        <div class="cart-product">
                                                            <span>{{$total}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <a href="{{url('home/order_create')}}?total={{$total}}" class="btn button-default button-fullwidth">结算</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection