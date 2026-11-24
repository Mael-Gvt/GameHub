<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261123145910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_497DD6346C6E55B5 (nom), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE jeu (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, nb_joueurs NUMERIC(10, 0) NOT NULL, duree_moyenne NUMERIC(10, 2) NOT NULL, age_minimum NUMERIC(10, 0) NOT NULL, UNIQUE INDEX UNIQ_82E48DB5FF7747B4 (titre), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE oeuvre_categorie (jeu_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_50ED1EBF8C9E392E (jeu_id), INDEX IDX_50ED1EBFBCF5E72D (categorie_id), PRIMARY KEY (jeu_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date_reservation DATE NOT NULL, utilisateur_id INT NOT NULL, soiree_id INT NOT NULL, INDEX IDX_42C84955FB88E14F (utilisateur_id), INDEX IDX_42C84955BA021F7B (soiree_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE soiree (id INT AUTO_INCREMENT NOT NULL, date_soiree DATE NOT NULL, nb_max_participants NUMERIC(10, 0) NOT NULL, jeu_id INT NOT NULL, INDEX IDX_131F30D28C9E392E (jeu_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, roles JSON NOT NULL, mdp VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE oeuvre_categorie ADD CONSTRAINT FK_50ED1EBF8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvre_categorie ADD CONSTRAINT FK_50ED1EBFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955BA021F7B FOREIGN KEY (soiree_id) REFERENCES soiree (id)');
        $this->addSql('ALTER TABLE soiree ADD CONSTRAINT FK_131F30D28C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvre_categorie DROP FOREIGN KEY FK_50ED1EBF8C9E392E');
        $this->addSql('ALTER TABLE oeuvre_categorie DROP FOREIGN KEY FK_50ED1EBFBCF5E72D');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FB88E14F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955BA021F7B');
        $this->addSql('ALTER TABLE soiree DROP FOREIGN KEY FK_131F30D28C9E392E');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE jeu');
        $this->addSql('DROP TABLE oeuvre_categorie');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE soiree');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
