<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522095931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre ADD age_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99CC80CD12 FOREIGN KEY (age_id) REFERENCES age (id)');
        $this->addSql('CREATE INDEX IDX_AC634F99CC80CD12 ON livre (age_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99CC80CD12');
        $this->addSql('DROP INDEX IDX_AC634F99CC80CD12 ON livre');
        $this->addSql('ALTER TABLE livre DROP age_id');
    }
}
