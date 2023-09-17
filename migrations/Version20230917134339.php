<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230917134339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE revision ADD cars_id INT NOT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE revision ADD CONSTRAINT FK_6D6315CC8702F506 FOREIGN KEY (cars_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_6D6315CC8702F506 ON revision (cars_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE revision DROP FOREIGN KEY FK_6D6315CC8702F506');
        $this->addSql('DROP INDEX IDX_6D6315CC8702F506 ON revision');
        $this->addSql('ALTER TABLE revision DROP cars_id, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
