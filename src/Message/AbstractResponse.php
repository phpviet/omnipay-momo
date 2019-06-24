<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * Phương thức hổ trợ tạo các thuộc tính của đối tượng từ dữ liệu gửi về từ MoMo.
     *
     * @param  string  $name
     * @return null|string
     */
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}
