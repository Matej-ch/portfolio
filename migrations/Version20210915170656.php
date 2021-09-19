<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210915170656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language CHANGE type type VARCHAR(512) NOT NULL');
        $this->addSql('ALTER TABLE project_state CHANGE description description VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD is_active INT NOT NULL DEFAULT 1');
        $this->addSql('DROP INDEX series ON rememberme_token');
        $this->addSql('ALTER TABLE rememberme_token CHANGE series series VARCHAR(88) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language CHANGE type type VARCHAR(512) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE project_state CHANGE description description VARCHAR(1024) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE rememberme_token CHANGE series series CHAR(88) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('CREATE UNIQUE INDEX series ON rememberme_token (series)');
        $this->addSql('ALTER TABLE tag DROP is_active');
    }
}
