<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function getStocks(Request $request)
    {
        $username = $request->session()->get('user');
        $userType = $request->session()->get('type');
        $userId = $this->getUserIdFromUsername($username);
        $stocks = DB::select('select * from stocks WHERE outlet_id IN (SELECT outlet_id FROM outlets WHERE owner_id = ?) ORDER BY id DESC', [$userId]);


        if (empty($username) || $userType != 'owner') {
            return redirect('/login');
        } else {
            return view('stocks', ['stocks'=>$stocks, 'userType'=>$userType]);
        }
    }

    public function addStock(Request $request)
    {
        $username = $request->session()->get('user');
        $userId = $this->getUserIdFromUsername($username);
        $outlets = DB::select('select * from outlets WHERE owner_id = ? ORDER BY id DESC', [$userId]);

        if (empty($username)) {
            return redirect('/login');
        } else {
            return view('add-stock', ['outlets'=>$outlets]);
        }
    }

    public function getStock(Request $request, $outlet)
    {

        $prices = DB::select('select * from stocks WHERE outlet_id = ?', [$outlet]);

        if (!empty($prices) && is_array($prices) && count($prices) > 0) {
            return response()->json([
                'large' => $prices[0]->large,
                'medium' => $prices[0]->medium,
                'small' => $prices[0]->small
            ]);
        } else {
            return response()->json([
                'large' => 0,
                'medium' => 0,
                'small' => 0
            ]);
        }

    }


    public function updateStock(Request $request)
    {
        $username = $request->session()->get('user');
        $outlet = $request->input('outlet');

        if (empty($username)) {
            return redirect('/login');
        } else {
            $errors = $this->validateStocks($request);
            $msgs = [];

            if (count($errors) > 0) {
                $userId = $this->getUserIdFromUsername($username);
                $outlets = DB::select('select * from outlets WHERE owner_id = ? ORDER BY id DESC', [$userId]);

                if (!empty($prices) && is_array($prices) && count($prices) > 0) {
                    return view('add-stock', ['errors'=>$errors, 'outlets'=>$outlets]);
                } else {
                    return view('add-stock', ['errors'=>$errors, 'outlets'=>$outlets]);
                }
            } else {
                $large = $request->input('large');
                $medium = $request->input('medium');
                $small = $request->input('small');

                DB::table('stocks')->upsert(    [
                    ['large' => $large, 'medium' => $medium, 'small' => $small, 'outlet_id'=>$outlet]],
                    ['outlet_id'],
                    ['large', 'medium', 'small', 'outlet_id']);

                array_push($msgs, "Stocks Updated");

                $userId = $this->getUserIdFromUsername($username);
                $outlets = DB::select('select * from outlets WHERE owner_id = ? ORDER BY id DESC', [$userId]);
                if (!empty($prices) && is_array($prices) && count($prices) > 0) {
                    return view('add-stock', ['msgs'=>$msgs, 'errors'=>$errors, 'outlets'=>$outlets]);
                } else {
                    return view('add-stock', ['msgs'=>$msgs, 'outlets'=>$outlets]);
                }
            }
        }

    }

    public function getUserIdFromUsername($username) {
        $users = DB::select('select user_id from user_credentials WHERE username = ?', [$username]);

        if (!empty($users) && is_array($users) && count($users) > 0) {
            $user= $users[0];
            return $user->user_id;
        } else {
            return null;
        }
    }

    private function validateStocks(Request $request) {
        $errors = [];

        $large = $request->input('large');
        $medium = $request->input('medium');
        $small = $request->input('small');


        if (empty($large)) {
            array_push($errors, "Large Cylinder stock cannot be blank");
        }

        if (empty($medium)) {
            array_push($errors, "Medium Cylinder stock cannot be blank");
        }

        if (empty($small)) {
            array_push($errors, "Small Cylinder stock cannot be blankk");
        }

        return $errors;
    }
}
