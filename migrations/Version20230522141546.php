<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522141546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE routes (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE essais ADD route_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE essais ADD CONSTRAINT FK_1A25FB5834ECB4E6 FOREIGN KEY (route_id) REFERENCES parcours (id)');
        $this->addSql('CREATE INDEX IDX_1A25FB5834ECB4E6 ON essais (route_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE routes');
        $this->addSql('ALTER TABLE essais DROP FOREIGN KEY FK_1A25FB5834ECB4E6');
        $this->addSql('DROP INDEX IDX_1A25FB5834ECB4E6 ON essais');
        $this->addSql('ALTER TABLE essais DROP route_id');
    }
}
