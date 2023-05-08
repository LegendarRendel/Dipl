<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508085854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'added default primary key';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE shop_cart_id_seq');
        $this->addSql('SELECT setval(\'shop_cart_id_seq\', (SELECT MAX(id) FROM shop_cart))');
        $this->addSql('ALTER TABLE shop_cart ALTER id SET DEFAULT nextval(\'shop_cart_id_seq\')');
        $this->addSql('CREATE SEQUENCE shop_items_id_seq');
        $this->addSql('SELECT setval(\'shop_items_id_seq\', (SELECT MAX(id) FROM shop_items))');
        $this->addSql('ALTER TABLE shop_items ALTER id SET DEFAULT nextval(\'shop_items_id_seq\')');
        $this->addSql('CREATE SEQUENCE shop_order_id_seq');
        $this->addSql('SELECT setval(\'shop_order_id_seq\', (SELECT MAX(id) FROM shop_order))');
        $this->addSql('ALTER TABLE shop_order ALTER id SET DEFAULT nextval(\'shop_order_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop_items ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE shop_cart ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE shop_order ALTER id DROP DEFAULT');
    }
}
