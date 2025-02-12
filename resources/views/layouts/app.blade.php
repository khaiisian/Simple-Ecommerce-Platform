<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('CSS/extra-css.css') }}">
    @yield('extra-links')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}


            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
            <div id="cart_div"
                class="bg-gray-200 fixed w-[500px] h-screen top-0 right-[-500px] pt-[50px] px-5 text-white transition-right duration-500">
                <div class="flex justify-between">
                    <h2 class="text-2xl text-black font-bold">Shopping Cart</h2>
                    <button onclick="CloseCart()"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                            fill="black" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                            <path
                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
                        </svg></button>
                </div>
                <hr class="bg-black h-[1px] border-0 mt-2">
                <form action="{{route('user.order')}}" method="POST">
                    @csrf
                    @if(session('error'))
                    <p>{{ session('error') }}</p>
                    @endif
                    <div id="cartItem_div">
                        {{-- @if (!empty($cart))
                        @php
                        $count=0;
                        @endphp
                        @foreach ($cart['cart'] as $item)
                        <div
                            class="w-full grid grid-cols-[8%_45%_10%_20%] gap-3 mb-3 text-gray-800 text-sm border-b border-gray-600 py-3">
                            <div class="">
                                <p>{{ ++$count }}
                            </div>
                            <div class="">
                                <p>{{ $item['item_name'] }}
                            </div>
                            <div class="">
                                <p>{{ $item['quantity'] }}
                            </div>
                            <div class="">
                                <p>{{ $item['total_price'] }}
                            </div>
                            <div class="">

                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>Your cart is empty.</p>
                        @endif --}}
                    </div>
                    <div id="payment_content" class="hidden">
                        @yield('payment_div')
                    </div>
                    <div id="payment_section"></div>
                </form>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            update_cart();
            OpenCart=()=>{
                $('#cart_div').css('right', '0');
            }

            CloseCart=()=>{
                $('#cart_div').css('right', '-500px');
            }

            
            $('#cart_btn').click(function (e) {
                OpenCart();

                $.ajax({
                    type: "GET",
                    url: "/user/get-cart",
                    success: function (response) {
                        let cart_lst=response.cart_lst;
                        console.log('cart_lst',cart_lst)
                        if(cart_lst.length==0){
                            console.log('no data');
                        }
                        console.log(response.msg)
                    }
                });                
            });

            $(document).on('click', '.remove_cart',function () {
                let itemId = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "/user/remove-cart",
                    data: {
                        _token: '{{ csrf_token() }}',
                        item_id: itemId
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response.msg);
                        update_cart();
                    }
                });    
            });

            $('#add_cart_btn').click(function (e) { 
                update_cart();
                console.log('hello')
            });
        });

        $(document).on('click', '.add_cart_btn', function () {
            console.log('from app')
            update_cart();
            simple();
        });

        function simple(){
            console.log('hello');
        }

        function update_cart(){
            $.ajax({
                type: "GET",
                url: "/user/get-cart",
                success: function (response) {
                    let cart_lst = response.cart_lst;
                    let cartItem=cart_lst.cart;
                    console.log(cart_lst)
                    // console.log('cart_lsttttttttttttt',cartItem)
                    if(!cart_lst.cart||cart_lst.cart.length==0){
                        $('#payment_section').html('');
                        $('#cartItem_div').html('<p class="text-black">There is no item in the cart</p>');
                    } else {
                        console.log('cart exists')                        
                        $('#payment_section').html($('#payment_content').html());
                        
                        // $('#payment_section').html('item exists');
                        let count = 0;
                        let cartHtml='';
                        cartItem.forEach((item, index) => {
                            count++;
                            cartHtml += `
                            <div
                            class="w-full grid grid-cols-[8%_40%_10%_20%_15%] gap-3 mb-3 text-gray-800 text-sm border-b border-gray-600 py-3">
                            <div class="">
                                <p>${count}
                            </div>
                            <input type="hidden" name="cart_items[${index}][item_id]" value="${item.item_id}">
                            <div class="">
                                ${item.item_name}
                            </div>
                            <div class="">
                                <input type="hidden" name="cart_items[${index}][quantity]" value="${item.quantity}">
                                ${item.quantity}
                            </div>
                            <div class="">
                                <input type="hidden" name="cart_items[${index}][price]" value="${item.total_price}">
                                ${item.total_price}
                            </div>
                            <div class="remove_cart flex items-center justify-center" data-id="${item.item_id}">
                                <button onclick=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
</svg></button>
                            </div>
                        </div>
                            `;
                        })                  
                    
                        $('#cartItem_div').html(cartHtml);
                    }
                }
            });
        }
    </script>
    @yield('extra-scripts')
</body>

</html>