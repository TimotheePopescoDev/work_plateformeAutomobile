<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522115452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE essais (id INT AUTO_INCREMENT NOT NULL, conducteur_id INT NOT NULL, passager01_id INT NOT NULL, voiture_id INT NOT NULL, marques_id INT DEFAULT NULL, started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', etat TINYINT(1) NOT NULL, INDEX IDX_1A25FB58F16F4AC6 (conducteur_id), INDEX IDX_1A25FB5822DD8A5 (passager01_id), INDEX IDX_1A25FB58181A8BA (voiture_id), INDEX IDX_1A25FB58C256483C (marques_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB58F16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB5822DD8A5 FOREIGN KEY (passager01_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB58181A8BA FOREIGN KEY (voiture_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB58C256483C FOREIGN KEY (marques_id) REFERENCES marques (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB58F16F4AC6');
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB5822DD8A5');
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB58181A8BA');
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB58C256483C');
        $this->addSql('DROP TABLE essais');
    }
}
