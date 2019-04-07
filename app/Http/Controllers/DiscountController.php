<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Discount;
use \App\User;
class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        foreach ($discounts as &$discount) {
            $discount['user'] = User::find($discount['user_id']);
        }
        return $discounts;
    }
    public function create(Request $request)
    {
        \Auth::user()->discounts()->create(["delivery" => $request->delivery]);
        return [
            "success" => true
        ];
    }
}
