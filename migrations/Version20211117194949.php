<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117194949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(" ALTER TABLE users ADD is_deleted BOOLEAN NULL; ");

        $this->addSql("UPDATE users SET is_deleted='0' WHERE is_deleted IS NULL;");

        $this->addSql("ALTER TABLE users ALTER is_deleted SET NOT NULL;");

    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users  DROP COLUMN is_deleted');
    }
}
