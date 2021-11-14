<?php
/**
 * Copyright (c) 2017. Eyewa. All rights reserved.
 */

namespace Test\CommissionSystem\Setup;

use Magento\Framework\Setup\{
    ModuleContextInterface,
    ModuleDataSetupInterface,
    InstallDataInterface
};
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory,
    \Magento\Sales\Setup\SalesSetupFactory $salesSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->salesSetupFactory = $salesSetupFactory;

    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'commission_category', [
            'type'     => 'varchar',
            'label'    => 'Category Commission',
            'input'    => 'text',
            'required' => true,
            'user_defined' => true,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group'    => 'General Information'
        ]);


        $eavSetup->addAttribute( \Magento\Catalog\Model\Product::ENTITY, 'commission_product', [
            'type'     => 'varchar',
            'label'    => ' Product Commission',
            'input'    => 'text',
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'visible' => true,
            'required' => true,
            'user_defined' => true,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => ''
        ]);

        $salesSetup = $this->salesSetupFactory->create(['resourceName' => 'sales_setup', 'setup' => $setup]);

        $salesSetup->addAttribute(Order::ENTITY, 'commisionamount', [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            'length'=> 255,
            'visible' => false,
            'nullable' => true
        ]);

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'commisionamount',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'comment' =>'Commission value'
            ]
        );
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'commisionvalue',
            [
                'type'         => 'varchar',
                'label'        => 'Commission Value',
                'input'        => 'text',
                'required'     => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 999,
                'system'       => 0,
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'commissionstatus',
            [
                'type'         => 'varchar',
                'label'        => 'Commission status',
                'input'        => 'text',
                'required'     => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 999,
                'system'       => 0,
            ]
        );
    }
}

