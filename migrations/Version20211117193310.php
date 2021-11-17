<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117193310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product ADD uuid VARCHAR NULL');
        $this->addSql("UPDATE product SET uuid='0' WHERE uuid IS NULL;");
        $this->addSql('ALTER TABLE product ALTER uuid SET NOT NULL');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product  DROP COLUMN uuid');

    }
}
