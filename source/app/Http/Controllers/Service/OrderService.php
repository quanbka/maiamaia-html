<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/17/18
 * Time: 10:41 AM
 */

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Repositories\Network\SkimlinkRepository;
use App\Repositories\Network\ViglinkRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    private $columns =  [
        'user_id', 'store_id', 'deal_id', 'is_cash_back',
        'cash_back_rate', 'amount', 'cash_back_amount', 'order_number',
        'payment_id', 'info', 'custom_id'
    ];
    private $orderRepository;
    private $skimlinkRepository;
    private $viglinkRepository;

    public function __construct(OrderRepository $orderRepository, SkimlinkRepository $skimlinkRepository, ViglinkRepository $viglinkRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->skimlinkRepository = $skimlinkRepository;
        $this->viglinkRepository = $viglinkRepository;
    }

    public function index(Request $request)
    {
        $filter = $this->buildFilter($request);
        $data = $this->orderRepository->getData($filter);
        $paginator = $this->orderRepository->paginator($filter);
        return $this->response([
            'data' => $data,
            'paginator' => $paginator
        ]);
    }
    
    public function show($id)
    {
        $orderObj = $this->orderRepository->query()->findOrFail($id);
        return $this->response([
            'data' => $orderObj
        ]);
    }


    public function update($id, Request $request)
    {
        $validateColumns = $this->validateRules();
        $this->validate($request, $validateColumns);
        $attributes = $request->only($this->columns);
        $orderObj = $this->orderRepository->query()->findOrFail($id);
        $orderObj->update($attributes);
        return $this->response([
            'data' => $orderObj
        ]);
    }

    public function destroy($id, Request $request)
    {
        $orderObj = $this->orderRepository->query()->findOrFail($id);
        $orderObj->delete();
        return $this->response([
            'id' => $id
        ]);
    }


    public function cronReportSkimlink(Request $request)
    {
        //@todo siteConfig demo
        $siteConfig = new \stdClass();
        $siteConfig->skimlinksPublicKey = '347b9d5ff2baa807f901720955fce354';
        $siteConfig->skimlinksPrivateKey = '729c665f3ab4787d2259b8e412474980';
        $siteConfig->skimlinksDomainId = '1574369';
        $siteConfig->skimlinkSiteId = '115240X1574369';
        $siteConfig->skimlinkNewApi = 1;
        $siteConfig->skimlinkAccountId = 115240;
        $this->orderRepository->cronOrder($this->skimlinkRepository, $request, $siteConfig);
        return $this->response([]);
    }

    public function cronReportVigLink(Request $request)
    {
        //@todo siteConfig demo
        $siteConfig = new \stdClass();
        $siteConfig->viglinksSecret = 'cf4c9373cf472672a6c25dda0d47d8dbaf510616';
        $this->orderRepository->cronOrder($this->viglinkRepository, $request, $siteConfig);
        return $this->response([]);
    }

    private function validateRules()
    {
        return [
        ];
    }

    public function getListOrderPending () {
        $listOrderPending = $this->orderRepository->query([
            'is_order_pending' => 1,
            'user_id' => Auth::user()->id
        ])->get();
        return $this->response([
            'data' => $listOrderPending
        ]);
    }
}
