<?php
namespace Vendor\DatabaseModule\Setup;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, 
    \Magento\Framework\Setup\ModuleContextInterface $context){
        $installer = $setup;
		$installer->startSetup();
        if (version_compare($context->getVersion(), '2.0.1') < 0) {

            if (!$installer->tableExists('vendor_second_test')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('vendor_second_test')
                )
                    ->addColumn(
                        'id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'upgrade id'
                    )
                    ->addColumn(
                        'upgrade_details',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Upgrade details'
                    )
                    ->addColumn(
                        'some_text',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        1000,
                        [],
                        'some text to store information'
                    )
                    ->setComment('Sample upgrade table');
                $installer->getConnection()->createTable($table);
            }

        }

        $installer->endSetup();
    }
}