<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523142920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD choix01_id INT DEFAULT NULL, ADD choix02_id INT DEFAULT NULL, ADD choix03_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BEC3FB54 FOREIGN KEY (choix01_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AC7654BA FOREIGN KEY (choix02_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64914CA33DF FOREIGN KEY (choix03_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BEC3FB54 ON user (choix01_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649AC7654BA ON user (choix02_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64914CA33DF ON user (choix03_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649BEC3FB54');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649AC7654BA');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64914CA33DF');
        $this->addSql('DROP INDEX IDX_8D93D649BEC3FB54 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D649AC7654BA ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D64914CA33DF ON `user`');
        $this->addSql('ALTER TABLE `user` DROP choix01_id, DROP choix02_id, DROP choix03_id');
    }
}
