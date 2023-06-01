<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522130457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE form_satisfaction (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, client_id INT NOT NULL, sent_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', avis LONGTEXT NOT NULL, INDEX IDX_E0C9477112469DE2 (category_id), INDEX IDX_E0C9477119EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE form_satisfaction ADD CONSTRAINT FK_E0C9477112469DE2 FOREIGN KEY (category_id) REFERENCES marques (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE form_satisfaction ADD CONSTRAINT FK_E0C9477119EB6921 FOREIGN KEY (client_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE form_satisfaction DROP FOREIGN KEY FK_E0C9477112469DE2');
        $this->addSql('ALTER TABLE form_satisfaction DROP FOREIGN KEY FK_E0C9477119EB6921');
        $this->addSql('DROP TABLE form_satisfaction');
    }
}
