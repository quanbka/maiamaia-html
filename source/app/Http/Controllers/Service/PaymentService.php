<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/18/2018
 * Time: 1:38 PM
 */

namespace App\Http\Controllers\Service;


use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PaymentService extends BaseService
{
    private $columns =  [
        'user_id', 'amount', 'checkout_at', 'info'
    ];
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function findHistories (Request $request) {
        $filter = $this->buildFilter($request);
        if ($request->has('search_user') && $request['search_user']) {
            $filter['searchUser'] = $request['search_user'];
        }
        if ($request->has('checkout_time_from') && $request['checkout_time_from']) {
            $filter['checkoutTimeFrom'] =  $this->stringToDateOrNull($request['checkout_time_from']);
        }
        if ($request->has('checkout_time_to') && $request['checkout_time_to']) {
            $filter['checkoutTimeTo'] =  $this->stringToDateOrNull($request['checkout_time_to']);
        }
        $data = App::make('paymentService')->getData($filter);
        $paginator = App::make('paymentService')->paginator($filter);
        return $this->response([
            'data' => $data,
            'paginator' => $paginator
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->validateRules());
        $attributes = $request->only($this->columns);
        if (!$attributes['checkout_at']) {
            unset($attributes['checkout_at']);
        }
        if (!$attributes['info']) {
            unset($attributes['info']);
        }
        $paymentObj = App::make('paymentService')->query()->create($attributes);
        return $this->response([
            'data' => $paymentObj
        ]);
    }

    public function update($id, Request $request)
    {
        $validateColumns = $this->validateRules();
        $this->validate($request, $validateColumns);
        $attributes = $request->only($this->columns);
        if (!$attributes['checkout_at']) {
            unset($attributes['checkout_at']);
        }
        if (!$attributes['info']) {
            unset($attributes['info']);
        }
        $paymentObj = App::make('paymentService')->query()->findOrFail($id);
        $paymentObj->update($attributes);
        return $this->response([
            'data' => $paymentObj
        ]);
    }

    public function destroy($id, Request $request)
    {
        $paymentObj = App::make('paymentService')->query()->findOrFail($id);
        $paymentObj->delete();
        return $this->response([
            'id' => $id
        ]);
    }

    private function validateRules()
    {
        return [
            'user_id' => 'required',
            'amount' => 'required'
        ];
    }

    public function getListUserCheckout (Request $request) {
        $filter = [];
        if ($request->has('date')) {
            $filter['date'] = $this->stringToDateOrNull($request['date']);
        }
        if ($request->has('search_user') && $request['search_user']) {
            $filter['search_user'] = $request['search_user'];
        }
        $data = App::make('paymentService')->getListUserCheckout($filter);
        return $this->response([
            'data' => $data
        ]);
    }

    public function getListOrderByPaymentId(Request $request) {
        $paymentId = -1;
        if ($request->has('payment_id') && $request['payment_id']) {
            $paymentId = $request['payment_id'];
        }
        $data = $this->orderRepository->query(['payment_id' => $paymentId]);
        $data = $data->get();
        return $this->response([
            'data' => $data
        ]);
    }

    public function getListOrderByListId(Request $request) {
        $ids = [-1];
        if ($request->has('ids') && $request['ids']) {
            $ids = explode(",",$request['ids']);
        }
        $data = $this->orderRepository->query(['ids_in_checkout' => $ids]);
        $data = $data->get();
        return $this->response([
            'data' => $data
        ]);
    }

    public function checkoutUser(Request $request) {
        $result = [
            'status' => 'fail'
        ];
        try {
            $userId = $request->has('user_id') ? $request['user_id'] : 0;
            $listOrderId = $request->has('list_order_id') ? $request['list_order_id'] : '';
            $totalCashback = $request->has('total_cashback') ? $request['total_cashback'] : 0;
            if ($userId && $listOrderId) {
                $listOrderId = explode(",",$listOrderId);
                $paymentObj = App::make('paymentService')->query()->create([
                    'user_id' => $userId,
                    'amount' => $totalCashback
                ]);
                $this->orderRepository->query([
                    'ids' => $listOrderId
                ])->update([
                    'payment_id' => $paymentObj->id
                ]);
                $result = [
                    'status' => 'successful',
                    'data' => $paymentObj
                ];
            }
        } catch (\Exception $ex) {
            $result['message'] = $ex->getMessage();
        }
        return response()->json($result);
    }

    public function checkoutAllUser (Request $request) {
        $result = [
            'status' => 'fail'
        ];
        try {
            $users = $request->has('users') ? $request['users'] : [];
            if (count($users) > 0) {
                foreach ($users as $user) {
                    $paymentObj = App::make('paymentService')->query()->create([
                        'user_id' => $user['id'],
                        'amount' => $user['total_cashback']
                    ]);
                    $this->orderRepository->query([
                        'ids' => $user['list_order_id']
                    ])->update([
                        'payment_id' => $paymentObj->id
                    ]);
                }
                $result = [
                    'status' => 'successful'
                ];
            }
        } catch (\Exception $ex) {
            $result['message'] = $ex->getMessage();
        }
    }

}