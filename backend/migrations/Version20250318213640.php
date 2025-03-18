<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250318213640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE finale (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, thema VARCHAR(255) NOT NULL, kenmerk1 VARCHAR(255) NOT NULL, kenmerk2 VARCHAR(255) NOT NULL, kenmerk3 VARCHAR(255) NOT NULL, kenmerk4 VARCHAR(255) NOT NULL, kenmerk5 VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE galerij (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, thema VARCHAR(255) NOT NULL, afbeelding1 VARCHAR(255) NOT NULL, afbeelding2 VARCHAR(255) NOT NULL, afbeelding3 VARCHAR(255) NOT NULL, afbeelding4 VARCHAR(255) NOT NULL, afbeelding5 VARCHAR(255) NOT NULL, afbeelding6 VARCHAR(255) NOT NULL, afbeelding7 VARCHAR(255) NOT NULL, afbeelding8 VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ingelijst (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, thema VARCHAR(255) NOT NULL, antwoord1 VARCHAR(255) NOT NULL, antwoord2 VARCHAR(255) NOT NULL, antwoord3 VARCHAR(255) NOT NULL, antwoord4 VARCHAR(255) NOT NULL, antwoord5 VARCHAR(255) NOT NULL, antwoord6 VARCHAR(255) NOT NULL, antwoord7 VARCHAR(255) NOT NULL, antwoord8 VARCHAR(255) NOT NULL, antwoord9 VARCHAR(255) NOT NULL, antwoord10 VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE open_deur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, thema VARCHAR(255) NOT NULL, kenmerk1 VARCHAR(255) NOT NULL, kenmerk2 VARCHAR(255) NOT NULL, kenmerk3 VARCHAR(255) NOT NULL, kenmerk4 VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE puzzel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, thema VARCHAR(255) NOT NULL, kenmerk1 VARCHAR(255) NOT NULL, kenmerk2 VARCHAR(255) NOT NULL, kenmerk3 VARCHAR(255) NOT NULL, kenmerk4 VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, vraag VARCHAR(255) NOT NULL, antwoord VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE finale');
        $this->addSql('DROP TABLE galerij');
        $this->addSql('DROP TABLE ingelijst');
        $this->addSql('DROP TABLE open_deur');
        $this->addSql('DROP TABLE puzzel');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
