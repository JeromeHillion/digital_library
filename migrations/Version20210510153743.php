<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510153743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_4A1B2A9212469DE2 ON books (category_id)');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C17DD8AC20');
        $this->addSql('DROP INDEX IDX_64C19C17DD8AC20 ON category');
        $this->addSql('ALTER TABLE category DROP books_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A9212469DE2');
        $this->addSql('DROP INDEX IDX_4A1B2A9212469DE2 ON books');
        $this->addSql('ALTER TABLE books DROP category_id');
        $this->addSql('ALTER TABLE category ADD books_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C17DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id)');
        $this->addSql('CREATE INDEX IDX_64C19C17DD8AC20 ON category (books_id)');
    }
}