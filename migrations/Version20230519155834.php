<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519155834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, marques_id INT NOT NULL, energies_id INT NOT NULL, modèle VARCHAR(255) NOT NULL, immatriculation VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_773DE69DC256483C (marques_id), INDEX IDX_773DE69DAD192AC7 (energies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC256483C FOREIGN KEY (marques_id) REFERENCES marques (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DAD192AC7 FOREIGN KEY (energies_id) REFERENCES energy (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DC256483C');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DAD192AC7');
        $this->addSql('DROP TABLE car');
    }
}
