<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602144138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, marques_id INT NOT NULL, energies_id INT NOT NULL, modele VARCHAR(255) NOT NULL, immatriculation VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, etat TINYINT(1) NOT NULL, INDEX IDX_773DE69DC256483C (marques_id), INDEX IDX_773DE69DAD192AC7 (energies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE energy (id INT AUTO_INCREMENT NOT NULL, energies VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE essais (id INT AUTO_INCREMENT NOT NULL, conducteur_id INT NOT NULL, passager01_id INT DEFAULT NULL, voiture_id INT NOT NULL, route_id INT DEFAULT NULL, started_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', etat TINYINT(1) NOT NULL, INDEX IDX_1A25FB58F16F4AC6 (conducteur_id), INDEX IDX_1A25FB5822DD8A5 (passager01_id), INDEX IDX_1A25FB58181A8BA (voiture_id), INDEX IDX_1A25FB5834ECB4E6 (route_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE form_satisfaction (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, voitures_id INT DEFAULT NULL, sent_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', avis LONGTEXT NOT NULL, INDEX IDX_E0C9477119EB6921 (client_id), INDEX IDX_E0C94771CCC4661F (voitures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marques (id INT AUTO_INCREMENT NOT NULL, marques VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parcours (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(2550) NOT NULL, dispo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE routes (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, choix01_id INT DEFAULT NULL, choix02_id INT DEFAULT NULL, choix03_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, permisrecto VARCHAR(255) DEFAULT NULL, permisverso VARCHAR(255) DEFAULT NULL, etat TINYINT(1) NOT NULL, avis TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649BEC3FB54 (choix01_id), INDEX IDX_8D93D649AC7654BA (choix02_id), INDEX IDX_8D93D64914CA33DF (choix03_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC256483C FOREIGN KEY (marques_id) REFERENCES marques (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DAD192AC7 FOREIGN KEY (energies_id) REFERENCES energy (id)');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB58F16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB5822DD8A5 FOREIGN KEY (passager01_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB58181A8BA FOREIGN KEY (voiture_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB5834ECB4E6 FOREIGN KEY (route_id) REFERENCES parcours (id)');
        $this->addSql('ALTER TABLE form_satisfaction ADD CONSTRAINT FK_E0C9477119EB6921 FOREIGN KEY (client_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE form_satisfaction ADD CONSTRAINT FK_E0C94771CCC4661F FOREIGN KEY (voitures_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649BEC3FB54 FOREIGN KEY (choix01_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649AC7654BA FOREIGN KEY (choix02_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64914CA33DF FOREIGN KEY (choix03_id) REFERENCES car (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DC256483C');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DAD192AC7');
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB58F16F4AC6');
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB5822DD8A5');
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB58181A8BA');
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB5834ECB4E6');
        $this->addSql('ALTER TABLE form_satisfaction DROP FOREIGN KEY FK_E0C9477119EB6921');
        $this->addSql('ALTER TABLE form_satisfaction DROP FOREIGN KEY FK_E0C94771CCC4661F');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649BEC3FB54');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649AC7654BA');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64914CA33DF');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE energy');
        $this->addSql('DROP TABLE essais');
        $this->addSql('DROP TABLE form_satisfaction');
        $this->addSql('DROP TABLE marques');
        $this->addSql('DROP TABLE parcours');
        $this->addSql('DROP TABLE routes');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
