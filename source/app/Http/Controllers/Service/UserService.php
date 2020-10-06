<?php

namespace App\Http\Controllers\Service;

use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserService extends Controller
{
    private $orderService;
    public function __construct(OrderRepository $orderService)
    {
        $this->orderService = $orderService;
    }
    // Find / list user
    public function find(Request $request) {
        $query = User::where('id' , '>' ,0);
        $userPerPage = $request->has('page_size') ? $request['page_size'] : 15;
        $this->buildQuery($query, $request);
        $users = $query->paginate($userPerPage);
        return $users;
    }

    // Create User
    public function create(Request $request) {
        // Validate user create input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // If validation fail, return fail message
        if ($validator->fails()) {
            return response()->json(
                [
                    "title" => "Please check your fields",
                    "status" => "error",
                    "message" => $validator->messages(),
                ]
            ,200);
        }

        // Create an user and return that user
        $length = 32;
        $user = new User($request->all());
        $user->password = bcrypt($request['password']);
        $user->api_token = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        $user->save();

        // Return success message
        return response()->json(
            [
                "title" => "Create user successful",
                "status" => "success",
                "message" => $user,
            ]
        );

    }

    // Show info of one user
    public function index($user){
        $user = User::find($user);
        if($user){
            return response()->json(
                [
                    "status" => "success",
                    "message" => $user,
                ]
            );
        } else {
            return response()->json(
                [
                    "status" => "error",
                    "message" => "Can not find that user",
                ]
            );
        }
    }

    // Update an user
    public function update($user, Request $request) {
        // Find that user
        $user = User::find($user);
        if(!$user){
            return response()->json(
                [
                    "status" => "error",
                    "message" => "Can not find that user",
                ]
            );
        }

        // Validate user update input
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'password' => 'string|min:6',
        ]);

        // If validation fail, return fail message
        if ($validator->fails()) {
            return response()->json(
                [
                    "status" => "error",
                    "message" => $validator->messages(),
                ]
            ,200);
        }

        // Update that user
        $user->update($request->all());
        if($request->has('password')){
            $user->password = bcrypt($request['password']);
        }
        $user->save();

        // Return success message
        return response()->json(
            [
                "title" => "",
                "status" => "success",
                "message" => $user,
            ]
        );
    }

    // Delete an user
    public function delete($user, Request $request) {
        // Find that user
        $user = User::find($user);
        if(!$user){
            return response()->json(
                [
                    "status" => "error",
                    "message" => "Can not find that user",
                ]
            );
        }

        // Delete that user
        $user->delete();

        // Return success message
        return response()->json(
            [
                "status" => "success",
                "message" => "Delete successful",
            ]
        );

    }


    // Filter
    private function buildQuery($query, Request $request) {
        if($request->has('name')){
            $query->where('name', 'LIKE', '%' . $request['name'] . '%');
        }
        if($request->has('email')){
            $query->where('email', 'LIKE', '%' . $request['email'] . '%');
        }
        if($request->has('status')){
            $query->where('status', '=', $request['status']);
        }
    }

    public function getUserInfo () {
        $user = Auth::user();
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'total_earned' => $this->getTotalEarned($user->id),
            'cash_back_pending' => $this->getCashBackPending($user->id)
        ];
        return response()->json([
            'status' => 'successful',
            'data' => $data
        ]);
    }

    private function getTotalEarned ($userId) {
        $totalEarn = 0;
        $orders = $this->orderService->query([
            'is_order_earned' => 1,
            'user_id' => $userId
        ])->get();
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $totalEarn += $order->cash_back_amount;
            }
        }
        return $totalEarn;
    }

    private function getCashBackPending ($userId) {
        $totalEarn = 0;
        $orders = $this->orderService->query([
            'is_order_pending' => 1,
            'user_id' => $userId
        ])->get();
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $totalEarn += $order->cash_back_amount;
            }
        }
        return $totalEarn;
    }
}
