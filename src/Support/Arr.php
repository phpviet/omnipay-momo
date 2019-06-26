<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Support;

class Arr
{
    /**
     * Hổ trợ lấy giá trị trong mảng với định dạng 'a.b.c'.
     *
     * @param  mixed  $element
     * @param  array  $arr
     * @param  null  $default
     * @return mixed
     */
    public static function getValue($element, array $arr, $default = null)
    {
        while (false !== ($pos = strpos($element, '.'))) {
            $sub = substr($element, 0, $pos);
            $element = substr($element, $pos + 1);

            if (isset($arr[$sub]) && is_array($arr[$sub])) {
                $arr = $arr[$sub];
            } else {
                break;
            }
        }

        if (false === strpos($element, '.')) {
            return $arr[$element] ?? $default;
        }

        return $default;
    }
}
