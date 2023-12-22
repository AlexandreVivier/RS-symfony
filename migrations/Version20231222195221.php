<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222195221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE friendship_requests (id INT AUTO_INCREMENT NOT NULL, giver_id INT NOT NULL, reciever_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, INDEX IDX_CC6FD96B75BD1D29 (giver_id), INDEX IDX_CC6FD96B5D5C928D (reciever_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE friendship_requests ADD CONSTRAINT FK_CC6FD96B75BD1D29 FOREIGN KEY (giver_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE friendship_requests ADD CONSTRAINT FK_CC6FD96B5D5C928D FOREIGN KEY (reciever_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE friendship_requests DROP FOREIGN KEY FK_CC6FD96B75BD1D29');
        $this->addSql('ALTER TABLE friendship_requests DROP FOREIGN KEY FK_CC6FD96B5D5C928D');
        $this->addSql('DROP TABLE friendship_requests');
    }
}
