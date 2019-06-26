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
trait ResponseProperties
{
    /**
     * Phương thức hổ trợ tạo các thuộc tính của đối tượng từ dữ liệu gửi về từ MoMo.
     *
     * @param  string  $name
     * @return null|string
     */
    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            trigger_error(sprintf('Undefined property: %s::%s', __CLASS__, '$'.$name), E_USER_NOTICE);

            return;
        }
    }

    /**
     * Phương thức hổ trợ bảo vệ các thuộc tính của đối tượng từ dữ liệu gửi về từ MoMo.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return null|string
     */
    public function __set($name, $value)
    {
        if (isset($this->data[$name])) {
            trigger_error(sprintf('Undefined property: %s::%s', __CLASS__, '$'.$name), E_USER_NOTICE);
        } else {
            $this->$name = $value;
        }
    }
}
