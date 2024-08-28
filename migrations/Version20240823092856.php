<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240823092856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("ALTER TABLE animal DROP INDEX id_habitat");
        $this->addSql("ALTER TABLE animal DROP INDEX id_race");
        $this->addSql("ALTER TABLE animal DROP INDEX id_last_rapport");
        $this->addSql('ALTER TABLE rapport_veterinaire DROP INDEX id_animal');
    }

}
