<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function newOrder(Request $request)
    {
        $username = $request->session()->get('user');
        $outlets = DB::select('select * from outlets ORDER BY id DESC');

        if (empty($username)) {
            return redirect('/login');
        } else {
            return view('new-order', ['outlets'=>$outlets]);
        }
    }


    public function orderHistory(Request $request)
    {
        $username = $request->session()->get('user');
        $userType = $request->session()->get('type');
        $userId = $this->getUserIdFromUsername($request);

        if ($userType == 'customer') {
            $orders = DB::select('select * from orders WHERE customer_id = ? ORDER BY id DESC', [$userId]);
        } else if ($userType == 'owner') {
            $orders = DB::select('select * from orders WHERE outlet_id IN (SELECT outlet_id FROM outlets WHERE owner_id = ?) ORDER BY id DESC', [$userId]);
        } else {
            $orders = [];
        }
        
        if (empty($username)) {
            return redirect('/login');
        } else {
            return view('orders', ['orders'=>$orders, 'userType'=>$userType]);
        }
    }

    public function createOrder(Request $request)
    {
        $username = $request->session()->get('user');

        if (empty($username)) {
            return redirect('/login');
        } else {
            $errors = $this->validateOrder($request);
            $outlets = DB::select('select * from outlets ORDER BY id DESC');
            $msgs = [];

            if (count($errors) > 0) {
                return view('new-order', ['errors'=>$errors, 'outlets'=>$outlets]);
            } else {
                $large = empty($request->input('large')) ? 0 : $request->input('large');
                $medium = empty($request->input('medium')) ? 0 : $request->input('medium');
                $small = empty($request->input('small')) ? 0 : $request->input('small');
                $orderValue = $request->input('orderValue');
                $outletId = $request->input('outlet');
                $customerId = $this->getUserIdFromUsername($request);

                DB::table('orders')->insertGetId([
                    'large_qty' => $large,
                    'medium_qty' => $medium,
                    'small_qty' => $small,
                    'outlet_id' => $outletId,
                    'customer_id' => $customerId,
                    'created_at' =>  date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'order_date' => date('Y-m-d H:i:s'),
                    'order_value' => $orderValue ,
                ]);

                array_push($msgs, "Order created");

                return view('new-order', ['msgs'=>$msgs, 'outlets'=>$outlets]);
            }
        }

    }

    private function validateOrder(Request $request) {
        $errors = [];

        $large = $request->input('large');
        $medium = $request->input('medium');
        $small = $request->input('small');

        if (empty($large) && empty($medium) && empty($small)) {
            array_push($errors, "Small, Medium or Large quantity is required");
        }

        return $errors;
    }

    private function getUserIdFromUsername(Request $request) {
        $username = $request->session()->get('user');

        $users = DB::select('select user_id from user_credentials WHERE username = ?', [$username]);

        if (!empty($users) && is_array($users) && count($users) > 0) {
            $user_id = $users[0]->user_id;
            return $user_id;
        } else {
            return null;
        }
    }
}
