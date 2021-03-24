<?php

namespace OCA\sciencemesh\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use OCP\Migration\ISchemaMigration;

class Version20210324134421 implements ISchemaMigration
{
	public function changeSchema(Schema $schema, array $options)
	{
		$prefix = $options['tablePrefix'];

		// Drop any previous version, as the settings have changed completely
		if ($schema->hasTable("{$prefix}sciencemesh")) {
			$schema->dropTable("{$prefix}sciencemesh");
		}

		$table = $schema->createTable("{$prefix}sciencemesh");
		$table->addColumn('apikey', 'string', [
			'notnull' => true,
		]);
		$table->addColumn('sitename', 'string', [
			'notnull' => true,
		]);
		$table->addColumn('siteurl', 'string', [
			'notnull' => true,
		]);
		$table->addColumn('country', 'string', [
			'notnull' => true,
			'length' => 3,
		]);
		$table->addColumn('iopurl', 'string', [
			'notnull' => true,
		]);
		$table->addColumn('numusers', Type::BIGINT, [
			'notnull' => true,
			'default' => 0,
			'unsigned' => true,
		]);
		$table->addColumn('numfiles', Type::BIGINT, [
			'notnull' => true,
			'default' => 0,
			'unsigned' => true,
		]);
		$table->addColumn('numstorage', Type::BIGINT, [
			'notnull' => true,
			'default' => 0,
			'unsigned' => true,
		]);
	}
}
