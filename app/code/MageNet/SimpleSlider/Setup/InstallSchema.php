<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace MageNet\SimpleSlider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

use MageNet\SimpleSlider\Api\Data\SliderInterface;

class InstallSchema implements InstallSchemaInterface
{
    /** {@inheritdoc} */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable(SliderInterface::SLIDER_TABLE_NAME))
            ->addColumn(
                SliderInterface::ID_COLUMN_NAME,
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Slider ID'
            )
            ->addColumn(
                SliderInterface::DESCRIPTION_COLUMN_NAME,
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true,
                    'default' => null
                ],
                'Slider description'
            )
            ->addColumn(
                SliderInterface::ALT_COLUMN_NAME,
                Table::TYPE_TEXT,
                64,
                [
                    'nullable' => true
                ],
                'Slider image alt'
            )
            ->addColumn(
                SliderInterface::IMAGE_COLUMN_NAME,
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'Slider image'
            )
            ->addColumn(
                SliderInterface::STATUS_COLUMN_NAME,
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false,
                    'default' => '1'
                ],
                'Slider image status'
            )
            ->addColumn(
                SliderInterface::DISPLAY_FROM_COLUMN_NAME,
                Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => true
                ],
                'Slider image display date from'
            )
            ->addColumn(
                SliderInterface::DISPLAY_TO_COLUMN_NAME,
                Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false
                ],
                'Slider image display to'
            )
            ->addColumn(
                SliderInterface::URL_COLUMN_NAME,
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true,
                    'default' => null
                ],
                'Slider url'
            )
            ->setComment('MageNet SimpleSlider table');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
