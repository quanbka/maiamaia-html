<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/11/18
 * Time: 11:54 AM
 */


namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{

    const MODEL = Order::class;
    private $trackingService;

    public function __construct(TrackingRepository $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function query($filter = [])
    {
        $query = parent::query($filter);
        $tableName = call_user_func(static::MODEL . '::getTableName');
        if (array_key_exists('custom_id', $filter) && $filter['custom_id']) {
            $query->where($tableName . '.custom_id', '=', $filter['custom_id']);
        }
        if (array_key_exists('payment_id', $filter) && $filter['payment_id']) {
            $query->leftJoin('deals', 'deals.id', '=', $tableName . '.deal_id');
            $query->leftJoin('stores', 'stores.id', '=', $tableName . '.store_id');
            $query->where($tableName . '.payment_id', '=', $filter['payment_id']);
            $query->select([$tableName . '.*', 'deals.title as deal_title', 'stores.name as store_name','stores.slug as store_slug']);
        }
        if (array_key_exists('ids_in_checkout', $filter) && $filter['ids_in_checkout']) {
            $query->leftJoin('deals', 'deals.id', '=', $tableName . '.deal_id');
            $query->leftJoin('stores', 'stores.id', '=', $tableName . '.store_id');
            $query->whereIn($tableName . '.id', $filter['ids_in_checkout']);
            $query->select([$tableName . '.*', 'deals.title as deal_title', 'stores.name as store_name']);
        }
        if (array_key_exists("payment_history", $filter)) {
            $query->join('payments','payments.id','=',$tableName. '.payment_id');
        }
        if (array_key_exists("user_id", $filter)) {
            $query->where('user_id','=',$filter['user_id']);
        }
        if (array_key_exists('is_order_pending', $filter) && $filter['is_order_pending']) {
            $query->where(function ($query) use ($filter, $tableName) {
                $query->whereNull($tableName . '.payment_id')
                    ->orWhere($tableName . '.payment_id', '=', 0);
            });
        }
        if (array_key_exists('is_order_earned', $filter) && $filter['is_order_earned']) {
            $query->where($tableName . '.payment_id', '>', 0);
        }
        return $query;
    }


    public function cronOrder($service, $request, $siteConfig)
    {
        $listCommission = $service->getData($request, $siteConfig);
        foreach ($listCommission as $commission) {
            //@todo delete
            $commission['custom_id'] = time() + rand(1, 1000000);
            if (!isset($commission['custom_id'])) {
                continue;
            }
            $this->createOrderFromCommssion($commission);
        }
    }

    public function createOrderFromCommssion($commission) {

        $customId = $commission['custom_id'];
        $isExistOrder = $this->query([
            'custom_id' => $customId
        ])->exists();
        if($isExistOrder) {
            return;
        }
        //$trackingObj = $this->trackingService->findByCustomId($customId);
        //@todo delete
        $trackingObj = new \stdClass();
        $trackingObj->user_id = 10;
        $trackingObj->store_id = 10;
        $trackingObj->deal_id = 10;
        $trackingObj->cash_back_rate = 10;
        if (!$trackingObj || !isset($trackingObj->user_id)) {
            return;
        }
        $data = $this->buildInsertData($trackingObj, $commission);
        $this->query()->create($data);
    }


    private function buildInsertData($trackingObj, $commission)
    {
        $cashBackAmount = ($commission['commission_value'] * $trackingObj->cash_back_rate)/100;
        return [
            'user_id' => $trackingObj->user_id,
            'store_id' => $trackingObj->store_id,
            'deal_id' => $trackingObj->deal_id,
            'is_cash_back' => 0,
            'cash_back_rate' => $trackingObj->cash_back_rate,
            'amount' => $commission['commission_value'],
            'cash_back_amount' => $cashBackAmount ,
            'order_number' => isset($commission['sales']) ? $commission['sales'] : 0 ,
            'payment_id' => 0 ,
            'info' => '' ,
            'custom_id' => $commission['custom_id']
        ];
    }
}