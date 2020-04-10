<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200410104910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_tag (movie_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_DCD9F2918F93B6FC (movie_id), INDEX IDX_DCD9F291BAD26311 (tag_id), PRIMARY KEY(movie_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_tag ADD CONSTRAINT FK_DCD9F2918F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_tag ADD CONSTRAINT FK_DCD9F291BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE movie_tag DROP FOREIGN KEY FK_DCD9F291BAD26311');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE movie_tag');
    }
}
