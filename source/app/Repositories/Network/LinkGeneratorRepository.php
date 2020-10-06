<?php
/**
 * User: Lap Dam
 */

namespace App\Repositories\Network;

use Exception;


class LinkGeneratorRepository extends BaseNetworkRepository
{

    public function generate($originUrl, $config, $type = "default") {
        $retVal = $originUrl;
        switch ($type) {
            case "skimlink":
                $retVal = self::skimlinkGenerate($originUrl, $config);
                break;
            case "viglink":
                $retVal = self::viglinkGenerate($originUrl, $config);
                break;
            default:
                $retVal = self::defaultGenerate($originUrl, $config);
                break;
        }
        return $retVal;
    }

    private function viglinkGenerate($originUrl, $config) {
        $retVal = $originUrl;
        try {
            if (isset($config->viglinkKey) && !empty($config->viglinkKey)) {
                $key = $config->viglinkKey;
                $retVal = "http://redirect.viglink.com?u=" . urlencode($originUrl) . "&key=$key";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $retVal;
    }

    private function skimlinkGenerate($originUrl, $config) {
        $retVal = $originUrl;
        try {
            if (isset($config->skimlinkSiteId) && !empty($config->skimlinkSiteId)) {
                $siteId = $config->skimlinkSiteId;
                $retVal = "http://go.redirectingat.com/?id=$siteId&xs=1&url=" . urlencode($originUrl);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $retVal;
    }

    private function defaultGenerate($originUrl, $config) {
        return $originUrl;
    }

    public function buildAffilidateUrl(array $params) {
        if (array_key_exists("originUrl", $params) && array_key_exists("storeId", $params)) {
            $retVal = $params["originUrl"];
            if (!empty($params["originUrl"]) && !empty($params["storeId"])) {
                $config = self::getConfig();
                $networkConfig = $config;
                if (!empty($config)) {
                    $isSkip = false;
                    $skipStoresConfig = isset($networkConfig->skipStores)?$networkConfig->skipStores:null;
                    if (!empty($skipStoresConfig)) {
                        $skipStores = preg_split('/,/', trim($skipStoresConfig), -1, PREG_SPLIT_NO_EMPTY);
                        if (in_array($params["storeId"], $skipStores)) {
                            $isSkip = true;
                        }
                    }
                    $skipConfig = isset($networkConfig->skip)?$networkConfig->skip:null;
                    if (!empty($skipConfig)) {
                        $skipLinks = preg_split('/,/', trim($skipConfig), -1, PREG_SPLIT_NO_EMPTY);
                        foreach ($skipLinks as $skipLink) {
                            $isFound = stripos($params["originUrl"], $skipLink);
                            if ($isFound != false) {
                                $isSkip = true;
                                break;
                            }
                        }
                    }

                    $defaultConfig = $networkConfig->default;
                    
                    $type = $defaultConfig;
                    if ($isSkip) {
                        $type = "default";
                    } else if (!empty($params["storeId"])) {
                        switch ($defaultConfig) {
                            case "skimlink":
                                $type = self::checkLink($networkConfig, $params["storeId"], "viglink") ? "viglink" : $defaultConfig;
                                break;
                            case "viglink":
                                $type = self::checkLink($networkConfig, $params["storeId"], "skimlink") ? "skimlink" : $defaultConfig;
                                break;
                            default:
                                $type = self::checkLink($networkConfig, $params["storeId"], "viglink") ? "viglink" : (self::checkLink($networkConfig, $params["storeId"], "skimlink") ? "skimlink" : $defaultConfig);
                                break;
                        }
                    }
                    $retVal = self::generate($params["originUrl"],$config, $type);
                }
//            \Log::info(json_encode($params)."===".$retVal."===== ".$type);
            }
            return $retVal;
        }
    }

    private function checkLink($config, $storeId, $type) {
        $retVal = false;
        if (is_object($config)) {
            $config = get_object_vars($config);
        }
        $idsConfig = $config[$type];
        if (!empty($idsConfig)) {
            $ids = preg_split('/,/', trim($idsConfig), -1, PREG_SPLIT_NO_EMPTY);
            $retVal = in_array($storeId, $ids);
        }
        return $retVal;
    }
    public function getConfig() {
        $retVal = [];
        try {
            $config = \App::make("settingService")->getByKey("network_config");
            if (isset($config->value) && !empty($config->value)) {
               $retVal = json_decode($config->value);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $retVal;
    }

    public function getData($request, $siteConfig) {
        
    }

}