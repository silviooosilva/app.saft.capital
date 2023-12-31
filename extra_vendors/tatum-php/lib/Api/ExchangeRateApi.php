<?php

/**
 * Implementation of ExchangeRate API
 *
 * @copyright (c) 2022-2023 tatum.io
 * @license   MIT
 * @package   Tatum
 * @author    Mark Jivko
 *
 * NOTE: This class is auto-generated by tatum.io
 * Do not edit this file manually!
 */

namespace Tatum\Api;
!defined("TATUM-SDK") && exit();

use InvalidArgumentException as IAE;
use Tatum\Sdk\Serializer as S;

/**
 * API for ExchangeRate
 */
class ExchangeRateApi extends AbstractApi {
    
    /**
     * API package
     */
    const PKG = "Exchange rate";

    /**
     * Get the current exchange rate for exchanging fiat/crypto assets
     *
     * @param string $currency The fiat or crypto asset to exchange
     * @param string|'EUR' $base_pair The target fiat asset to get the exchange rate for
     * @throws \Tatum\Sdk\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * 
     * @return \Tatum\Model\ExchangeRate
     */
    public function getExchangeRate($currency, $base_pair = 'EUR') {
        $rHeaders = $this->_headerSelector->selectHeaders(["application/json"], []);

        // Path template
        $rPath = "/v3/tatum/rate/{currency}";
        /** @var \Tatum\Model\ExchangeRate $result */
        $result = $this->exec(
            S::createRequest(
                $this->_caller->config(), self::PKG, "GET", S::parse($rPath, ["currency" => $currency]), $rPath, [
                    "basePair" => S::toQueryValue($base_pair),
                ], $rHeaders, []
            ), 
            "\Tatum\Model\ExchangeRate"
        );
            
        return $result;
    }
    
}
