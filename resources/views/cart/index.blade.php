<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.9/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

@extends('layouts.app')

@section('css-files')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        @include('helpers.flash-messages')
        <div class="cart_section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="cart_container">
                            <div class="cart_title">Koszyk<small> ({{ $cart->getItems()->count() }}) </small></div>
                            <form action="{{ route('orders.store') }}" method="POST" id="order-form">
                                @csrf
                                <div class="cart_items">
                                    <ul class="cart_list">
                                        @foreach($cart->getItems() as $item)
                                            <li class="row text-center justify-content-center cart_item clearfix align-items-center">
                                                <div class="col-md-2">
                                                    <img src="{{ $item->getImage() }}" class="img-fluid mx-auto d-block" alt="Zdjęcie produktu">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="cart_item_title">Nazwa</div>
                                                    <div class="cart_item_text">{{ $item->getName() }}</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="cart_item_title">Ilość</div>
                                                    <div class="cart_item_text">{{ $item->getQuantity() }}</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="cart_item_title">Cena [PLN]</div>
                                                    <div class="cart_item_text">{{ $item->getPrice() }}</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="cart_item_title">Suma [PLN]</div>
                                                    <div class="cart_item_text">{{ $item->getSum() }}</div>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $item->getProductId() }}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="order_total">
                                    <div class="order_total_content text-md-right">
                                        <div class="order_total_title">Suma [PLN]:</div>
                                        <div class="order_total_amount">{{ $cart->getSum() }}</div>
                                    </div>
                                </div>
                                <div class="cart_buttons">
                                    <a href="/" class="button cart_button_clear">Wróć do sklepu</a>
                                    <button type="submit" class="button cart_button_checkout" {{ !$cart->hasItems() ? 'disabled' : '' }}>Zapłać Przelewy24</button>
                                </div>
                            </form>
                            <form action="/session" method="POST" style="text-align: right;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="button cart_button_checkout" id="checkout-live-button">Zapłać Stripe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    const deleteUrl = "{{ url('cart') }}/";
    const confirmDelete = "{{ __('shop.messages.delete_confirm') }}";
@endsection
@section('js-files')
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection