<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241122225328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->addSql('CREATE TABLE tasks (
            id VARCHAR(255) NOT NULL, 
            name VARCHAR(255) NOT NULL, 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sessions (
            id VARCHAR(36) NOT NULL, 
            task_id VARCHAR(36) DEFAULT NULL, 
            start_time DATETIME(3) NOT NULL, 
            end_time DATETIME(3) DEFAULT NULL, 
            total_time DECIMAL(5, 3) DEFAULT NULL, 
            INDEX IDX_9A609D138DB60186 (task_id), 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE sessions 
            ADD CONSTRAINT FK_9A609D138DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id)'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D138DB60186');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP TABLE tasks');
    }
}
