<?php
namespace Vendor\DatabaseModule\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();

		if (!$installer->tableExists('vendor_test_1')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('vendor_test_1')
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
					'test id'
				)
				->addColumn(
					'test_name',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable' => true],
					'Test Name'
				)
				->setComment('Table created for test1');
			$installer->getConnection()->createTable($table);
		}
		$installer->endSetup();
	}
}
