<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    use Concerns\ResponseParameters;
    use Concerns\ResponseSignatureValidation;

    /**
     * Trả về trạng thái do MoMo phản hồi.
     *
     * @return bool
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function isSuccessful(): bool
    {
        if (0 === $this->getErrorCode()) {
            $requestParameters = $this->request->getParameters();
            $this->validateSignature($requestParameters['secretKey']);

            return true;
        }

        return false;
    }
}
