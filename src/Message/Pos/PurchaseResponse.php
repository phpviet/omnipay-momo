<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Pos;

use Omnipay\MoMo\Message\AbstractResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseResponse extends AbstractResponse
{
    /**
     * Mã trạng thái gửi về từ MoMo.
     *
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->data['status'] ?? null;
    }
}
