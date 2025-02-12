<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item Edit') }}
        </h2>

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

        {{ $item }}
        {{ $item->item_name }}


        <form action="{{route('admin.item.update')}}" method="POST" enctype="multipart/form-data"
            class="w-[30%] mx-auto bg-white mt-10 rounded-lg flex flex-col justify-center px-10 py-5">

            <h2 class="text-2xl font-bold text-center my-4 mb-9">Item Update Form</h2>
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->item_id }}">
            <label for="item_name">Item Name</label>
            <input type="text" name="item_name" id="item_name" class="rounded-lg border-gray-300 mb-5"
                value="{{ $item->item_name }}">

            <label for="item_desc">Item Description</label>
            <input type="text" name="item_desc" id="item_desc" class="rounded-lg border-gray-300 mb-5"
                value="{{ $item->item_desc }}">

            <label for=" item_price">Item Price</label>
            <input type="number" name="item_price" id="item_price" class="rounded-lg border-gray-300 mb-5"
                value="{{ $item->item_price }}">

            <label for=" item_image">Item Image</label>
            <div class="w-28 h-28 bg-red-300 mb-2">
                <img src="{{ Storage::url('images/'.$item->image) }}" alt="{{ $item->image }}" class="w-full h-full">
            </div>
            <p class="text-yellow-700">Previously Selected Image</p>
            <input type="file" accept="image/*" name="item_image" id="item_image" class=" mb-5">

            <label for=" stock">Stock</label>
            <input type="number" name="stock" id="stock" class="rounded-lg border-gray-300 mb-5"
                value="{{ $item->stock }}">

            {{-- {{ $categories }} --}}
            <label for="category">Category</label>
            <select name="category" id="category" class="rounded-lg border-gray-300 mb-5">
                @foreach ($categories as $category)
                <option value="{{ $category->category_id }}" <?php if ($item->category_id==$category->category_id)
                    echo 'selected' ?>>{{ $category->category_name }}</option>
                @endforeach
            </select>

            <button type="submit"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 my-8 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update</button>

        </form>
    </x-slot>
</x-app-layout>