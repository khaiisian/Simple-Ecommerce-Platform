<x-app-layout>
    @section('extra-links')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Item Management Page') }}
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
    <form action="/admin/item/create" method="POST" enctype="multipart/form-data"
        class="w-[30%] mx-auto bg-white mt-10 rounded-lg flex flex-col justify-center px-10 py-5">

        <h2 class="text-2xl font-bold text-center my-4 mb-9">Item Create Form</h2>
        @csrf
        <label for="item_name">Item Name</label>
        <input type="text" name="item_name" id="item_name" class="rounded-lg border-gray-300 mb-5">

        <label for="item_desc">Item Description</label>
        <input type="text" name="item_desc" id="item_desc" class="rounded-lg border-gray-300 mb-5">

        <label for="item_price">Item Price</label>
        <input type="number" name="item_price" id="item_price" class="rounded-lg border-gray-300 mb-5">

        <label for="item_image">Item Image</label>
        <input type="file" accept="image/*" name="item_image" id="item_image" class=" mb-5">

        <label for=" stock">Stock</label>
        <input type="number" name="stock" id="stock" class="rounded-lg border-gray-300 mb-5">

        {{-- {{ $categories }} --}}
        <label for="category">Category</label>
        <select name="category" id="category" class="rounded-lg border-gray-300 mb-5">
            @foreach ($categories as $category)
            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>

        <button type="submit"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 my-8 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>

    </form>

    <div class="tbl max-w-7xl mx-auto mt-32">
        <table id="data_tbl" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Item Description</th>
                    <th>Item Price</th>
                    <th>Item Image</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->item_id }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->item_desc }}</td>
                    <td>{{ $item->item_desc }}</td>
                    <td><img class="w-14 h-14" src="{{asset('storage/images/'. $item->image )}}" alt=""></td>
                    <td>
                        <?php
                        foreach ($categories as $category) {
                            if ($category->category_id==$item->category_id) {
                                echo $category->category_name;
                            }
                        }
                    ?>
                    </td>
                    <td class="w-fit ">
                        <div class="flex justify-center gap-x-2">
                            <form action="{{ route('admin.item.edit', ['id'=>$item->item_id]) }}">
                                <button type="submit"
                                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Edit</button>
                            </form>

                            <form action="{{ route('admin.item.destroy', ['id'=>$item->item_id]) }}">
                                <button type="submit"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>

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