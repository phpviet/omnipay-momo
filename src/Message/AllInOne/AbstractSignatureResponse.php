<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

use Omnipay\MoMo\Message\AbstractSignatureResponse as BaseAbstractSignatureResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractSignatureResponse extends BaseAbstractSignatureResponse
{
    /**
     * Trả về mã báo lỗi từ MoMo. Nếu là 0 thì tương đương với thành công.
     *
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->data['errorCode'] ?? null;
    }

    /**
     * Trả về mã đơn hàng, dùng để đối soát.
     *
     * @return null|string
     */
    public function getTransactionId(): ?string
    {
        return $this->data['orderId'] ?? null;
    }

    /**
     * Trả về transaction reference theo Response.
     *
     * @return null|string
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['transId'] ?? null;
    }
}
