<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261125153500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Convert game player count, average duration and minimum age to text.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE jeu CHANGE nb_joueurs nb_joueurs VARCHAR(255) NOT NULL, CHANGE duree_moyenne duree_moyenne VARCHAR(255) NOT NULL, CHANGE age_minimum age_minimum VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE jeu CHANGE nb_joueurs nb_joueurs INT NOT NULL, CHANGE duree_moyenne duree_moyenne DOUBLE PRECISION NOT NULL, CHANGE age_minimum age_minimum INT NOT NULL');
    }
}
