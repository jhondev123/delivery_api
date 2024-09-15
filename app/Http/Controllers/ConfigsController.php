<?php

namespace App\Http\Controllers;

use App\Facades\DbConfig;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    public function index()
    {
        return response()->json([
            'delivery_fee' => DbConfig::get('delivery_fee'),
            'minimum_order' => DbConfig::get('minimum_order'),
            'max_distance_for_delivery' => DbConfig::get('max_distance_for_delivery'),
        ]);
    }
    public function setDeliveryFee(Request $request)
    {
        DbConfig::set('delivery_fee', $request->delivery_fee);
        return response()->json(['message' => 'Delivery fee updated']);
    }
    public function setMinimumOrder(Request $request)
    {
        DbConfig::set('minimum_order', $request->minimum_order);
        return response()->json(['message' => 'Minimum order updated']);
    }
    public function setMaxDistanceForDelivery(Request $request)
    {
        DbConfig::set('max_distance_for_delivery', $request->max_distance_for_delivery);
        return response()->json(['message' => 'Max distance for delivery updated']);
    }
}
