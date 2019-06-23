<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait PurchasedResponseParameters
{
    /**
     * Dữ liệu từ MoMo.
     *
     * @var array
     */
    protected $data;

    /**
     * Số tiền của đơn hàng.
     *
     * @return string
     */
    public function getAmount(): string
    {
        return $this->data['amount'];
    }

    /**
     * Trả về mã giao dịch của MoMo.
     *
     * @return string
     */
    public function getTransId(): string
    {
        return $this->data['transId'];
    }

    /**
     * Trả về partner code của đơn hàng.
     *
     * @return string
     */
    public function getPartnerCode(): string
    {
        return $this->data['partnerCode'];
    }

    /**
     * Trả về access key của đơn hàng.
     *
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->data['accessKey'];
    }
}
