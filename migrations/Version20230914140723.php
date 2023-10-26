<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230914140723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD etat BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD date DATE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN article.date IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article DROP titre');
        $this->addSql('ALTER TABLE article DROP etat');
        $this->addSql('ALTER TABLE article DROP date');
    }
}
