<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Model\Plugin;


class Product
{

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result += 10;
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $result .= ' Spalah';
        return $result;
    }
}