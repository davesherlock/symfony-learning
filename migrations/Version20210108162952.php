<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210108162952 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, street VARCHAR(255) NOT NULL, number INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE security_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, y VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_52825A88FBDB2615 ON security_user (y)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F5B7AF75 ON user (address_id)');
        $this->addSql('CREATE TABLE video (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, security_user_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CA76ED395 ON video (user_id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CCA85D888 ON video (security_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE security_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
    }
}
