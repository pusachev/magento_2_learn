<?php

namespace SP\Events\Test\Unit\Block;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

use SP\Events\Block\Events;

class EventsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Events
     */
    protected $block;

    public function setUp()
    {
        $objectManager = new ObjectManagerHelper($this);
        $this->urlBuilder = $this->getMock(\Magento\Framework\UrlInterface::class);
        $this->block = $objectManager->getObject(
            Events::class,
            ['urlBuilder' => $this->urlBuilder]
        );
//        //$this->model = $objectManager->getObject('SP\Events\Model\Event');
//        $reflection = new \ReflectionClass($this->block);
//        $reflectionProperty = $reflection->getProperty('_idFieldName');
//        $reflectionProperty->setAccessible(true);
//        $reflectionProperty->setValue($this->block, 'event_id');
//        $this->block->setId(1);
    }

    public function testGetEvents()
    {
        $this->assertTrue(true);
    }
}
