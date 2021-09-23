<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210915200707 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_tag (tag_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_1D82FD44BAD26311 (tag_id), INDEX IDX_1D82FD44166D1F9C (project_id), PRIMARY KEY(tag_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_tag ADD CONSTRAINT FK_1D82FD44BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_tag ADD CONSTRAINT FK_1D82FD44166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_tag CHANGE is_active is_active INT DEFAULT 1 NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE project_tag');
        $this->addSql('ALTER TABLE project CHANGE is_active is_active INT NOT NULL');
    }
}
