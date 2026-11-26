<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261124160250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jeu_categorie (jeu_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_E337000C8C9E392E (jeu_id), INDEX IDX_E337000CBCF5E72D (categorie_id), PRIMARY KEY (jeu_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE jeu_categorie ADD CONSTRAINT FK_E337000C8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeu_categorie ADD CONSTRAINT FK_E337000CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_categorie DROP FOREIGN KEY `FK_50ED1EBF8C9E392E`');
        $this->addSql('ALTER TABLE oeuvre_categorie DROP FOREIGN KEY `FK_50ED1EBFBCF5E72D`');
        $this->addSql('DROP TABLE oeuvre_categorie');
        $this->addSql('ALTER TABLE jeu CHANGE nb_joueurs nb_joueurs INT NOT NULL, CHANGE duree_moyenne duree_moyenne DOUBLE PRECISION NOT NULL, CHANGE age_minimum age_minimum INT NOT NULL');
        $this->addSql('ALTER TABLE soiree CHANGE nb_max_participants nb_max_participants INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE oeuvre_categorie (jeu_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_50ED1EBF8C9E392E (jeu_id), INDEX IDX_50ED1EBFBCF5E72D (categorie_id), PRIMARY KEY (jeu_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE oeuvre_categorie ADD CONSTRAINT `FK_50ED1EBF8C9E392E` FOREIGN KEY (jeu_id) REFERENCES jeu (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_categorie ADD CONSTRAINT `FK_50ED1EBFBCF5E72D` FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeu_categorie DROP FOREIGN KEY FK_E337000C8C9E392E');
        $this->addSql('ALTER TABLE jeu_categorie DROP FOREIGN KEY FK_E337000CBCF5E72D');
        $this->addSql('DROP TABLE jeu_categorie');
        $this->addSql('ALTER TABLE jeu CHANGE nb_joueurs nb_joueurs NUMERIC(10, 0) NOT NULL, CHANGE duree_moyenne duree_moyenne NUMERIC(10, 2) NOT NULL, CHANGE age_minimum age_minimum NUMERIC(10, 0) NOT NULL');
        $this->addSql('ALTER TABLE soiree CHANGE nb_max_participants nb_max_participants NUMERIC(10, 0) NOT NULL');
    }
}
