<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522111156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre_commande DROP FOREIGN KEY FK_22140D437D925CB');
        $this->addSql('ALTER TABLE livre_commande DROP FOREIGN KEY FK_22140D482EA2E54');
        $this->addSql('DROP TABLE livre_commande');
        $this->addSql('ALTER TABLE adresse_livraison ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse_livraison ADD CONSTRAINT FK_B0B09C982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_B0B09C982EA2E54 ON adresse_livraison (commande_id)');
        $this->addSql('ALTER TABLE commande ADD historique_id INT DEFAULT NULL, ADD adresse_facture_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6128735E FOREIGN KEY (historique_id) REFERENCES historique (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D10309E7F FOREIGN KEY (adresse_facture_id) REFERENCES adresse_facture (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D6128735E ON commande (historique_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D10309E7F ON commande (adresse_facture_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('ALTER TABLE ligne_commande ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B82EA2E54 ON ligne_commande (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_commande (livre_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_22140D437D925CB (livre_id), INDEX IDX_22140D482EA2E54 (commande_id), PRIMARY KEY(livre_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livre_commande ADD CONSTRAINT FK_22140D437D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_commande ADD CONSTRAINT FK_22140D482EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse_livraison DROP FOREIGN KEY FK_B0B09C982EA2E54');
        $this->addSql('DROP INDEX IDX_B0B09C982EA2E54 ON adresse_livraison');
        $this->addSql('ALTER TABLE adresse_livraison DROP commande_id');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6128735E');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D10309E7F');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP INDEX IDX_6EEAA67D6128735E ON commande');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D10309E7F ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('ALTER TABLE commande DROP historique_id, DROP adresse_facture_id, DROP user_id');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('DROP INDEX IDX_3170B74B82EA2E54 ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP commande_id');
    }
}
