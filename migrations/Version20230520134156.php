<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520134156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop_items ADD osmax TEXT NOT NULL');
        $this->addSql('ALTER TABLE shop_items ADD processor_max TEXT NOT NULL');
        $this->addSql('ALTER TABLE shop_items ADD memory_max TEXT NOT NULL');
        $this->addSql('ALTER TABLE shop_items ADD graphics_max TEXT NOT NULL');
        $this->addSql('ALTER TABLE shop_items ADD direct_xmax TEXT NOT NULL');
        $this->addSql('ALTER TABLE shop_items ADD hard_drive_max TEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE shop_items DROP osmax');
        $this->addSql('ALTER TABLE shop_items DROP processor_max');
        $this->addSql('ALTER TABLE shop_items DROP memory_max');
        $this->addSql('ALTER TABLE shop_items DROP graphics_max');
        $this->addSql('ALTER TABLE shop_items DROP direct_xmax');
        $this->addSql('ALTER TABLE shop_items DROP hard_drive_max');
    }
}
