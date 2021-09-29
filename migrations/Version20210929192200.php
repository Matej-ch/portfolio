<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929192200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE external_site ADD is_personal TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE project_tag DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE project_tag ADD PRIMARY KEY (project_id, tag_id)');
        $this->addSql('ALTER TABLE project_tag RENAME INDEX idx_1d82fd44166d1f9c TO IDX_91F26D60166D1F9C');
        $this->addSql('ALTER TABLE project_tag RENAME INDEX idx_1d82fd44bad26311 TO IDX_91F26D60BAD26311');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE external_site DROP is_personal');
        $this->addSql('ALTER TABLE project_tag DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE project_tag ADD PRIMARY KEY (tag_id, project_id)');
        $this->addSql('ALTER TABLE project_tag RENAME INDEX idx_91f26d60166d1f9c TO IDX_1D82FD44166D1F9C');
        $this->addSql('ALTER TABLE project_tag RENAME INDEX idx_91f26d60bad26311 TO IDX_1D82FD44BAD26311');
    }
}
