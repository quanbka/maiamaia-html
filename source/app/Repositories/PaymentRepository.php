<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/18/2018
 * Time: 1:47 PM
 */

namespace App\Repositories;


use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentRepository extends BaseRepository
{
    const MODEL = Payment::class;

    public function query($filter = [])
    {
        $columns = ['payments.id', 'payments.user_id', 'payments.amount', 'payments.checkout_at'];
        $query = parent::query($filter);
        if (array_key_exists('searchUser', $filter) && $filter['searchUser']) {
            $query->leftJoin('users as User', 'payments.user_id', '=', 'User.id');
            $columns = array_merge($columns, ['User.name', 'User.email']);
            $query->where(function ($query) use ($filter){
                $query->where('User.name', 'like','%' . $filter['searchUser'] . '%')
                    ->orWhere('User.email', 'like','%' . $filter['searchUser'] . '%');
            });
        }
        if (array_key_exists('checkoutTimeFrom', $filter) && $filter['checkoutTimeFrom']) {
            $query->where('payments.checkout_at', '>=', $filter['checkoutTimeFrom']);
        }
        if (array_key_exists('checkoutTimeTo', $filter) && $filter['checkoutTimeTo']) {
            $query->where('payments.checkout_at', '<', $filter['checkoutTimeTo']->modify('+1 day'));
        }
        if (array_key_exists('user_id', $filter)) {
            $query->where('payments.user_id','=',$filter['user_id']);
        }
        if (array_key_exists('is_checkout', $filter)) {
            if ($filter['is_checkout']){
                $query->whereNotNull('payments.checkout_at');
            } else {
                $query->whereNull('payments.checkout_at');
            }
        }
        if (array_key_exists('columns', $filter)) {
            $query->select($filter['columns']);
        } else {
            $query->select($columns);
        }
        $query->orderBy('payments.id', 'desc');
        return $query;
    }

    public function getListUserCheckout ($filter = []) {
        $query = DB::table('users')
            ->leftJoin('orders', 'orders.user_id', '=', 'users.id')
            ->where('orders.cash_back_amount', '>', 0)
            ->where(function ($query){
                $query->where('orders.payment_id', '=', null)
                    ->orWhere('orders.payment_id', '=', 0);
            });
        if (array_key_exists('date', $filter) && $filter['date']) {
            $query->where('orders.created_at', '<', $filter['date']);
        }
        if (array_key_exists('search_user', $filter) && $filter['search_user']) {
            $query->where(function ($query) use ($filter){
                $query->where('users.name', 'like','%' . $filter['search_user'] . '%')
                    ->orWhere('users.email', 'like','%' . $filter['search_user'] . '%');
            });
        }
        $listCashback = $query->get(['users.id', 'users.name', 'users.email', 'orders.cash_back_amount', 'orders.id as order_id']);
        $retval = [];
        if (count($listCashback) > 0) {
            foreach ($listCashback as $key => $item) {
                if (!isset($retval[$item->id]['total_cashback'])) {
                    $retval[$item->id]['total_cashback'] = 0;
                }
                $retval[$item->id]['id'] = $item->id;
                $retval[$item->id]['name'] = $item->name;
                $retval[$item->id]['email'] = $item->email;
                $retval[$item->id]['total_cashback'] += $item->cash_back_amount;
                $retval[$item->id]['list_order_id'][] = $item->order_id;
            }
        }
        return $retval;
    }
}