@extends('frontend.layouts.master')
@section('breadcrumb')

@endsection

@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <form id="checkout-form" class="clearfix" action="" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="order-summary clearfix">
                            <div class="section-title">
                                <h3 class="title">Thông tin giỏ hàng</h3>
                            </div>
                            <table class="shopping-cart-table table">
                                <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th></th>
                                    <th class="text-center">Giá tiền</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Thành tiền</th>
                                    <th class="text-right"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td class="thumb"><img src="/storage/{{ $item->option->image }}" alt=""></td>
                                    <td class="details">
                                        <a href="#">{{ $item->name }}</a>
                                    </td>
                                    <td class="price text-center"><strong>{{ $item->price }}đ</strong><br>
                                        @if($item->discount_percent != 0)<del class="font-weak"><small>$40.00</small></del>@endif
                                    </td>
                                    <td class="qty text-center"><input class="input" type="number" value="{{ $item->qty }}"></td>
                                    <td class="total text-center"><strong class="primary-color">{{ $item->price * $item->qty }}đ</strong></td>
                                    <td class="text-right"><a><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></a></td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Tổng tiền</th>
                                    <th colspan="2" class="total"></th>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="pull-right">
                                <button class="primary-btn" type="submit">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
