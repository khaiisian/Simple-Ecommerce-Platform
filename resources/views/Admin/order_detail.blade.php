<x-app-layout>
    @php
    $order = $orders[0];
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Detail Page') }}
        </h2>
    </x-slot>
    <div class="max-w-lg py-8 mt-6 mx-auto bg-white rounded-xl">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center py-4 border-b-4 border-dotted">
            Order Detail
        </h2>
        <div class="grid grid-cols-[30%_25%_10%_25%] gap-x-4 gap-y-5 px-3 border-b-4 border-dotted pb-4 pt-2">
            <div class="text-center font-bold">Item Name</div>
            <div class="text-center font-bold">Price</div>
            <div class="text-center font-bold">Quantity</div>
            <div class="text-center font-bold">Sub Total</div>
            @php
            $total=0;
            @endphp
            @foreach ($order->item as $item)
            <div class="text-center">{{ $item->item_name }}</div>
            <div class="text-center">{{ $item->item_price }}</div>
            <div class="text-center">{{ $item->pivot->quantity }}</div>
            <div class="bg-gray-100 text-center">{{ $item->item_price * $item->pivot->quantity }}</div>
            @php
            $total+=$item->item_price * $item->pivot->quantity
            @endphp
            @endforeach
        </div>
        <diiv class="grid grid-cols-[70%_25%] gap-x-4 gap-y-5 px-3 pb-4 pt-2">
            <div class="font-semibold pl-6">Total</div>
            <div class="bg-gray-100 text-center">{{ $total }}</div>
        </diiv>
    </div>
</x-app-layout>