<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530151721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_satisfaction ADD voitures_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE form_satisfaction ADD CONSTRAINT FK_E0C94771CCC4661F FOREIGN KEY (voitures_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_E0C94771CCC4661F ON form_satisfaction (voitures_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_satisfaction DROP FOREIGN KEY FK_E0C94771CCC4661F');
        $this->addSql('DROP INDEX IDX_E0C94771CCC4661F ON form_satisfaction');
        $this->addSql('ALTER TABLE form_satisfaction DROP voitures_id');
    }
}
