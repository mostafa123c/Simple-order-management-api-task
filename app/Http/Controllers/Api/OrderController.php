<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\OrderCollection
     */
    public function index(Request $request)
    {
        $query = Order::with('customer');

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        return response()->json(OrderResource::pagination($orders));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreOrderRequest $request
     * @return \App\Http\Resources\OrderResource
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => OrderResource::item($order->load('customer'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateOrderRequest $request
     * @param \App\Models\Order $order
     * @return \App\Http\Resources\OrderResource
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        return response()->json([
            'success' => $order->update($request->validated()),
            'data' => OrderResource::item($order->load('customer'))
        ]);
    }

    /**
     * Get order statistics.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        $stats = [
            'total_revenue' => Order::sum(DB::raw('price * quantity')),
            'total_orders' => Order::count(),
            'status_counts' => Order::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get()
                ->pluck('count', 'status')
        ];

        return response()->json($stats);
    }
}