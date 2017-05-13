<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

use SP\Slider\Model\CarouselFactory;
use SP\Slider\Model\Carousel;
use SP\Slider\Api\Data\CarouselInterface;

class InstallData implements InstallDataInterface
{
    /** @var CarouselFactory */
    protected $carouselFactory;

    public function __construct(CarouselFactory $carouselFactory)
    {
        $this->carouselFactory = $carouselFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $data = [
            [
                CarouselInterface::CAROUSEL_IMAGE => 'test1.jpg',
                CarouselInterface::CAROUSEL_ALT => 'test1'
            ],
            [
                CarouselInterface::CAROUSEL_IMAGE => 'test2.jpg',
                CarouselInterface::CAROUSEL_ALT => 'test2'
            ],
            [
                CarouselInterface::CAROUSEL_IMAGE => 'test3.jpg',
                CarouselInterface::CAROUSEL_ALT => 'test3'
            ],
            [
                CarouselInterface::CAROUSEL_IMAGE => 'test4.jpg',
                CarouselInterface::CAROUSEL_ALT => 'test4'
            ],
        ];

        foreach ($data as $item) {
            $this->createCarousel()->setData($item)->save();
        }

        $setup->endSetup();
    }

    /**
     * @return Carousel
     */
    protected function createCarousel()
    {
        return $this->carouselFactory->create();
    }
}