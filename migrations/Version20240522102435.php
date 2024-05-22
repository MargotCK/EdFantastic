<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522102435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_theme (livre_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_4767F6E37D925CB (livre_id), INDEX IDX_4767F6E59027487 (theme_id), PRIMARY KEY(livre_id, theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_auteur (livre_id INT NOT NULL, auteur_id INT NOT NULL, INDEX IDX_A11876B537D925CB (livre_id), INDEX IDX_A11876B560BB6FE6 (auteur_id), PRIMARY KEY(livre_id, auteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_user (livre_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_87F42DC437D925CB (livre_id), INDEX IDX_87F42DC4A76ED395 (user_id), PRIMARY KEY(livre_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_commande (livre_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_22140D437D925CB (livre_id), INDEX IDX_22140D482EA2E54 (commande_id), PRIMARY KEY(livre_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_theme ADD CONSTRAINT FK_4767F6E37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_theme ADD CONSTRAINT FK_4767F6E59027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B560BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_user ADD CONSTRAINT FK_87F42DC437D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_user ADD CONSTRAINT FK_87F42DC4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_commande ADD CONSTRAINT FK_22140D437D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_commande ADD CONSTRAINT FK_22140D482EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre ADD genre_id INT DEFAULT NULL, ADD illustrateur_id INT DEFAULT NULL, ADD serie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F994296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F991E7BF113 FOREIGN KEY (illustrateur_id) REFERENCES illustrateur (id)');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('CREATE INDEX IDX_AC634F994296D31F ON livre (genre_id)');
        $this->addSql('CREATE INDEX IDX_AC634F991E7BF113 ON livre (illustrateur_id)');
        $this->addSql('CREATE INDEX IDX_AC634F99D94388BD ON livre (serie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre_theme DROP FOREIGN KEY FK_4767F6E37D925CB');
        $this->addSql('ALTER TABLE livre_theme DROP FOREIGN KEY FK_4767F6E59027487');
        $this->addSql('ALTER TABLE livre_auteur DROP FOREIGN KEY FK_A11876B537D925CB');
        $this->addSql('ALTER TABLE livre_auteur DROP FOREIGN KEY FK_A11876B560BB6FE6');
        $this->addSql('ALTER TABLE livre_user DROP FOREIGN KEY FK_87F42DC437D925CB');
        $this->addSql('ALTER TABLE livre_user DROP FOREIGN KEY FK_87F42DC4A76ED395');
        $this->addSql('ALTER TABLE livre_commande DROP FOREIGN KEY FK_22140D437D925CB');
        $this->addSql('ALTER TABLE livre_commande DROP FOREIGN KEY FK_22140D482EA2E54');
        $this->addSql('DROP TABLE livre_theme');
        $this->addSql('DROP TABLE livre_auteur');
        $this->addSql('DROP TABLE livre_user');
        $this->addSql('DROP TABLE livre_commande');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F994296D31F');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F991E7BF113');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99D94388BD');
        $this->addSql('DROP INDEX IDX_AC634F994296D31F ON livre');
        $this->addSql('DROP INDEX IDX_AC634F991E7BF113 ON livre');
        $this->addSql('DROP INDEX IDX_AC634F99D94388BD ON livre');
        $this->addSql('ALTER TABLE livre DROP genre_id, DROP illustrateur_id, DROP serie_id');
    }
}
