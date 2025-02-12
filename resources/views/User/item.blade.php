<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item Lists') }}
        </h2>
    </x-slot>


    @if ($errors->any())
    <script>
        const errors = @json($errors->all());
    let errorMessage = "Validation Errors:\n";
    errors.forEach(error => {
        errorMessage += `- ${error}\n`;
    });
    alert(errorMessage);
    </script>
    @endif


    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    {{-- {{ $items }} --}}
    <div
        class="max-w-7xl min-h-screen grid grid-cols-4 justify-start items-center flex-wrap gap-x-6 gap-y-14 mx-auto mt-8">

        @foreach ($items as $item)
        <div
            class="w-[100%] h-[28rem] bg-white border border-gray-300 rounded-lg flex flex-col justify-center items-center py-4">
            <div class="w-[65%] h-[45%] flex items-center">
                <img src="{{ asset('storage/images/'.$item->image) }}" alt="{{$item->image}}">
            </div>
            <p class="mt-10">{{ $item->item_name }}</p>
            <p class="mt-2">{{ $item->item_price }} Kyats</p>
            <div class="flex justify-center items-center mt-4">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Details</button>

                <button type="button" data-id="{{$item->item_id}}"
                    class="add_cart_btn focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add
                    to Cart</button>
            </div>
        </div>
        @endforeach
    </div>

    @section('payment_div')
    <div class="w-[70%]">
        <select id="payment_type" name="payment_type"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option selected>Choose a Payemnt method</option> @foreach ($payment_types as $type)
            <option value="{{$type->payment_type_id}}">{{ $type->payment_type_name}}</option>
            @endforeach
        </select>

        <button type="submit" data-id="order_btn"
            class="mt-6 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add
            to Cart</button>
    </div>
    @endsection
</x-app-layout>
<script>
    $(document).ready(function () {
        console.log()
            const item_lst = @json($items);
            console.log(item_lst[0])

            $('.add_cart_btn').click(function (e) { 
                let id = $(this).data('id');
                console.log('data-id', id)
                let items = item_lst.filter(x=>x.item_id==id);
                console.log(items);

                const item = items[0];

                $.ajax({
                    type: "POST",
                    url: "/user/add-to-cart",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cartItem: item,
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response.msg)
                        console.log('success')
                    }
                });
                // update_cart();
            });
        });
</script>