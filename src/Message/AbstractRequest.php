<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbtractRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractRequest extends BaseAbtractRequest
{
    use Concerns\RequestEndpoint;
    use Concerns\RequestSignature;
    use Concerns\RequestParameters;

    /**
     * @inheritDoc
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('partnerCode', 'accessKey', 'requestId', 'orderId', 'secretKey');

        return [];
    }
}
