<x-app-layout>
    @section('extra-links')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Order Management Page') }}
        </h2>
    </x-slot>

    <div class="tbl max-w-5xl mx-auto mt-20">
        <table id="data_tbl" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Items</th>
                    <th>Total Price</th>
                    <th>Payment Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                @php
                $total_price=0;
                @endphp
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>
                        @foreach ($order->item as $item)
                        {{ $item->item_name }} {{ '('.$item->pivot->quantity.')' }}
                        @if (!$loop->last)
                        ,<br>
                        @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order->item as $item)
                        @php
                        $total_price+=$item->pivot->total_price;
                        @endphp
                        @if ($loop->last)
                        {{ $total_price }}
                        @endif
                        @endforeach</td>
                    <td>{{ $order->payment_type->payment_type_name }}</td>
                    <td class="w-fit ">
                        <div class="flex justify-center gap-x-2">
                            <form action="{{ route('admin.order-detail', ['id'=>$order->order_id]) }}">
                                <button type="submit"
                                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">View
                                    Detail</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @section('extra-scripts')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    @endsection

</x-app-layout>


<script>
    $(document).ready(function () {
        new DataTable('#data_tbl');
    });
</script>