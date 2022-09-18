<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220918203648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD readme_is_enabled TINYINT(1) DEFAULT NULL');
        $this->addSql('DROP INDEX `primary` ON user_info_service');
        $this->addSql('ALTER TABLE user_info_service ADD PRIMARY KEY (user_info_id, service_id)');
        $this->addSql('ALTER TABLE user_info_service RENAME INDEX idx_e99947d4586dff2 TO IDX_E394CF4E586DFF2');
        $this->addSql('ALTER TABLE user_info_service RENAME INDEX idx_e99947d4ed5ca9e6 TO IDX_E394CF4EED5CA9E6');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP readme_is_enabled');
        $this->addSql('DROP INDEX `PRIMARY` ON user_info_service');
        $this->addSql('ALTER TABLE user_info_service ADD PRIMARY KEY (service_id, user_info_id)');
        $this->addSql('ALTER TABLE user_info_service RENAME INDEX idx_e394cf4e586dff2 TO IDX_E99947D4586DFF2');
        $this->addSql('ALTER TABLE user_info_service RENAME INDEX idx_e394cf4eed5ca9e6 TO IDX_E99947D4ED5CA9E6');
    }
}
