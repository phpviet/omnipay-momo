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
    use Concerns\ResponseSignatureValidator;

    /**
     * Create new Response instance.
     *
     * @param  RequestInterface  $request
     * @param $data
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        $requestParameters = $request->getParameters();
        $this->validateSignature($requestParameters['secretKey']);
    }
}
