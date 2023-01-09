<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutletController extends Controller
{
    public function index(Request $request)
    {

        $username = $request->session()->get('user');
        $userType = $request->session()->get('type');

        if ($userType == 'owner') {
            $user_id = $this->getUserIdFromUsername($request);
            $errors = [];

            if (empty($username)) {
                return redirect('/login');
            } else {
                $outlets = DB::select('select * from outlets WHERE owner_id = ? ORDER BY id DESC', [$user_id]);

                if (!empty($outlets) && is_array($outlets) && count($outlets) > 0) {
                    return view('outlets', ['outlets'=>$outlets, 'userType'=>$userType]);
                } else {
                    array_push($errors, "No outlets found");
                    return view('outlets', ['errors'=>$errors, 'userType'=>$userType]);
                }
            }
        } else if ($userType == 'customer') {
            $errors = [];

            if (empty($username)) {
                return redirect('/login');
            } else {
                $outlets = DB::select('select * from outlets ORDER BY id DESC');

                if (!empty($outlets) && is_array($outlets) && count($outlets) > 0) {
                    return view('outlets', ['outlets'=>$outlets, 'userType'=>$userType]);
                } else {
                    array_push($errors, "No outlets found");
                    return view('outlets', ['errors'=>$errors, 'userType'=>$userType]);
                }
            }
        }

    }

    public function addOutlet(Request $request)
    {
        $username = $request->session()->get('user');

        if (empty($username)) {
            return redirect('/login');
        } else {
            return view('add-outlet');
        }
    }

    public function createOutlet(Request $request)
    {
        $username = $request->session()->get('user');

        if (empty($username)) {
            return redirect('/login');
        } else {
            $errors = $this->validateOutlet($request);
            $msgs = [];

            if (count($errors) > 0) {
                return view('add-outlet', ['errors'=>$errors]);
            } else {
                $name = $request->input('name');
                $address = $request->input('address');
                $tel = $request->input('telephone');
                $lan = $request->input('lan');
                $lat = $request->input('lat');
                $isDeliveryAvail = $request->input('isDeliveryAvailable');
                $user_id = $this->getUserIdFromUsername($request);

                DB::table('outlets')->insertGetId([
                    'name' => $name,
                    'address' => $address,
                    'tel' => $tel,
                    'lan' => $lan,
                    'lat' => $lat,
                    'is_delivery_avail' => $isDeliveryAvail,
                    'created_at' =>  date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'owner_id' => $user_id,
                    'small' => 0,
                    'medium' => 0,
                    'large' => 0,
                ]);

                array_push($msgs, "Outlet created");

                return view('add-outlet', ['msgs'=>$msgs]);
            }
        }

    }

    public function changePrice(Request $request, $outlet)
    {
        $username = $request->session()->get('user');

        if (empty($username)) {
            return redirect('/login');
        } else {
            $prices = DB::select('select * from prices WHERE outlet_id = ?', [$outlet]);

            if (!empty($prices) && is_array($prices) && count($prices) > 0) {
                return view('change-price', ['outlet'=>$outlet, 'large'=>$prices[0]->large, 'medium'=>$prices[0]->medium, 'small'=>$prices[0]->small]);
            } else {
                return view('change-price', ['outlet'=>$outlet, 'large'=>0, 'medium'=>0, 'small'=>0]);
            }

        }
    }

    public function getPrices(Request $request, $outlet)
    {

    $prices = DB::select('select * from prices WHERE outlet_id = ?', [$outlet]);

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


    public function updatePrice(Request $request)
    {
        $username = $request->session()->get('user');
        $outlet = $request->input('outlet');

        if (empty($username)) {
            return redirect('/login');
        } else {
            $errors = $this->validatePrices($request);
            $msgs = [];

            if (count($errors) > 0) {
                $prices = DB::select('select * from prices WHERE outlet_id = ?', [$outlet]);
                if (!empty($prices) && is_array($prices) && count($prices) > 0) {
                    return view('change-price', ['errors'=>$errors, 'outlet'=>$outlet, 'large'=>$prices[0]->large, 'medium'=>$prices[0]->medium, 'small'=>$prices[0]->small]);
                } else {
                    return view('change-price', ['errors'=>$errors, 'outlet'=>$outlet, 'large'=>0, 'medium'=>0, 'small'=>0]);
                }
            } else {
                $large = $request->input('large');
                $medium = $request->input('medium');
                $small = $request->input('small');

                DB::table('prices')->upsert(    [
                    ['large' => $large, 'medium' => $medium, 'small' => $small, 'outlet_id'=>$outlet]
                ],
                ['outlet_id'],
                ['large', 'medium', 'small', 'outlet_id']);

                array_push($msgs, "Prices Updated");

                $prices = DB::select('select * from prices WHERE outlet_id = ?', [$outlet]);
                if (!empty($prices) && is_array($prices) && count($prices) > 0) {
                    return view('change-price', ['msgs'=>$msgs, 'errors'=>$errors, 'outlet'=>$outlet, 'large'=>$prices[0]->large, 'medium'=>$prices[0]->medium, 'small'=>$prices[0]->small]);
                } else {
                    return view('change-price', ['msgs'=>$msgs, 'outlet'=>$outlet, 'large'=>0, 'medium'=>0, 'small'=>0]);
                }
            }
        }

    }

    private function validateOutlet(Request $request) {
        $errors = [];

        $name = $request->input('name');
        $address = $request->input('address');
        $tel = $request->input('telephone');
        $lan = $request->input('lan');
        $lat = $request->input('lat');
        $isDeliveryAvail = $request->input('isDeliveryAvailable');

        if (empty($name)) {
            array_push($errors, "Name cannot be blank");
        }

        if (empty($address)) {
            array_push($errors, "Address cannot be blank");
        }

        if (empty($tel)) {
            array_push($errors, "Telephone cannot be blank");
        } else if(!preg_match('/^[0-9]{10}+$/', $tel)) {
            array_push($errors, "Invalid Telephone number");
        }


        return $errors;
    }

    private function validatePrices(Request $request) {
        $errors = [];

        $large = $request->input('large');
        $medium = $request->input('medium');
        $small = $request->input('small');


        if (empty($large)) {
            array_push($errors, "Large Cylinder price cannot be blank");
        }

        if (empty($medium)) {
            array_push($errors, "Medium Cylinder price cannot be blank");
        }

        if (empty($small)) {
            array_push($errors, "Small Cylinder price cannot be blankk");
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
