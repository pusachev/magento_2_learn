<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace SP\Events\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

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
            ->newTable($installer->getTable('sp_events'))
            ->addColumn(
                'event_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Event ID'
            )
            ->addColumn(
                'short_description',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true,
                    'default' => null
                ],
                'Events description'
            )
            ->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'Event Title'
            )
            ->addColumn(
                'image',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'Image'
            )
            ->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false,
                    'default' => '1'
                ],
                'Is Event Active?'
            )
            ->addColumn(
                'display_from',
                Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false
                ],
                'Display From'
            )
            ->addColumn(
                'display_to',
                Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false
                ],
                'Display To'
            )
            //->addIndex($installer->getIdxName('blog_post', ['url_key']), ['url_key'])
            ->setComment('SP Events table');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
