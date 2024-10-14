<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014181233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vol ADD date_de_départ DATE DEFAULT NULL, ADD date_darrivée DATE DEFAULT NULL, DROP date_de_depart, DROP date_darrivee');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vol ADD date_de_depart DATE DEFAULT NULL, ADD date_darrivee DATE DEFAULT NULL, DROP date_de_départ, DROP date_darrivée');
    }
}
