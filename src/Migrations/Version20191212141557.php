<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191212141557 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subscriber (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, created_at DATE NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscriber_type_newsletter (subscriber_id INT NOT NULL, type_newsletter_id INT NOT NULL, INDEX IDX_FE327B087808B1AD (subscriber_id), INDEX IDX_FE327B085236AE22 (type_newsletter_id), PRIMARY KEY(subscriber_id, type_newsletter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_newsletter (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subscriber_type_newsletter ADD CONSTRAINT FK_FE327B087808B1AD FOREIGN KEY (subscriber_id) REFERENCES subscriber (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscriber_type_newsletter ADD CONSTRAINT FK_FE327B085236AE22 FOREIGN KEY (type_newsletter_id) REFERENCES type_newsletter (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscriber_type_newsletter DROP FOREIGN KEY FK_FE327B087808B1AD');
        $this->addSql('ALTER TABLE subscriber_type_newsletter DROP FOREIGN KEY FK_FE327B085236AE22');
        $this->addSql('DROP TABLE subscriber');
        $this->addSql('DROP TABLE subscriber_type_newsletter');
        $this->addSql('DROP TABLE type_newsletter');
    }
}
