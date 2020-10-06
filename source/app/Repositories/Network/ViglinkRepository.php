<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/18/18
 * Time: 9:22 AM
 */

namespace App\Repositories\Network;


class ViglinkRepository extends BaseNetworkRepository
{

    public function getData($request, $siteConfig)
    {
        $url = $this->buildUrl($siteConfig);
        $reportData = $this->getReport($url);
        $data = $this->build($reportData);

        return $data;
    }

    public function build($reportData)
    {
        $data = [];
        foreach ($reportData as $reportInDay) {
            foreach ($reportInDay as $items) {
                if (!$items || count($items) == 0) {
                    continue;
                }
                foreach ($items as $customId => $commissionValue) {
                    $data[] = [
                        'custom_id' => $customId,
                        'commission_value' => $commissionValue
                    ];
                }
            }
        }
        return $data;
    }

    protected function getReport($apiUrl)
    {
        $result = triggerSyncRequest($apiUrl);
        return $result;
    }

    protected function buildUrl($siteConfig)
    {
        $secret = $siteConfig->viglinksSecret;
        $date = date('Y/m/d');
        $date = urlencode($date);
        $url = "https://publishers.viglink.com/service/v1/cuidRevenue";
        $url .= "?lastDate={$date}&period=week&secret={$secret}";
        return $url;

    }

}