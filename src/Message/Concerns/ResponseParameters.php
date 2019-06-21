<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait ResponseParameters
{
    /**
     * Dữ liệu từ MoMo.
     *
     * @var array
     */
    protected $data;

    /**
     * Trả về mã báo lỗi từ MoMo. Nếu là 0 thì tương đương với thành công.
     *
     * @return int
     */
    public function getErrorCode(): int
    {
        return (int) $this->data['errorCode'];
    }

    /**
     * Trả về thông báo từ MoMo.
     */
    public function getMessage(): string
    {
        return $this->data['message'];
    }

    /**
     * Trả về message tiếng việt.
     *
     * @return string
     */
    public function getLocalMessage(): string
    {
        return $this->data['localMessage'];
    }

    /**
     * Trả về giống với request id đã gửi lên MoMo.
     *
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->data['requestId'];
    }

    /**
     * Trả về request type.
     *
     * @return string
     */
    public function getRequestType(): string
    {
        return $this->data['requestType'];
    }

    /**
     * Trả về mã đơn hàng, dùng để đối soát.
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->data['orderId'];
    }
}
