<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261125162211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add a name to each game night.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE soiree ADD nom VARCHAR(255) DEFAULT NULL');
        $this->addSql("UPDATE soiree SET nom = CONCAT('Soirée #', id)");
        $this->addSql('ALTER TABLE soiree CHANGE nom nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE soiree DROP nom');
    }
}
