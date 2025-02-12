<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // return view('profile.edit');
        //
        // dd($request->all());
        $request->validate([
            'payment_type' => 'required:integer',
            'cart_items' => 'required|array',
            'cart_items.*.item_id' => 'required|integer|exists:items,item_id',
            'cart_items.*.quantity' => 'required|integer|min:1',
            'cart_items.*.price' => 'required:numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'payment_type_id' => $request->payment_type,
            ]);

            $itemsData = [];
            foreach ($request->cart_items as $item) {
                $itemsData[$item['item_id']] = [
                    'quantity' => $item['quantity'],
                    'total_price' => $item['price'],
                ];
            }

            $order->item()->attach($itemsData);
            DB::commit();
            session()->forget('cart');
            return redirect()->route('user.item')->with('message', value: 'message successful');
        } catch (\Exception $ex) {
            DB::rollBack();
            // return redirect()->back()->with([
            //     'error' => $ex->getMessage(),
            //     'msg' => 'failed',
            // ]);
            // return redirect()->route('/profile');
            return redirect()->route('user.item')->with('error', value: $ex->getMessage());

        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}