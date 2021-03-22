<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322083240 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, content, author, created_at, is_published, is_deleted FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, content VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, is_published BOOLEAN NOT NULL, is_deleted BOOLEAN NOT NULL, title VARCHAR(255) NOT NULL, CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, content, title, created_at, is_published, is_deleted) SELECT id, content, author, created_at, is_published, is_deleted FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_5A8A6C8DF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, content, created_at, is_published, is_deleted, title FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, is_published BOOLEAN NOT NULL, is_deleted BOOLEAN NOT NULL, author VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO post (id, content, created_at, is_published, is_deleted, author) SELECT id, content, created_at, is_published, is_deleted, title FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
    }
}
