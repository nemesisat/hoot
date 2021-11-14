<?php

namespace Test\CommissionSystem\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class InstallSchema implements InstallSchemaInterface
{
    /**
     * Function install
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('test_commissionsystem')
        )->addColumn(
            'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 11,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'ID'
        )->addColumn(
            'customer_id', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255,
            [
                'unsigned' => false,
                'nullable' => false
            ], 'CustomerId'
        )->addColumn(
            'balance_customer', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255,
            [
                'unsigned' => false,
                'nullable' => false
            ], 'Balance Customer'
        )->addColumn(
            'status', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255,
            [
                'unsigned' => false,
                'nullable' => false
            ], 'Status'
        );
        $installer->getConnection()->createTable($table);


    }
}
