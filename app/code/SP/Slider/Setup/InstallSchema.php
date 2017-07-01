<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Slider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

use SP\Slider\Api\Data\CarouselInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable(CarouselInterface::CAROUSEL_TABLE))
            ->addColumn(
                CarouselInterface::CAROUSEL_ID,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Carousel ID'
            )
            ->addColumn(
                CarouselInterface::CAROUSEL_IMAGE,
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true,
                    'default' => null
                ],
                'Image'
            )
            ->addColumn(
                CarouselInterface::CAROUSEL_ALT,
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'Event Title'
            )
            ->setComment('SP Events table');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}