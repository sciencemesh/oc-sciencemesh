<?php

namespace OCA\ScienceMesh\Migrations;

use OCP\Migration\ISchemaMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

/**
 * Create initial tables for the app
 */
class Version010000Date20210118175358 implements ISchemaMigration {

    /** @var  string */
    private $prefix;

    /**
     - @param Schema $schema
     - @param [] $options
     */
    public function changeSchema(Schema $schema, array $options) {
        $this->prefix = $options['tablePrefix'];

        if (!$schema->hasTable("{$this->prefix}sciencemesh")) {
            $table = $schema->createTable("{$this->prefix}sciencemesh");
            $table->addColumn('iopurl', 'string', [
              'notnull' => true,
              'default' => 'http://localhost:10999',
            ]);
            $table->addColumn('country', 'string', [
              'notnull' => true,
              'length' => 2,
            ]);
            $table->addColumn('hostname', 'string', [
              'notnull' => true,
              'default' => 'example.org',
            ]);
            $table->addColumn('sitename', 'string', [
              'notnull' => true,
              'default' => 'CERNBox',
            ]);
            $table->addColumn('siteurl', 'string', [
              'notnull' => true,
              'default' => 'http://localhost',
            ]);
            $table->addColumn('numusers', Type::BIGINT, [
              'notnull' => true,
              'notnull' => false,
              'default' => 0,
              'unsigned' => true,
            ]);
            $table->addColumn('numfiles', Type::BIGINT, [
              'notnull' => true,
              'notnull' => false,
              'default' => 0,
              'unsigned' => true,
            ]);
            $table->addColumn('numstorage', Type::BIGINT, [
              'notnull' => true,
              'notnull' => false,
              'default' => 0,
              'unsigned' => true,
            ]);
        }
    }
}
