<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateRandomness implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('randomness', function (Mapping $mapping, Settings $settings) {
            // to add a new field to the mapping use method name as a field type (in Camel Case),
            // first argument as a field name and optional second argument for additional field parameters
            $mapping->keyword('company');
            $mapping->text('phone_number');
            $mapping->text('description');
            $mapping->keyword('type');
            $mapping->text('iban');
            $mapping->text('pan');
            $mapping->long('cvv');
            $mapping->text('expiration');
            $mapping->text('hex_color');
            $mapping->text('country');
            $mapping->geoPoint('location');
            $mapping->date('birthday', ['format' => 'yyyy-MM-dd']);
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::drop('randomness_index');
    }
}
