<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use \ccxt\ExchangeError;
use \ccxt\InvalidOrder;
use ccxt\Precise;

class kucoin extends Controller {

    public function describe() {
        return $this->deep_extend(parent::describe (), array(
            'id' => 'kucoin',
            'name' => 'KuCoin',
            'countries' => array( 'SC' ),
            'rateLimit' => 50,
            'version' => 'v2',
            'certified' => false,
            'pro' => true,
            'comment' => 'Platform 2.0',
            'quoteJsonNumbers' => false,
            'has' => array(
                'CORS' => null,
                'spot' => true,
                'margin' => null,
                'swap' => false,
                'future' => false,
                'option' => null,
                'cancelAllOrders' => true,
                'cancelOrder' => true,
                'createDepositAddress' => true,
                'createOrder' => true,
                'fetchAccounts' => true,
                'fetchBalance' => true,
                'fetchBorrowRate' => false,
                'fetchBorrowRates' => false,
                'fetchClosedOrders' => true,
                'fetchCurrencies' => true,
                'fetchDepositAddress' => true,
                'fetchDeposits' => true,
                'fetchFundingFee' => true,
                'fetchFundingHistory' => false,
                'fetchFundingRate' => false,
                'fetchFundingRateHistory' => false,
                'fetchFundingRates' => false,
                'fetchIndexOHLCV' => false,
                'fetchL3OrderBook' => true,
                'fetchLedger' => true,
                'fetchMarkets' => true,
                'fetchMarkOHLCV' => false,
                'fetchMyTrades' => true,
                'fetchOHLCV' => true,
                'fetchOpenOrders' => true,
                'fetchOrder' => true,
                'fetchOrderBook' => true,
                'fetchOrdersByStatus' => true,
                'fetchPremiumIndexOHLCV' => false,
                'fetchStatus' => true,
                'fetchTicker' => true,
                'fetchTickers' => true,
                'fetchTime' => true,
                'fetchTrades' => true,
                'fetchTradingFee' => true,
                'fetchTradingFees' => false,
                'fetchWithdrawals' => true,
                'transfer' => true,
                'withdraw' => true,
            ),
            'urls' => array(
                'logo' => 'https://user-images.githubusercontent.com/51840849/87295558-132aaf80-c50e-11ea-9801-a2fb0c57c799.jpg',
                'referral' => 'https://www.kucoin.com/?rcode=E5wkqe',
                'api' => array(
                    'public' => 'https://openapi-v2.kucoin.com',
                    'private' => 'https://openapi-v2.kucoin.com',
                    'futuresPrivate' => 'https://api-futures.kucoin.com',
                    'futuresPublic' => 'https://api-futures.kucoin.com',
                ),
                'test' => array(
                    'public' => 'https://openapi-sandbox.kucoin.com',
                    'private' => 'https://openapi-sandbox.kucoin.com',
                    'futuresPrivate' => 'https://api-sandbox-futures.kucoin.com',
                    'futuresPublic' => 'https://api-sandbox-futures.kucoin.com',
                ),
                'www' => 'https://www.kucoin.com',
                'doc' => array(
                    'https://docs.kucoin.com',
                ),
            ),
            'requiredCredentials' => array(
                'apiKey' => true,
                'secret' => true,
                'password' => true,
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'timestamp' => 1,
                        'status' => 1,
                        'symbols' => 1,
                        'markets' => 1,
                        'market/allTickers' => 1,
                        'market/orderbook/level{level}_{limit}' => 1,
                        'market/orderbook/level2_20' => 1,
                        'market/orderbook/level2_100' => 1,
                        'market/histories' => 1,
                        'market/candles' => 1,
                        'market/stats' => 1,
                        'currencies' => 1,
                        'currencies/{currency}' => 1,
                        'prices' => 1,
                        'mark-price/{symbol}/current' => 1,
                        'margin/config' => 1,
                    ),
                    'post' => array(
                        'bullet-public' => 1,
                    ),
                ),
                'private' => array(
                    'get' => array(
                        'market/orderbook/level{level}' => 1,
                        'market/orderbook/level2' => array( 'v3' => 2 ), // 30/3s = 10/s => cost = 20 / 10 = 2
                        'market/orderbook/level3' => 1,
                        'accounts' => 1,
                        'accounts/{accountId}' => 1,
                        'accounts/ledgers' => 3.333, // 18/3s = 6/s => cost = 20 / 6 = 3.333
                        'accounts/{accountId}/holds' => 1,
                        'accounts/transferable' => 1,
                        'base-fee' => 1,
                        'sub/user' => 1,
                        'sub-accounts' => 1,
                        'sub-accounts/{subUserId}' => 1,
                        'deposit-addresses' => 1,
                        'deposits' => 10, // 6/3s = 2/s => cost = 20 / 2 = 10
                        'hist-deposits' => 10, // 6/3 = 2/s => cost = 20 / 2 = 10
                        'hist-orders' => 1,
                        'hist-withdrawals' => 10, // 6/3 = 2/s => cost = 20 / 2 = 10
                        'withdrawals' => 10, // 6/3 = 2/s => cost = 20 / 2 = 10
                        'withdrawals/quotas' => 1,
                        'orders' => 2, // 30/3s =  10/s => cost  = 20 / 10 = 2
                        'order/client-order/{clientOid}' => 1,
                        'orders/{orderId}' => 1,
                        'limit/orders' => 1,
                        'fills' => 6.66667, // 9/3s = 3/s => cost  = 20 / 3 = 6.666667
                        'limit/fills' => 1,
                        'margin/account' => 1,
                        'margin/borrow' => 1,
                        'margin/borrow/outstanding' => 1,
                        'margin/borrow/borrow/repaid' => 1,
                        'margin/lend/active' => 1,
                        'margin/lend/done' => 1,
                        'margin/lend/trade/unsettled' => 1,
                        'margin/lend/trade/settled' => 1,
                        'margin/lend/assets' => 1,
                        'margin/market' => 1,
                        'margin/trade/last' => 1,
                        'stop-order/{orderId}' => 1,
                        'stop-order' => 1,
                        'stop-order/queryOrderByClientOid' => 1,
                        'trade-fees' => 1.3333, // 45/3s = 15/s => cost = 20 / 15 = 1.333
                    ),
                    'post' => array(
                        'accounts' => 1,
                        'accounts/inner-transfer' => array( 'v2' => 1 ),
                        'accounts/sub-transfer' => array( 'v2' => 25 ), // bad docs
                        'deposit-addresses' => 1,
                        'withdrawals' => 1,
                        'orders' => 4, // 45/3s = 15/s => cost = 20 / 15 = 1.333333
                        'orders/multi' => 20, // 3/3s = 1/s => cost = 20 / 1 = 20
                        'margin/borrow' => 1,
                        'margin/order' => 1,
                        'margin/repay/all' => 1,
                        'margin/repay/single' => 1,
                        'margin/lend' => 1,
                        'margin/toggle-auto-lend' => 1,
                        'bullet-private' => 1,
                        'stop-order' => 1,
                    ),
                    'delete' => array(
                        'withdrawals/{withdrawalId}' => 1,
                        'orders' => 20, // 3/3s = 1/s => cost = 20/1
                        'orders/client-order/{clientOid}' => 1,
                        'orders/{orderId}' => 1, // rateLimit => 60/3s = 20/s => cost = 1
                        'margin/lend/{orderId}' => 1,
                        'stop-order/cancelOrderByClientOid' => 1,
                        'stop-order/{orderId}' => 1,
                        'stop-order/cancel' => 1,
                    ),
                ),
                'futuresPublic' => array(
                    'get' => array(
                        'contracts/active' => 1.3953,
                        'contracts/{symbol}' => 1.3953,
                        'ticker' => 1.3953,
                        'level2/snapshot' => 2, // 30 requests per 3 seconds = 10 requests per second => cost = 20/10 = 2
                        'level2/depth20' => 1.3953,
                        'level2/depth100' => 1.3953,
                        'level2/message/query' => 1.3953,
                        'level3/message/query' => 1.3953, // deprecated，level3/snapshot is suggested
                        'level3/snapshot' => 1.3953, // v2
                        'trade/history' => 1.3953,
                        'interest/query' => 1.3953,
                        'index/query' => 1.3953,
                        'mark-price/{symbol}/current' => 1.3953,
                        'premium/query' => 1.3953,
                        'funding-rate/{symbol}/current' => 1.3953,
                        'timestamp' => 1.3953,
                        'status' => 1.3953,
                        'kline/query' => 1.3953,
                    ),
                    'post' => array(
                        'bullet-public' => 1.3953,
                    ),
                ),
                'futuresPrivate' => array(
                    'get' => array(
                        'account-overview' => 2, // 30 requests per 3 seconds = 10 per second => cost = 20/10 = 2
                        'transaction-history' => 6.666, // 9 requests per 3 seconds = 3 per second => cost = 20/3 = 6.666
                        'deposit-address' => 1.3953,
                        'deposit-list' => 1.3953,
                        'withdrawals/quotas' => 1.3953,
                        'withdrawal-list' => 1.3953,
                        'transfer-list' => 1.3953,
                        'orders' => 1.3953,
                        'stopOrders' => 1.3953,
                        'recentDoneOrders' => 1.3953,
                        'orders/{order-id}' => 1.3953, // ?clientOid={client-order-id} // get order by orderId
                        'orders/byClientOid' => 1.3953, // ?clientOid=eresc138b21023a909e5ad59 // get order by clientOid
                        'fills' => 6.666, // 9 requests per 3 seconds = 3 per second => cost = 20/3 = 6.666
                        'recentFills' => 6.666, // 9 requests per 3 seconds = 3 per second => cost = 20/3 = 6.666
                        'openOrderStatistics' => 1.3953,
                        'position' => 1.3953,
                        'positions' => 6.666, // 9 requests per 3 seconds = 3 per second => cost = 20/3 = 6.666
                        'funding-history' => 6.666, // 9 requests per 3 seconds = 3 per second => cost = 20/3 = 6.666
                    ),
                    'post' => array(
                        'withdrawals' => 1.3953,
                        'transfer-out' => 1.3953, // v2
                        'orders' => 1.3953,
                        'position/margin/auto-deposit-status' => 1.3953,
                        'position/margin/deposit-margin' => 1.3953,
                        'bullet-private' => 1.3953,
                    ),
                    'delete' => array(
                        'withdrawals/{withdrawalId}' => 1.3953,
                        'cancel/transfer-out' => 1.3953,
                        'orders/{order-id}' => 1.3953, // 40 requests per 3 seconds = 14.333 per second => cost = 20/14.333 = 1.395
                        'orders' => 6.666, // 9 requests per 3 seconds = 3 per second => cost = 20/3 = 6.666
                        'stopOrders' => 1.3953,
                    ),
                ),
            ),
            'timeframes' => array(
                '1m' => '1min',
                '3m' => '3min',
                '5m' => '5min',
                '15m' => '15min',
                '30m' => '30min',
                '1h' => '1hour',
                '2h' => '2hour',
                '4h' => '4hour',
                '6h' => '6hour',
                '8h' => '8hour',
                '12h' => '12hour',
                '1d' => '1day',
                '1w' => '1week',
            ),
            'exceptions' => array(
                'exact' => array(
                    'order not exist' => '\\ccxt\\OrderNotFound',
                    'order not exist.' => '\\ccxt\\OrderNotFound', // duplicated error temporarily
                    'order_not_exist' => '\\ccxt\\OrderNotFound', // array("code":"order_not_exist","msg":"order_not_exist") ¯\_(ツ)_/¯
                    'order_not_exist_or_not_allow_to_cancel' => '\\ccxt\\InvalidOrder', // array("code":"400100","msg":"order_not_exist_or_not_allow_to_cancel")
                    'Order size below the minimum requirement.' => '\\ccxt\\InvalidOrder', // array("code":"400100","msg":"Order size below the minimum requirement.")
                    'The withdrawal amount is below the minimum requirement.' => '\\ccxt\\ExchangeError', // array("code":"400100","msg":"The withdrawal amount is below the minimum requirement.")
                    'Unsuccessful! Exceeded the max. funds out-transfer limit' => '\\ccxt\\InsufficientFunds', // array("code":"200000","msg":"Unsuccessful! Exceeded the max. funds out-transfer limit")
                    '400' => '\\ccxt\\BadRequest',
                    '401' => '\\ccxt\\AuthenticationError',
                    '403' => '\\ccxt\\NotSupported',
                    '404' => '\\ccxt\\NotSupported',
                    '405' => '\\ccxt\\NotSupported',
                    '429' => '\\ccxt\\RateLimitExceeded',
                    '500' => '\\ccxt\\ExchangeNotAvailable', // Internal Server Error -- We had a problem with our server. Try again later.
                    '503' => '\\ccxt\\ExchangeNotAvailable',
                    '101030' => '\\ccxt\\PermissionDenied', // array("code":"101030","msg":"You haven't yet enabled the margin trading")
                    '200004' => '\\ccxt\\InsufficientFunds',
                    '230003' => '\\ccxt\\InsufficientFunds', // array("code":"230003","msg":"Balance insufficient!")
                    '260100' => '\\ccxt\\InsufficientFunds', // array("code":"260100","msg":"account.noBalance")
                    '300000' => '\\ccxt\\InvalidOrder',
                    '400000' => '\\ccxt\\BadSymbol',
                    '400001' => '\\ccxt\\AuthenticationError',
                    '400002' => '\\ccxt\\InvalidNonce',
                    '400003' => '\\ccxt\\AuthenticationError',
                    '400004' => '\\ccxt\\AuthenticationError',
                    '400005' => '\\ccxt\\AuthenticationError',
                    '400006' => '\\ccxt\\AuthenticationError',
                    '400007' => '\\ccxt\\AuthenticationError',
                    '400008' => '\\ccxt\\NotSupported',
                    '400100' => '\\ccxt\\BadRequest',
                    '400350' => '\\ccxt\\InvalidOrder', // array("code":"400350","msg":"Upper limit for holding => 10,000USDT, you can still buy 10,000USDT worth of coin.")
                    '400500' => '\\ccxt\\InvalidOrder', // array("code":"400500","msg":"Your located country/region is currently not supported for the trading of this token")
                    '400600' => '\\ccxt\\BadSymbol', // array("code":"400600","msg":"validation.createOrder.symbolNotAvailable")
                    '401000' => '\\ccxt\\BadRequest', // array("code":"401000","msg":"The interface has been deprecated")
                    '411100' => '\\ccxt\\AccountSuspended',
                    '415000' => '\\ccxt\\BadRequest', // array("code":"415000","msg":"Unsupported Media Type")
                    '500000' => '\\ccxt\\ExchangeNotAvailable', // array("code":"500000","msg":"Internal Server Error")
                    '260220' => '\\ccxt\\InvalidAddress', // array( "code" => "260220", "msg" => "deposit.address.not.exists" )
                ),
                'broad' => array(
                    'Exceeded the access frequency' => '\\ccxt\\RateLimitExceeded',
                    'require more permission' => '\\ccxt\\PermissionDenied',
                ),
            ),
            'fees' => array(
                'trading' => array(
                    'tierBased' => true,
                    'percentage' => true,
                    'taker' => $this->parse_number('0.001'),
                    'maker' => $this->parse_number('0.001'),
                    'tiers' => array(
                        'taker' => array(
                            array( $this->parse_number('0'), $this->parse_number('0.001') ),
                            array( $this->parse_number('50'), $this->parse_number('0.001') ),
                            array( $this->parse_number('200'), $this->parse_number('0.0009') ),
                            array( $this->parse_number('500'), $this->parse_number('0.0008') ),
                            array( $this->parse_number('1000'), $this->parse_number('0.0007') ),
                            array( $this->parse_number('2000'), $this->parse_number('0.0007') ),
                            array( $this->parse_number('4000'), $this->parse_number('0.0006') ),
                            array( $this->parse_number('8000'), $this->parse_number('0.0005') ),
                            array( $this->parse_number('15000'), $this->parse_number('0.00045') ),
                            array( $this->parse_number('25000'), $this->parse_number('0.0004') ),
                            array( $this->parse_number('40000'), $this->parse_number('0.00035') ),
                            array( $this->parse_number('60000'), $this->parse_number('0.0003') ),
                            array( $this->parse_number('80000'), $this->parse_number('0.00025') ),
                        ),
                        'maker' => array(
                            array( $this->parse_number('0'), $this->parse_number('0.001') ),
                            array( $this->parse_number('50'), $this->parse_number('0.0009') ),
                            array( $this->parse_number('200'), $this->parse_number('0.0007') ),
                            array( $this->parse_number('500'), $this->parse_number('0.0005') ),
                            array( $this->parse_number('1000'), $this->parse_number('0.0003') ),
                            array( $this->parse_number('2000'), $this->parse_number('0') ),
                            array( $this->parse_number('4000'), $this->parse_number('0') ),
                            array( $this->parse_number('8000'), $this->parse_number('0') ),
                            array( $this->parse_number('15000'), $this->parse_number('-0.00005') ),
                            array( $this->parse_number('25000'), $this->parse_number('-0.00005') ),
                            array( $this->parse_number('40000'), $this->parse_number('-0.00005') ),
                            array( $this->parse_number('60000'), $this->parse_number('-0.00005') ),
                            array( $this->parse_number('80000'), $this->parse_number('-0.00005') ),
                        ),
                    ),
                ),
                'funding' => array(
                    'tierBased' => false,
                    'percentage' => false,
                    'withdraw' => array(),
                    'deposit' => array(),
                ),
            ),
            'commonCurrencies' => array(
                'HOT' => 'HOTNOW',
                'EDGE' => 'DADI', // https://github.com/ccxt/ccxt/issues/5756
                'WAX' => 'WAXP',
                'TRY' => 'Trias',
                'VAI' => 'VAIOT',
            ),
            'options' => array(
                'version' => 'v1',
                'symbolSeparator' => '-',
                'fetchMyTradesMethod' => 'private_get_fills',
                'fetchBalance' => 'trade',
                'fetchMarkets' => array(
                    'fetchTickersFees' => true,
                ),
                // endpoint versions
                'versions' => array(
                    'public' => array(
                        'GET' => array(
                            'status' => 'v1',
                            'market/orderbook/level2_20' => 'v1',
                            'market/orderbook/level2_100' => 'v1',
                            'market/orderbook/level{level}_{limit}' => 'v1',
                        ),
                    ),
                    'private' => array(
                        'GET' => array(
                            'market/orderbook/level2' => 'v3',
                            'market/orderbook/level3' => 'v3',
                            'market/orderbook/level{level}' => 'v3',
                        ),
                        'POST' => array(
                            'accounts/inner-transfer' => 'v2',
                            'accounts/sub-transfer' => 'v2',
                        ),
                    ),
                    'futuresPrivate' => array(
                        'GET' => array(
                            'account-overview' => 'v1',
                            'positions' => 'v1',
                        ),
                        'POST' => array(
                            'transfer-out' => 'v2',
                        ),
                    ),
                    'futuresPublic' => array(
                        'GET' => array(
                            'level3/snapshot' => 'v2',
                        ),
                    ),
                ),
                'accountsByType' => array(
                    'trade' => 'trade',
                    'trading' => 'trade',
                    'spot' => 'trade',
                    'margin' => 'margin',
                    'main' => 'main',
                    'funding' => 'main',
                    'future' => 'contract',
                    'futures' => 'contract',
                    'contract' => 'contract',
                    'pool' => 'pool',
                    'pool-x' => 'pool',
                ),
                'networks' => array(
                    'ETH' => 'eth',
                    'ERC20' => 'eth',
                    'TRX' => 'trx',
                    'TRC20' => 'trx',
                    'KCC' => 'kcc',
                    'TERRA' => 'luna',
                ),
            ),
        ));
    }

    public function nonce() {
        return $this->milliseconds();
    }

    public function fetch_time($params = array ()) {
        $response = $this->publicGetTimestamp ($params);
        return $this->safe_integer($response, 'data');
    }

    public function fetch_status($params = array ()) {
        $response = $this->publicGetStatus ($params);
        $data = $this->safe_value($response, 'data', array());
        $status = $this->safe_value($data, 'status');
        if ($status !== null) {
            $status = ($status === 'open') ? 'ok' : 'maintenance';
            $this->status = array_merge($this->status, array(
                'status' => $status,
                'updated' => $this->milliseconds(),
            ));
        }
        return $this->status;
    }

    public function fetch_markets($params = array ()) {
        $response = $this->publicGetSymbols ($params);
        $data = $this->safe_value($response, 'data');
        $options = $this->safe_value($this->options, 'fetchMarkets', array());
        $fetchTickersFees = $this->safe_value($options, 'fetchTickersFees', true);
        $tickersResponse = array();
        if ($fetchTickersFees) {
            $tickersResponse = $this->publicGetMarketAllTickers ($params);
        }
        $tickersData = $this->safe_value($tickersResponse, 'data', array());
        $tickers = $this->safe_value($tickersData, 'ticker', array());
        $tickersByMarketId = $this->index_by($tickers, 'symbol');
        $result = array();
        for ($i = 0; $i < count($data); $i++) {
            $market = $data[$i];
            $id = $this->safe_string($market, 'symbol');
            list($baseId, $quoteId) = explode('-', $id);
            $base = $this->safe_currency_code($baseId);
            $quote = $this->safe_currency_code($quoteId);
            $baseMaxSize = $this->safe_number($market, 'baseMaxSize');
            $baseMinSizeString = $this->safe_string($market, 'baseMinSize');
            $quoteMaxSizeString = $this->safe_string($market, 'quoteMaxSize');
            $baseMinSize = $this->parse_number($baseMinSizeString);
            $quoteMaxSize = $this->parse_number($quoteMaxSizeString);
            $quoteMinSize = $this->safe_number($market, 'quoteMinSize');
            // $quoteIncrement = $this->safe_number($market, 'quoteIncrement');
            $ticker = $this->safe_value($tickersByMarketId, $id, array());
            $makerFeeRate = $this->safe_string($ticker, 'makerFeeRate');
            $takerFeeRate = $this->safe_string($ticker, 'makerFeeRate');
            $makerCoefficient = $this->safe_string($ticker, 'makerCoefficient');
            $takerCoefficient = $this->safe_string($ticker, 'takerCoefficient');
            $result[] = array(
                'id' => $id,
                'symbol' => $base . '/' . $quote,
                'base' => $base,
                'quote' => $quote,
                'settle' => null,
                'baseId' => $baseId,
                'quoteId' => $quoteId,
                'settleId' => null,
                'type' => 'spot',
                'spot' => true,
                'margin' => $this->safe_value($market, 'isMarginEnabled'),
                'swap' => false,
                'future' => false,
                'option' => false,
                'active' => $this->safe_value($market, 'enableTrading'),
                'contract' => false,
                'linear' => null,
                'inverse' => null,
                'taker' => $this->parse_number(Precise::string_mul($takerFeeRate, $takerCoefficient)),
                'maker' => $this->parse_number(Precise::string_mul($makerFeeRate, $makerCoefficient)),
                'contractSize' => null,
                'expiry' => null,
                'expiryDatetime' => null,
                'strike' => null,
                'optionType' => null,
                'precision' => array(
                    'amount' => $this->precision_from_string($this->safe_string($market, 'baseIncrement')),
                    'price' => $this->precision_from_string($this->safe_string($market, 'priceIncrement')),
                ),
                'limits' => array(
                    'leverage' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'amount' => array(
                        'min' => $baseMinSize,
                        'max' => $baseMaxSize,
                    ),
                    'price' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'cost' => array(
                        'min' => $quoteMinSize,
                        'max' => $quoteMaxSize,
                    ),
                ),
                'info' => $market,
            );
        }
        return $result;
    }

    public function fetch_currencies($params = array ()) {
        $response = $this->publicGetCurrencies ($params);
        $data = $this->safe_value($response, 'data', array());
        $result = array();
        for ($i = 0; $i < count($data); $i++) {
            $entry = $data[$i];
            $id = $this->safe_string($entry, 'currency');
            $name = $this->safe_string($entry, 'fullName');
            $code = $this->safe_currency_code($id);
            $precision = $this->safe_integer($entry, 'precision');
            $isWithdrawEnabled = $this->safe_value($entry, 'isWithdrawEnabled', false);
            $isDepositEnabled = $this->safe_value($entry, 'isDepositEnabled', false);
            $fee = $this->safe_number($entry, 'withdrawalMinFee');
            $active = ($isWithdrawEnabled && $isDepositEnabled);
            $result[$code] = array(
                'id' => $id,
                'name' => $name,
                'code' => $code,
                'precision' => $precision,
                'info' => $entry,
                'active' => $active,
                'deposit' => $isDepositEnabled,
                'withdraw' => $isWithdrawEnabled,
                'fee' => $fee,
                'limits' => $this->limits,
            );
        }
        return $result;
    }

    public function fetch_accounts($params = array ()) {
        $response = $this->privateGetAccounts ($params);
        $data = $this->safe_value($response, 'data');
        $result = array();
        for ($i = 0; $i < count($data); $i++) {
            $account = $data[$i];
            $accountId = $this->safe_string($account, 'id');
            $currencyId = $this->safe_string($account, 'currency');
            $code = $this->safe_currency_code($currencyId);
            $type = $this->safe_string($account, 'type');  // main or trade
            $result[] = array(
                'id' => $accountId,
                'type' => $type,
                'currency' => $code,
                'info' => $account,
            );
        }
        return $result;
    }

    public function fetch_funding_fee($code, $params = array ()) {
        $this->load_markets();
        $currency = $this->currency($code);
        $request = array(
            'currency' => $currency['id'],
        );
        $response = $this->privateGetWithdrawalsQuotas (array_merge($request, $params));
        $data = $response['data'];
        $withdrawFees = array();
        $withdrawFees[$code] = $this->safe_number($data, 'withdrawMinFee');
        return array(
            'info' => $response,
            'withdraw' => $withdrawFees,
            'deposit' => array(),
        );
    }

    public function is_futures_method($methodName, $params) {
        $defaultType = $this->safe_string_2($this->options, $methodName, 'defaultType', 'trade');
        $requestedType = $this->safe_string($params, 'type', $defaultType);
        $accountsByType = $this->safe_value($this->options, 'accountsByType');
        $type = $this->safe_string($accountsByType, $requestedType);
        if ($type === null) {
            $keys = is_array($accountsByType) ? array_keys($accountsByType) : array();
            throw new ExchangeError($this->id . ' $type must be one of ' . implode(', ', $keys));
        }
        $params = $this->omit($params, 'type');
        return ($type === 'contract') || ($type === 'future') || ($type === 'futures'); // * ($type === 'futures') deprecated, use ($type === 'future')
    }

    public function parse_ticker($ticker, $market = null) {
        $percentage = $this->safe_string($ticker, 'changeRate');
        if ($percentage !== null) {
            $percentage = Precise::string_mul($percentage, '100');
        }
        $last = $this->safe_string_2($ticker, 'last', 'lastTradedPrice');
        $last = $this->safe_string($ticker, 'price', $last);
        $marketId = $this->safe_string($ticker, 'symbol');
        $market = $this->safe_market($marketId, $market, '-');
        $symbol = $market['symbol'];
        $baseVolume = $this->safe_string($ticker, 'vol');
        $quoteVolume = $this->safe_string($ticker, 'volValue');
        $timestamp = $this->safe_integer_2($ticker, 'time', 'datetime');
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'high' => $this->safe_string($ticker, 'high'),
            'low' => $this->safe_string($ticker, 'low'),
            'bid' => $this->safe_string_2($ticker, 'buy', 'bestBid'),
            'bidVolume' => $this->safe_string($ticker, 'bestBidSize'),
            'ask' => $this->safe_string_2($ticker, 'sell', 'bestAsk'),
            'askVolume' => $this->safe_string($ticker, 'bestAskSize'),
            'vwap' => null,
            'open' => $this->safe_string($ticker, 'open'),
            'close' => $last,
            'last' => $last,
            'previousClose' => null,
            'change' => $this->safe_string($ticker, 'changePrice'),
            'percentage' => $percentage,
            'average' => $this->safe_string($ticker, 'averagePrice'),
            'baseVolume' => $baseVolume,
            'quoteVolume' => $quoteVolume,
            'info' => $ticker,
        ), $market, false);
    }

    public function fetch_tickers($symbols = null, $params = array ()) {
        $this->load_markets();
        $response = $this->publicGetMarketAllTickers ($params);
        $data = $this->safe_value($response, 'data', array());
        $tickers = $this->safe_value($data, 'ticker', array());
        $time = $this->safe_integer($data, 'time');
        $result = array();
        for ($i = 0; $i < count($tickers); $i++) {
            $tickers[$i]['time'] = $time;
            $ticker = $this->parse_ticker($tickers[$i]);
            $symbol = $this->safe_string($ticker, 'symbol');
            if ($symbol !== null) {
                $result[$symbol] = $ticker;
            }
        }
        return $this->filter_by_array($result, 'symbol', $symbols);
    }

    public function fetch_ticker($symbol, $params = array ()) {
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $response = $this->publicGetMarketStats (array_merge($request, $params));
        return $this->parse_ticker($response['data'], $market);
    }

    public function parse_ohlcv($ohlcv, $market = null) {
        return array(
            $this->safe_timestamp($ohlcv, 0),
            $this->safe_number($ohlcv, 1),
            $this->safe_number($ohlcv, 3),
            $this->safe_number($ohlcv, 4),
            $this->safe_number($ohlcv, 2),
            $this->safe_number($ohlcv, 5),
        );
    }

    public function fetch_ohlcv($symbol, $timeframe = '15m', $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $market = $this->market($symbol);
        $marketId = $market['id'];
        $request = array(
            'symbol' => $marketId,
            'type' => $this->timeframes[$timeframe],
        );
        $duration = $this->parse_timeframe($timeframe) * 1000;
        $endAt = $this->milliseconds(); // required param
        if ($since !== null) {
            $request['startAt'] = intval((int) floor($since / 1000));
            if ($limit === null) {
                $limit = $this->safe_integer($this->options, 'fetchOHLCVLimit', 1500);
            }
            $endAt = $this->sum($since, $limit * $duration);
        } else if ($limit !== null) {
            $since = $endAt - $limit * $duration;
            $request['startAt'] = intval((int) floor($since / 1000));
        }
        $request['endAt'] = intval((int) floor($endAt / 1000));
        $response = $this->publicGetMarketCandles (array_merge($request, $params));
        $data = $this->safe_value($response, 'data', array());
        return $this->parse_ohlcvs($data, $market, $timeframe, $since, $limit);
    }

    public function create_deposit_address($code, $params = array ()) {
        $this->load_markets();
        $currency = $this->currency($code);
        $request = array( 'currency' => $currency['id'] );
        $response = $this->privatePostDepositAddresses (array_merge($request, $params));
        $data = $this->safe_value($response, 'data', array());
        $address = $this->safe_string($data, 'address');
        if ($address !== null) {
            $address = str_replace('bitcoincash:', '', $address);
        }
        $tag = $this->safe_string($data, 'memo');
        if ($code !== 'NIM') {
            $this->check_address($address);
        }
        return array(
            'info' => $response,
            'currency' => $code,
            'address' => $address,
            'tag' => $tag,
        );
    }

    public function fetch_deposit_address($code, $params = array ()) {
        $this->load_markets();
        $currency = $this->currency($code);
        $request = array(
            'currency' => $currency['id'],
        );
        $networks = $this->safe_value($this->options, 'networks', array());
        $network = $this->safe_string_upper($params, 'network'); // this line allows the user to specify either ERC20 or ETH
        $network = $this->safe_string_lower($networks, $network, $network); // handle ERC20>ETH alias
        if ($network !== null) {
            $request['chain'] = $network;
            $params = $this->omit($params, 'network');
        }
        $response = $this->privateGetDepositAddresses (array_merge($request, $params));
        $data = $this->safe_value($response, 'data', array());
        $address = $this->safe_string($data, 'address');
        $tag = $this->safe_string($data, 'memo');
        if ($code !== 'NIM') {
            $this->check_address($address);
        }
        return array(
            'info' => $response,
            'currency' => $code,
            'address' => $address,
            'tag' => $tag,
            'network' => null,
        );
    }

    public function fetch_order_book($symbol, $limit = null, $params = array ()) {
        $this->load_markets();
        $marketId = $this->market_id($symbol);
        $level = $this->safe_integer($params, 'level', 2);
        $request = array( 'symbol' => $marketId );
        $method = 'publicGetMarketOrderbookLevelLevelLimit';
        $isAuthenticated = $this->check_required_credentials(false);
        $response = null;
        if (!$isAuthenticated) {
            if ($level === 2) {
                $request['level'] = $level;
                if ($limit !== null) {
                    if (($limit === 20) || ($limit === 100)) {
                        $request['limit'] = $limit;
                    } else {
                        throw new ExchangeError($this->id . ' fetchOrderBook $limit argument must be 20 or 100');
                    }
                }
                $request['limit'] = $limit ? $limit : 100;
                $method = 'publicGetMarketOrderbookLevelLevelLimit';
                $response = $this->$method (array_merge($request, $params));
            }
        } else {
            $method = 'privateGetMarketOrderbookLevel2'; // recommended (v3)
            $response = $this->$method (array_merge($request, $params));
        }
        $data = $this->safe_value($response, 'data', array());
        $timestamp = $this->safe_integer($data, 'time');
        $orderbook = $this->parse_order_book($data, $symbol, $timestamp, 'bids', 'asks', $level - 2, $level - 1);
        $orderbook['nonce'] = $this->safe_integer($data, 'sequence');
        return $orderbook;
    }

    public function create_order($symbol, $type, $side, $amount, $price = null, $params = array ()) {
        $this->load_markets();
        $marketId = $this->market_id($symbol);
        // required param, cannot be used twice
        $clientOrderId = $this->safe_string_2($params, 'clientOid', 'clientOrderId', $this->uuid());
        $params = $this->omit($params, array( 'clientOid', 'clientOrderId' ));
        $request = array(
            'clientOid' => $clientOrderId,
            'side' => $side,
            'symbol' => $marketId,
            'type' => $type,
        );
        $quoteAmount = $this->safe_number_2($params, 'cost', 'funds');
        $amountString = null;
        $costString = null;
        if ($type === 'market') {
            if ($quoteAmount !== null) {
                $params = $this->omit($params, array( 'cost', 'funds' ));
                // kucoin uses base precision even for quote values
                $costString = $this->amount_to_precision($symbol, $quoteAmount);
                $request['funds'] = $costString;
            } else {
                $amountString = $this->amount_to_precision($symbol, $amount);
                $request['size'] = $this->amount_to_precision($symbol, $amount);
            }
        } else {
            $amountString = $this->amount_to_precision($symbol, $amount);
            $request['size'] = $amountString;
            $request['price'] = $this->price_to_precision($symbol, $price);
        }
        $response = $this->privatePostOrders (array_merge($request, $params));
        $data = $this->safe_value($response, 'data', array());
        $timestamp = $this->milliseconds();
        $id = $this->safe_string($data, 'orderId');
        $order = array(
            'id' => $id,
            'clientOrderId' => $clientOrderId,
            'info' => $data,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'lastTradeTimestamp' => null,
            'symbol' => $symbol,
            'type' => $type,
            'side' => $side,
            'price' => $price,
            'amount' => $this->parse_number($amountString),
            'cost' => $this->parse_number($costString),
            'average' => null,
            'filled' => null,
            'remaining' => null,
            'status' => null,
            'fee' => null,
            'trades' => null,
        );
        return $order;
    }

    public function cancel_order($id, $symbol = null, $params = array ()) {
        $this->load_markets();
        $request = array();
        $clientOrderId = $this->safe_string_2($params, 'clientOid', 'clientOrderId');
        $method = 'privateDeleteOrdersOrderId';
        if ($clientOrderId !== null) {
            $request['clientOid'] = $clientOrderId;
            $method = 'privateDeleteOrdersClientOrderClientOid';
        } else {
            $request['orderId'] = $id;
        }
        $params = $this->omit($params, array( 'clientOid', 'clientOrderId' ));
        return $this->$method (array_merge($request, $params));
    }

    public function cancel_all_orders($symbol = null, $params = array ()) {
        $this->load_markets();
        $request = array(
        );
        $market = null;
        if ($symbol !== null) {
            $market = $this->market($symbol);
            $request['symbol'] = $market['id'];
        }
        return $this->privateDeleteOrders (array_merge($request, $params));
    }

    public function fetch_orders_by_status($status, $symbol = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array(
            'status' => $status,
        );
        $market = null;
        if ($symbol !== null) {
            $market = $this->market($symbol);
            $request['symbol'] = $market['id'];
        }
        if ($since !== null) {
            $request['startAt'] = $since;
        }
        if ($limit !== null) {
            $request['pageSize'] = $limit;
        }
        $response = $this->privateGetOrders (array_merge($request, $params));
        $responseData = $this->safe_value($response, 'data', array());
        $orders = $this->safe_value($responseData, 'items', array());
        return $this->parse_orders($orders, $market, $since, $limit);
    }

    public function fetch_closed_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        return $this->fetch_orders_by_status('done', $symbol, $since, $limit, $params);
    }

    public function fetch_open_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        return $this->fetch_orders_by_status('active', $symbol, $since, $limit, $params);
    }

    public function fetch_order($id, $symbol = null, $params = array ()) {
        $this->load_markets();
        $request = array();
        $clientOrderId = $this->safe_string_2($params, 'clientOid', 'clientOrderId');
        $method = 'privateGetOrdersOrderId';
        if ($clientOrderId !== null) {
            $request['clientOid'] = $clientOrderId;
            $method = 'privateGetOrdersClientOrderClientOid';
        } else {
            if ($id === null) {
                throw new InvalidOrder($this->id . ' fetchOrder() requires an order id');
            }
            $request['orderId'] = $id;
        }
        $params = $this->omit($params, array( 'clientOid', 'clientOrderId' ));
        $response = $this->$method (array_merge($request, $params));
        $market = null;
        if ($symbol !== null) {
            $market = $this->market($symbol);
        }
        $responseData = $this->safe_value($response, 'data');
        return $this->parse_order($responseData, $market);
    }

    public function parse_order($order, $market = null) {
        $marketId = $this->safe_string($order, 'symbol');
        $symbol = $this->safe_symbol($marketId, $market, '-');
        $orderId = $this->safe_string($order, 'id');
        $type = $this->safe_string($order, 'type');
        $timestamp = $this->safe_integer($order, 'createdAt');
        $datetime = $this->iso8601($timestamp);
        $price = $this->safe_string($order, 'price');
        $side = $this->safe_string($order, 'side');
        $feeCurrencyId = $this->safe_string($order, 'feeCurrency');
        $feeCurrency = $this->safe_currency_code($feeCurrencyId);
        $feeCost = $this->safe_number($order, 'fee');
        $amount = $this->safe_string($order, 'size');
        $filled = $this->safe_string($order, 'dealSize');
        $cost = $this->safe_string($order, 'dealFunds');
        $isActive = $this->safe_value($order, 'isActive', false);
        $cancelExist = $this->safe_value($order, 'cancelExist', false);
        $stop = $this->safe_string($order, 'stop');
        $stopTriggered = $this->safe_value($order, 'stopTriggered', false);
        $status = $isActive ? 'open' : 'closed';
        $cancelExistWithStop = $cancelExist || (!$isActive && $stop && !$stopTriggered);
        $status = $cancelExistWithStop ? 'canceled' : $status;
        $fee = array(
            'currency' => $feeCurrency,
            'cost' => $feeCost,
        );
        $clientOrderId = $this->safe_string($order, 'clientOid');
        $timeInForce = $this->safe_string($order, 'timeInForce');
        $stopPrice = $this->safe_number($order, 'stopPrice');
        $postOnly = $this->safe_value($order, 'postOnly');
        return $this->safe_order(array(
            'id' => $orderId,
            'clientOrderId' => $clientOrderId,
            'symbol' => $symbol,
            'type' => $type,
            'timeInForce' => $timeInForce,
            'postOnly' => $postOnly,
            'side' => $side,
            'amount' => $amount,
            'price' => $price,
            'stopPrice' => $stopPrice,
            'cost' => $cost,
            'filled' => $filled,
            'remaining' => null,
            'timestamp' => $timestamp,
            'datetime' => $datetime,
            'fee' => $fee,
            'status' => $status,
            'info' => $order,
            'lastTradeTimestamp' => null,
            'average' => null,
            'trades' => null,
        ), $market);
    }

    public function fetch_my_trades($symbol = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array();
        $market = null;
        if ($symbol !== null) {
            $market = $this->market($symbol);
            $request['symbol'] = $market['id'];
        }
        if ($limit !== null) {
            $request['pageSize'] = $limit;
        }
        $method = $this->options['fetchMyTradesMethod'];
        $parseResponseData = false;
        if ($method === 'private_get_fills') {
            if ($since !== null) {
                $request['startAt'] = $since;
            }
        } else if ($method === 'private_get_limit_fills') {
            $parseResponseData = true;
        } else if ($method === 'private_get_hist_orders') {
            if ($since !== null) {
                $request['startAt'] = intval($since / 1000);
            }
        } else {
            throw new ExchangeError($this->id . ' invalid fetchClosedOrder method');
        }
        $response = $this->$method (array_merge($request, $params));
        $data = $this->safe_value($response, 'data', array());
        $trades = null;
        if ($parseResponseData) {
            $trades = $data;
        } else {
            $trades = $this->safe_value($data, 'items', array());
        }
        return $this->parse_trades($trades, $market, $since, $limit);
    }

    public function fetch_trades($symbol, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $response = $this->publicGetMarketHistories (array_merge($request, $params));
        $trades = $this->safe_value($response, 'data', array());
        return $this->parse_trades($trades, $market, $since, $limit);
    }

    public function parse_trade($trade, $market = null) {
        $marketId = $this->safe_string($trade, 'symbol');
        $market = $this->safe_market($marketId, $market, '-');
        $id = $this->safe_string_2($trade, 'tradeId', 'id');
        $orderId = $this->safe_string($trade, 'orderId');
        $takerOrMaker = $this->safe_string($trade, 'liquidity');
        $timestamp = $this->safe_integer($trade, 'time');
        if ($timestamp !== null) {
            $timestamp = intval($timestamp / 1000000);
        } else {
            $timestamp = $this->safe_integer($trade, 'createdAt');
            if ((is_array($trade) && array_key_exists('dealValue', $trade)) && ($timestamp !== null)) {
                $timestamp = $timestamp * 1000;
            }
        }
        $priceString = $this->safe_string_2($trade, 'price', 'dealPrice');
        $amountString = $this->safe_string_2($trade, 'size', 'amount');
        $side = $this->safe_string($trade, 'side');
        $fee = null;
        $feeCostString = $this->safe_string($trade, 'fee');
        if ($feeCostString !== null) {
            $feeCurrencyId = $this->safe_string($trade, 'feeCurrency');
            $feeCurrency = $this->safe_currency_code($feeCurrencyId);
            if ($feeCurrency === null) {
                $feeCurrency = ($side === 'sell') ? $market['quote'] : $market['base'];
            }
            $fee = array(
                'cost' => $feeCostString,
                'currency' => $feeCurrency,
                'rate' => $this->safe_string($trade, 'feeRate'),
            );
        }
        $type = $this->safe_string($trade, 'type');
        if ($type === 'match') {
            $type = null;
        }
        $costString = $this->safe_string_2($trade, 'funds', 'dealValue');
        return $this->safe_trade(array(
            'info' => $trade,
            'id' => $id,
            'order' => $orderId,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'symbol' => $market['symbol'],
            'type' => $type,
            'takerOrMaker' => $takerOrMaker,
            'side' => $side,
            'price' => $priceString,
            'amount' => $amountString,
            'cost' => $costString,
            'fee' => $fee,
        ), $market);
    }

    public function fetch_trading_fee($symbol, $params = array ()) {
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbols' => $market['id'],
        );
        $response = $this->privateGetTradeFees (array_merge($request, $params));
        $data = $this->safe_value($response, 'data', array());
        $first = $this->safe_value($data, 0);
        $marketId = $this->safe_string($first, 'symbol');
        return array(
            'info' => $response,
            'symbol' => $this->safe_symbol($marketId, $market),
            'maker' => $this->safe_number($first, 'makerFeeRate'),
            'taker' => $this->safe_number($first, 'takerFeeRate'),
            'percentage' => true,
            'tierBased' => true,
        );
    }

    public function withdraw($code, $amount, $address, $tag = null, $params = array ()) {
        list($tag, $params) = $this->handle_withdraw_tag_and_params($tag, $params);
        $this->load_markets();
        $this->check_address($address);
        $currency = $this->currency($code);
        $request = array(
            'currency' => $currency['id'],
            'address' => $address,
            'amount' => $amount,
        );
        if ($tag !== null) {
            $request['memo'] = $tag;
        }
        $networks = $this->safe_value($this->options, 'networks', array());
        $network = $this->safe_string_upper($params, 'network');
        $network = $this->safe_string_lower($networks, $network, $network);
        if ($network !== null) {
            $request['chain'] = $network;
            $params = $this->omit($params, 'network');
        }
        $response = $this->privatePostWithdrawals (array_merge($request, $params));
        $data = $this->safe_value($response, 'data', array());
        return array(
            'id' => $this->safe_string($data, 'withdrawalId'),
            'info' => $response,
        );
    }

    public function parse_transaction_status($status) {
        $statuses = array(
            'SUCCESS' => 'ok',
            'PROCESSING' => 'ok',
            'FAILURE' => 'failed',
        );
        return $this->safe_string($statuses, $status);
    }

    public function parse_transaction($transaction, $currency = null) {
        $currencyId = $this->safe_string($transaction, 'currency');
        $code = $this->safe_currency_code($currencyId, $currency);
        $address = $this->safe_string($transaction, 'address');
        $amount = $this->safe_number($transaction, 'amount');
        $txid = $this->safe_string($transaction, 'walletTxId');
        if ($txid !== null) {
            $txidParts = explode('@', $txid);
            $numTxidParts = is_array($txidParts) ? count($txidParts) : 0;
            if ($numTxidParts > 1) {
                if ($address === null) {
                    if (strlen($txidParts[1]) > 1) {
                        $address = $txidParts[1];
                    }
                }
            }
            $txid = $txidParts[0];
        }
        $type = ($txid === null) ? 'withdrawal' : 'deposit';
        $rawStatus = $this->safe_string($transaction, 'status');
        $status = $this->parse_transaction_status($rawStatus);
        $fee = null;
        $feeCost = $this->safe_number($transaction, 'fee');
        if ($feeCost !== null) {
            $rate = null;
            if ($amount !== null) {
                $rate = $feeCost / $amount;
            }
            $fee = array(
                'cost' => $feeCost,
                'rate' => $rate,
                'currency' => $code,
            );
        }
        $tag = $this->safe_string($transaction, 'memo');
        $timestamp = $this->safe_integer_2($transaction, 'createdAt', 'createAt');
        $id = $this->safe_string_2($transaction, 'id', 'withdrawalId');
        $updated = $this->safe_integer($transaction, 'updatedAt');
        $isV1 = !(is_array($transaction) && array_key_exists('createdAt', $transaction));
        if ($isV1) {
            $type = (is_array($transaction) && array_key_exists('address', $transaction)) ? 'withdrawal' : 'deposit';
            if ($timestamp !== null) {
                $timestamp = $timestamp * 1000;
            }
            if ($updated !== null) {
                $updated = $updated * 1000;
            }
        }
        $comment = $this->safe_string($transaction, 'remark');
        return array(
            'id' => $id,
            'info' => $transaction,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'network' => null,
            'address' => $address,
            'addressTo' => $address,
            'addressFrom' => null,
            'tag' => $tag,
            'tagTo' => $tag,
            'tagFrom' => null,
            'currency' => $code,
            'amount' => $amount,
            'txid' => $txid,
            'type' => $type,
            'status' => $status,
            'comment' => $comment,
            'fee' => $fee,
            'updated' => $updated,
        );
    }

    public function fetch_deposits($code = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array();
        $currency = null;
        if ($code !== null) {
            $currency = $this->currency($code);
            $request['currency'] = $currency['id'];
        }
        if ($limit !== null) {
            $request['pageSize'] = $limit;
        }
        $method = 'privateGetDeposits';
        if ($since !== null) {
            if ($since < 1550448000000) {
                $request['startAt'] = intval($since / 1000);
                $method = 'privateGetHistDeposits';
            } else {
                $request['startAt'] = $since;
            }
        }
        $response = $this->$method (array_merge($request, $params));
        $responseData = $response['data']['items'];
        return $this->parse_transactions($responseData, $currency, $since, $limit, array( 'type' => 'deposit' ));
    }

    public function fetch_withdrawals($code = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array();
        $currency = null;
        if ($code !== null) {
            $currency = $this->currency($code);
            $request['currency'] = $currency['id'];
        }
        if ($limit !== null) {
            $request['pageSize'] = $limit;
        }
        $method = 'privateGetWithdrawals';
        if ($since !== null) {
            // if $since is earlier than 2019-02-18T00:00:00Z
            if ($since < 1550448000000) {
                $request['startAt'] = intval($since / 1000);
                $method = 'privateGetHistWithdrawals';
            } else {
                $request['startAt'] = $since;
            }
        }
        $response = $this->$method (array_merge($request, $params));
        $responseData = $response['data']['items'];
        return $this->parse_transactions($responseData, $currency, $since, $limit, array( 'type' => 'withdrawal' ));
    }

    public function fetch_balance($params = array ()) {
        $this->load_markets();
        $defaultType = $this->safe_string_2($this->options, 'fetchBalance', 'defaultType', 'trade');
        $requestedType = $this->safe_string($params, 'type', $defaultType);
        $accountsByType = $this->safe_value($this->options, 'accountsByType');
        $type = $this->safe_string($accountsByType, $requestedType);
        if ($type === null) {
            $keys = is_array($accountsByType) ? array_keys($accountsByType) : array();
            throw new ExchangeError($this->id . ' $type must be one of ' . implode(', ', $keys));
        }
        $params = $this->omit($params, 'type');
        $request = array(
            'type' => $type,
        );
        $response = $this->privateGetAccounts (array_merge($request, $params));
        $data = $this->safe_value($response, 'data', array());
        $result = array(
            'info' => $response,
            'timestamp' => null,
            'datetime' => null,
        );
        for ($i = 0; $i < count($data); $i++) {
            $balance = $data[$i];
            $balanceType = $this->safe_string($balance, 'type');
            if ($balanceType === $type) {
                $currencyId = $this->safe_string($balance, 'currency');
                $code = $this->safe_currency_code($currencyId);
                $account = $this->account();
                $account['total'] = $this->safe_string($balance, 'balance');
                $account['free'] = $this->safe_string($balance, 'available');
                $account['used'] = $this->safe_string($balance, 'holds');
                $result[$code] = $account;
            }
        }
        return $this->safe_balance($result);
    }

    public function transfer($code, $amount, $fromAccount, $toAccount, $params = array ()) {
        $this->load_markets();
        $currency = $this->currency($code);
        $requestedAmount = $this->currency_to_precision($code, $amount);
        $accountsById = $this->safe_value($this->options, 'accountsByType', array());
        $fromId = $this->safe_string($accountsById, $fromAccount);
        if ($fromId === null) {
            $keys = is_array($accountsById) ? array_keys($accountsById) : array();
            throw new ExchangeError($this->id . ' $fromAccount must be one of ' . implode(', ', $keys));
        }
        $toId = $this->safe_string($accountsById, $toAccount);
        if ($toId === null) {
            $keys = is_array($accountsById) ? array_keys($accountsById) : array();
            throw new ExchangeError($this->id . ' $toAccount must be one of ' . implode(', ', $keys));
        }
        if ($fromId === 'contract') {
            if ($toId !== 'main') {
                throw new ExchangeError($this->id . ' only supports transferring from futures account to main account');
            }
            $request = array(
                'currency' => $currency['id'],
                'amount' => $requestedAmount,
            );
            if (!(is_array($params) && array_key_exists('bizNo', $params))) {
                // it doesn't like more than 24 characters
                $request['bizNo'] = $this->uuid22();
            }
            $response = $this->futuresPrivatePostTransferOut (array_merge($request, $params));
            $data = $this->safe_value($response, 'data');
            $timestamp = $this->safe_integer($data, 'createdAt');
            $id = $this->safe_string($data, 'applyId');
            $currencyId = $this->safe_string($data, 'currency');
            $code = $this->safe_currency_code($currencyId);
            $amount = $this->safe_number($data, 'amount');
            $rawStatus = $this->safe_string($data, 'status');
            $status = null;
            if ($rawStatus === 'PROCESSING') {
                $status = 'pending';
            }
            return array(
                'info' => $response,
                'currency' => $code,
                'timestamp' => $timestamp,
                'datetime' => $this->iso8601($timestamp),
                'amount' => $amount,
                'fromAccount' => $fromId,
                'toAccount' => $toId,
                'id' => $id,
                'status' => $status,
            );
        } else {
            $request = array(
                'currency' => $currency['id'],
                'from' => $fromId,
                'to' => $toId,
                'amount' => $requestedAmount,
            );
            if (!(is_array($params) && array_key_exists('clientOid', $params))) {
                $request['clientOid'] = $this->uuid();
            }
            $response = $this->privatePostAccountsInnerTransfer (array_merge($request, $params));
            $data = $this->safe_value($response, 'data');
            $id = $this->safe_string($data, 'orderId');
            return array(
                'info' => $response,
                'id' => $id,
                'timestamp' => null,
                'datetime' => null,
                'currency' => $code,
                'amount' => $requestedAmount,
                'fromAccount' => $fromId,
                'toAccount' => $toId,
                'status' => null,
            );
        }
    }

    public function parse_ledger_entry_type($type) {
        $types = array(
            'Assets Transferred in After Upgrading' => 'transfer', // Assets Transferred in After V1 to V2 Upgrading
            'Deposit' => 'transaction', // Deposit
            'Withdrawal' => 'transaction', // Withdrawal
            'Transfer' => 'transfer', // Transfer
            'Trade_Exchange' => 'trade', // Trade
            // 'Vote for Coin' => 'Vote for Coin', // Vote for Coin
            'KuCoin Bonus' => 'bonus', // KuCoin Bonus
            'Referral Bonus' => 'referral', // Referral Bonus
            'Rewards' => 'bonus', // Activities Rewards
            // 'Distribution' => 'Distribution', // Distribution, such as get GAS by holding NEO
            'Airdrop/Fork' => 'airdrop', // Airdrop/Fork
            'Other rewards' => 'bonus', // Other rewards, except Vote, Airdrop, Fork
            'Fee Rebate' => 'rebate', // Fee Rebate
            'Buy Crypto' => 'trade', // Use credit card to buy crypto
            'Sell Crypto' => 'sell', // Use credit card to sell crypto
            'Public Offering Purchase' => 'trade', // Public Offering Purchase for Spotlight
            // 'Send red envelope' => 'Send red envelope', // Send red envelope
            // 'Open red envelope' => 'Open red envelope', // Open red envelope
            // 'Staking' => 'Staking', // Staking
            // 'LockDrop Vesting' => 'LockDrop Vesting', // LockDrop Vesting
            // 'Staking Profits' => 'Staking Profits', // Staking Profits
            // 'Redemption' => 'Redemption', // Redemption
            'Refunded Fees' => 'fee', // Refunded Fees
            'KCS Pay Fees' => 'fee', // KCS Pay Fees
            'Margin Trade' => 'trade', // Margin Trade
            'Loans' => 'Loans', // Loans
            // 'Borrowings' => 'Borrowings', // Borrowings
            // 'Debt Repayment' => 'Debt Repayment', // Debt Repayment
            // 'Loans Repaid' => 'Loans Repaid', // Loans Repaid
            // 'Lendings' => 'Lendings', // Lendings
            // 'Pool transactions' => 'Pool transactions', // Pool-X transactions
            'Instant Exchange' => 'trade', // Instant Exchange
            'Sub-account transfer' => 'transfer', // Sub-account transfer
            'Liquidation Fees' => 'fee', // Liquidation Fees
            // 'Soft Staking Profits' => 'Soft Staking Profits', // Soft Staking Profits
            // 'Voting Earnings' => 'Voting Earnings', // Voting Earnings on Pool-X
            // 'Redemption of Voting' => 'Redemption of Voting', // Redemption of Voting on Pool-X
            // 'Voting' => 'Voting', // Voting on Pool-X
            // 'Convert to KCS' => 'Convert to KCS', // Convert to KCS
        );
        return $this->safe_string($types, $type, $type);
    }

    public function parse_ledger_entry($item, $currency = null) {
        $id = $this->safe_string($item, 'id');
        $currencyId = $this->safe_string($item, 'currency');
        $code = $this->safe_currency_code($currencyId, $currency);
        $amount = $this->safe_number($item, 'amount');
        $balanceAfter = null;
        // $balanceAfter = $this->safe_number($item, 'balance'); only returns zero string
        $bizType = $this->safe_string($item, 'bizType');
        $type = $this->parse_ledger_entry_type($bizType);
        $direction = $this->safe_string($item, 'direction');
        $timestamp = $this->safe_integer($item, 'createdAt');
        $datetime = $this->iso8601($timestamp);
        $account = $this->safe_string($item, 'accountType'); // MAIN, TRADE, MARGIN, or CONTRACT
        $context = $this->safe_string($item, 'context'); // contains other information about the ledger entry
        $referenceId = null;
        if ($context !== null && $context !== '') {
            $parsed = json_decode($context, $as_associative_array = true);
            $orderId = $this->safe_string($parsed, 'orderId');
            $tradeId = $this->safe_string($parsed, 'tradeId');
            // transactions only have an $orderId but for trades we wish to use $tradeId
            if ($tradeId !== null) {
                $referenceId = $tradeId;
            } else {
                $referenceId = $orderId;
            }
        }
        $fee = null;
        $feeCost = $this->safe_number($item, 'fee');
        $feeCurrency = null;
        if ($feeCost !== 0) {
            $feeCurrency = $code;
            $fee = array( 'cost' => $feeCost, 'currency' => $feeCurrency );
        }
        return array(
            'id' => $id,
            'direction' => $direction,
            'account' => $account,
            'referenceId' => $referenceId,
            'referenceAccount' => $account,
            'type' => $type,
            'currency' => $code,
            'amount' => $amount,
            'timestamp' => $timestamp,
            'datetime' => $datetime,
            'before' => null,
            'after' => $balanceAfter, // null
            'status' => null,
            'fee' => $fee,
            'info' => $item,
        );
    }

    public function fetch_ledger($code = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $this->load_accounts();
        $request = array(
        );
        if ($since !== null) {
            $request['startAt'] = $since;
        }
        // atm only single $currency retrieval is supported
        $currency = null;
        if ($code !== null) {
            $currency = $this->currency($code);
            $request['currency'] = $currency['id'];
        }
        $response = $this->privateGetAccountsLedgers (array_merge($request, $params));
        $data = $this->safe_value($response, 'data');
        $items = $this->safe_value($data, 'items');
        return $this->parse_ledger($items, $currency, $since, $limit);
    }

    public function calculate_rate_limiter_cost($api, $method, $path, $params, $config = array (), $context = array ()) {
        $versions = $this->safe_value($this->options, 'versions', array());
        $apiVersions = $this->safe_value($versions, $api, array());
        $methodVersions = $this->safe_value($apiVersions, $method, array());
        $defaultVersion = $this->safe_string($methodVersions, $path, $this->options['version']);
        $version = $this->safe_string($params, 'version', $defaultVersion);
        if ($version === 'v3' && (is_array($config) && array_key_exists('v3', $config))) {
            return $config['v3'];
        } else if ($version === 'v2' && (is_array($config) && array_key_exists('v2', $config))) {
            return $config['v2'];
        } else if ($version === 'v1' && (is_array($config) && array_key_exists('v1', $config))) {
            return $config['v1'];
        }
        return $this->safe_integer($config, 'cost', 1);
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $versions = $this->safe_value($this->options, 'versions', array());
        $apiVersions = $this->safe_value($versions, $api, array());
        $methodVersions = $this->safe_value($apiVersions, $method, array());
        $defaultVersion = $this->safe_string($methodVersions, $path, $this->options['version']);
        $version = $this->safe_string($params, 'version', $defaultVersion);
        $params = $this->omit($params, 'version');
        $endpoint = '/api/' . $version . '/' . $this->implode_params($path, $params);
        $query = $this->omit($params, $this->extract_params($path));
        $endpart = '';
        $headers = ($headers !== null) ? $headers : array();
        if ($query) {
            if (($method === 'GET') || ($method === 'DELETE')) {
                $endpoint .= '?' . $this->urlencode($query);
            } else {
                $body = $this->json($query);
                $endpart = $body;
                $headers['Content-Type'] = 'application/json';
            }
        }
        $url = $this->urls['api'][$api] . $endpoint;
        if (($api === 'private') || ($api === 'futuresPrivate')) {
            $this->check_required_credentials();
            $timestamp = (string) $this->nonce();
            $headers = array_merge(array(
                'KC-API-KEY-VERSION' => '2',
                'KC-API-KEY' => $this->apiKey,
                'KC-API-TIMESTAMP' => $timestamp,
            ), $headers);
            $apiKeyVersion = $this->safe_string($headers, 'KC-API-KEY-VERSION');
            if ($apiKeyVersion === '2') {
                $passphrase = $this->hmac($this->encode($this->password), $this->encode($this->secret), 'sha256', 'base64');
                $headers['KC-API-PASSPHRASE'] = $passphrase;
            } else {
                $headers['KC-API-PASSPHRASE'] = $this->password;
            }
            $payload = $timestamp . $method . $endpoint . $endpart;
            $signature = $this->hmac($this->encode($payload), $this->encode($this->secret), 'sha256', 'base64');
            $headers['KC-API-SIGN'] = $signature;
            $partner = $this->safe_value($this->options, 'partner', array());
            $partnerId = $this->safe_string($partner, 'id');
            $partnerSecret = $this->safe_string($partner, 'secret');
            if (($partnerId !== null) && ($partnerSecret !== null)) {
                $partnerPayload = $timestamp . $partnerId . $this->apiKey;
                $partnerSignature = $this->hmac($this->encode($partnerPayload), $this->encode($partnerSecret), 'sha256', 'base64');
                $headers['KC-API-PARTNER-SIGN'] = $partnerSignature;
                $headers['KC-API-PARTNER'] = $partnerId;
            }
        }
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }

    public function handle_errors($code, $reason, $url, $method, $headers, $body, $response, $requestHeaders, $requestBody) {
        if (!$response) {
            $this->throw_broadly_matched_exception($this->exceptions['broad'], $body, $body);
            return;
        }
        $errorCode = $this->safe_string($response, 'code');
        $message = $this->safe_string($response, 'msg', '');
        $feedback = $this->id . ' ' . $message;
        $this->throw_exactly_matched_exception($this->exceptions['exact'], $message, $feedback);
        $this->throw_exactly_matched_exception($this->exceptions['exact'], $errorCode, $feedback);
        $this->throw_broadly_matched_exception($this->exceptions['broad'], $body, $feedback);
    }
}
