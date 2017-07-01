<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Model;

use Magento\Catalog\Model\Product as BaseProduct;

class Product extends BaseProduct
{
    public function getName()
    {
        $name = parent::getName();

        return sprintf("%s_Spalah", $name);
    }
}
