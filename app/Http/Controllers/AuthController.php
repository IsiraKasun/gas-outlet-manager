<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function index(Request $request)
    {

        $username = $request->session()->get('user');

        if (empty($username)) {
            return redirect('/login');
        } else {
            return view('customer-home');
        }
    }

    public function loginPage()
    {
        $errors = [];
        $msgs = [];
        return view('auth.login', ['errors'=>$errors, 'msgs'=>$msgs]);
    }

    public function signupPage()
    {
        return view('auth.signup');
    }

    public function login(Request $request)
    {
        $errors = [];
        $username = $request->input('username');
        $password = $request->input('password');

        $users = DB::select('select * from users u, user_credentials uc WHERE uc.username = ? AND uc.password = ? AND u.id = uc.user_id', [$username, hash('sha256', $password)]);

        if (!empty($users) && is_array($users) && count($users) > 0) {
            $user = $users[0];
            $userType = $user->user_type;
            $fullName = $user->first_name . ' ' . $user->last_name;

            $request->session()->put('user', $username);
            $request->session()->put('type', $userType);

            if ($userType === 'customer') {
                return view('customer-home',  ['fullName'=>$fullName, 'errors'=>$errors]);
            } else if ($userType === 'owner') {
                return view('outlet-home',  ['fullName'=>$fullName, 'errors'=>$errors]);
            } else if ($userType === 'admin') {
                return view('admin-home',  ['fullName'=>$fullName, 'errors'=>$errors]);
            }

        } else {
            array_push($errors, "Username or passowrd is incorrect");
            return view('auth.login', ['errors'=>$errors]);
        }
    }

    public function signup(Request $request)
    {
        $errors = $this->validateUser($request);
        $msgs = [];

        if (count($errors) > 0) {
            return view('auth.signup', ['errors'=>$errors]);
        } else {
            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $mobile = $request->input('mobile');
            $email = $request->input('email');
            $address = $request->input('address');
            $username = $request->input('username');
            $password = $request->input('password');
            $type = $request->input('type');

            $last_id = DB::table('users')->insertGetId([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'mobile' => $mobile,
                'address' => $address,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

           DB::table('user_credentials')->insertGetId([
                'username' => $username,
                'password' => hash('sha256', $password),
                'user_type' => $type === 'customer' ? 'customer' : 'owner',
                'user_id' => $last_id,
               'created_at' =>  date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s')
            ]);


            array_push($msgs, "Account succesfully created, please login");
            return view('auth.login', ['msgs'=>$msgs]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/');
    }

    private function checkUsernameExists(Request $request) {
        $username = $request->input('username');

        $users = DB::select('select * from user_credentials WHERE username = ?', [$username]);

        if (!empty($users) && is_array($users) && count($users) > 0) {
            $user = $users[0];
            return true;
        } else {
            return false;
        }
    }

    private function checkEmailExists(Request $request) {
        $email = $request->input('email');

        $users = DB::select('select * from users WHERE email = ?', [$email]);

        if (!empty($users) && is_array($users) && count($users) > 0) {
            $user = $users[0];
            return true;
        } else {
            return false;
        }
    }

    private function checkMobileExists(Request $request) {
        $mobile = $request->input('mobile');

        $users = DB::select('select * from users WHERE mobile = ?', [$mobile]);

        if (!empty($users) && is_array($users) && count($users) > 0) {
            $user = $users[0];
            return true;
        } else {
            return false;
        }
    }

    public function getUserIdFromUsername(Request $request) {
        $username = $request->input('username');

        $users = DB::select('select user_id from user_credentials WHERE username = ?', [$username]);

        if (!empty($users) && is_array($users) && count($users) > 0) {
            $user_id = $users[0];
            return $user_id;
        } else {
            return null;
        }
    }


    private function validateUser(Request $request) {
        $errors = [];
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $mobile = $request->input('mobile');
        $email = $request->input('email');
        $address = $request->input('address');
        $username = $request->input('username');
        $password = $request->input('password');
        $passwordRepeat = $request->input('passwordRepeat');

        if (empty($firstName)) {
            array_push($errors, "First Name cannot be blank");
        }

        if (empty($lastName)) {
            array_push($errors, "Last Name cannot be blank");
        }

        if (empty($mobile)) {
            array_push($errors, "Mobile number cannot be blank");
        } else if(!preg_match('/^[0-9]{10}+$/', $mobile)) {
            array_push($errors, "Invalid Mobile number");
        }

        if (empty($email)) {
            array_push($errors, "Mobile Number cannot be blank");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is invalid");
        }

        if (empty($address)) {
            array_push($errors, "Address cannot be blank");
        }

        if (empty($username)) {
            array_push($errors, "Username cannot be blank");
        }

        if (empty($password)) {
            array_push($errors, "Password cannot be blank");
        }

        if ($this->checkUsernameExists($request)) {
            array_push($errors, "Username is already used by another user, try another username");
        }

        if ($this->checkEmailExists($request)) {
            array_push($errors, "Email is already used by another user");
        }

        if ($this->checkMobileExists($request)) {
            array_push($errors, "Mobile is already used by another user");
        }

        if ($password !== $passwordRepeat) {
            array_push($errors, "Passwords do not match");
        }

        return $errors;
    }
}
