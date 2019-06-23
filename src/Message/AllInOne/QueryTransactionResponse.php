<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QueryTransactionResponse extends AbstractResponse
{
    use Concerns\PurchasedResponseParameters;

    /**
     * Trả về phương thức mà khách đã thanh toán.
     *
     * @return string
     */
    public function getPayType(): string
    {
        return $this->data['payType'];
    }

    /**
     * Trả về giống với extra data đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getExtraData(): string
    {
        return $this->data['extraData'];
    }
}
