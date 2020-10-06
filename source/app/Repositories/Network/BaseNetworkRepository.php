<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/18/18
 * Time: 9:56 AM
 */

namespace App\Repositories\Network;


abstract class BaseNetworkRepository
{
    public abstract function getData($request, $siteConfig);
}