<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/18/18
 * Time: 9:22 AM
 */

namespace App\Repositories\Network;


class SkimlinkRepository extends BaseNetworkRepository
{

    public function getData($request, $siteConfig)
    {
        $data = [];
        $params = $this->buildFilter($request, $siteConfig);
        $url = $this->buildUrl($params);
        $listCommission = $this->getReport($url);
        foreach ($listCommission as $commission) {
            $data[] = $this->build($commission);
        }
        return $data;
    }

    public function build($commission)
    {
        $removeReferer = $commission['click_details']['page_url'];
        $crcRemoveReferer = explode('?', $removeReferer);
        $customId = $commission['click_details']['custom_id'];
        $commissionId = $commission['commission_id'];
        $date = $commission['transaction_details']['transaction_date'];
        //$dateObj = $this->getFromDateTimeFilter($date, 'Y-m-d h:i:s');
        $publisherId = $commission['publisher_id'];
        $domainId = $commission['publisher_domain_id'];
        $merchantId = $commission['merchant_details']['id'];
        $commissionValue = $commission['transaction_details']['basket']['publisher_amount'];
        $orderValue = $commission['transaction_details']['basket']['order_amount'];
        $currency = $commission['transaction_details']['basket']['currency'];
        $status = $commission['transaction_details']['status'];
        $items = $commission['transaction_details']['basket']['items'];
        $sales = 1;
        $clickTime = $commission['click_details']['date'];
        $commissionType = $commission['transaction_details']['basket']['commission_type'];
        $remoteUserAgent = $commission['click_details']['user_agent'];
        $data = [
            'commission_id' => $commissionId,
            'date' => $date,
            'publisher_id' => $publisherId,
            'domain_id' => $domainId,
            'merchant_id' => $merchantId,
            'commission_value' => $commissionValue,
            'order_value' => $orderValue,
            'currency' => $currency,
            'status' => $status,
            'items' => $items,
            'sales' => $sales,
            'click_time' => $clickTime,
            'commission_type' => $commissionType,
            'remote_user_agent' => $remoteUserAgent,
            'crc_remote_refer' => crc32($crcRemoveReferer[0]),
            'custom_id' => $customId,
        ];
        return $data;
    }

    protected function getReport($apiUrl)
    {
        $result = [];
        $data = triggerSyncRequest($apiUrl);
        if (isset($data['commissions'])) {
            $result = $data['commissions'];
            if (isset($data['pagination']['has_next']) && $data['pagination']['has_next'] == true) {
                $params['offset'] = $data['pagination']['offset'] + $data['pagination']['limit'];
                $result = array_merge($result, $this->getReport($apiUrl));
            }
        }
        return $result;
    }

    protected function buildUrl($params = [])
    {
        $accountId = $params['account_id'];
        $path = $params['path'];
        $url = 'https://reporting.skimapis.com/publisher_admin/' . $accountId . '/' . $path;
        $defaultParams = [
            'limit' => 600,
            'format' => 'json'
        ];
        $params = array_merge($defaultParams, $params);
        if (count($params) > 0) {
            $i = 0;
            foreach ($params as $key => $value) {
                $char = $i == 0 ? '?' : '&';
                $url .= $char . $key . '=' . $value;
                $i++;
            }
        }
        return $url;

    }
    protected function buildFilter($request, $siteConfig)
    {
        $startDay = $request->input('start', 2);
        $startTimestamp = time() - ($startDay * 86400);
        $startDate = date('Y-m-d', $startTimestamp);
        $date = new \DateTime();
        $timestamp = $date->getTimestamp();
        $filter = [
            'timestamp' => $timestamp,
            'apikey' => $siteConfig->skimlinksPublicKey,
            'token' => md5($timestamp . $siteConfig->skimlinksPrivateKey),
            'account_id' => $siteConfig->skimlinkAccountId,
            'start_date' => $startDate,
            'end_date' => $date->format("Y-m-d"),
            'path' => 'commission-report'
        ];

        return $filter;
    }

}