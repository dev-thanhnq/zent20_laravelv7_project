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
                                    <th class="text-center">Tổng</th>
                                    <th class="text-right"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="thumb"><img src="./img/thumb-product01.jpg" alt=""></td>
                                    <td class="details">
                                        <a href="#">Product Name Goes Here</a>
                                        <ul>
                                            <li><span>Size: XL</span></li>
                                            <li><span>Color: Camelot</span></li>
                                        </ul>
                                    </td>
                                    <td class="price text-center"><strong>$32.50</strong><br><del class="font-weak"><small>$40.00</small></del></td>
                                    <td class="qty text-center"><input class="input" type="number" value="1"></td>
                                    <td class="total text-center"><strong class="primary-color">$32.50</strong></td>
                                    <td class="text-right"><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="thumb"><img src="./img/thumb-product01.jpg" alt=""></td>
                                    <td class="details">
                                        <a href="#">Product Name Goes Here</a>
                                        <ul>
                                            <li><span>Size: XL</span></li>
                                            <li><span>Color: Camelot</span></li>
                                        </ul>
                                    </td>
                                    <td class="price text-center"><strong>$32.50</strong></td>
                                    <td class="qty text-center"><input class="input" type="number" value="1"></td>
                                    <td class="total text-center"><strong class="primary-color">$32.50</strong></td>
                                    <td class="text-right"><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="thumb"><img src="./img/thumb-product01.jpg" alt=""></td>
                                    <td class="details">
                                        <a href="#">Product Name Goes Here</a>
                                        <ul>
                                            <li><span>Size: XL</span></li>
                                            <li><span>Color: Camelot</span></li>
                                        </ul>
                                    </td>
                                    <td class="price text-center"><strong>$32.50</strong></td>
                                    <td class="qty text-center"><input class="input" type="number" value="1"></td>
                                    <td class="total text-center"><strong class="primary-color">$32.50</strong></td>
                                    <td class="text-right"><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>Tổng tiền</th>
                                    <th colspan="2" class="total">$97.50</th>
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
