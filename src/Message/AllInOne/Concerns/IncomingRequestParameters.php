<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne\Concerns;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait IncomingRequestParameters
{
    /**
     * {@inheritdoc}
     */
    protected function getIncomingParameters(): array
    {
        $data = [];
        $params = [
            'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'orderInfo', 'orderType', 'transId',
            'message', 'localMessage', 'responseTime', 'errorCode', 'extraData', 'signature', 'payType',
        ];
        $bag = $this->getIncomingParameterBag();

        foreach ($params as $param) {
            $data[$param] = $bag->get($param);
        }

        return $data;
    }

    /**
     * Trả về request parameter bag.
     *
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     */
    abstract protected function getIncomingParameterBag(): ParameterBag;
}
