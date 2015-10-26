<?php
namespace Craft;

/**
 * The class name is the UTC timestamp in the format of mYYMMDD_HHMMSS_pluginHandle_migrationName
 */
class m141020_120000_simplemeta_add_changefrequency_fields extends BaseMigration
{
	/**
	 * Any migration code in here is wrapped inside of a transaction.
	 *
	 * @return bool
	 */
	public function safeUp()
	{
		$chargesTable = $this->dbConnection->schema->getTable('{{simplemeta}}');

		if ($chargesTable->getColumn('seoSitemapChangeFrequency') === null)
		{
			// Add the 'hash' column to the charges table
			$this->addColumnAfter('simplemeta', 'seoSitemapChangeFrequency', array('column' => ColumnType::Varchar), 'seoRobotsIndex');
		}

		return true;
	}
}
