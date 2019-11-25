<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191125153250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE checklistitem (id INT AUTO_INCREMENT NOT NULL, checklist_id INT NOT NULL, item_id INT DEFAULT NULL, is_closed TINYINT(1) NOT NULL, INDEX IDX_71A70F34B16D08A7 (checklist_id), INDEX IDX_71A70F34126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roomitem (id INT AUTO_INCREMENT NOT NULL, room_id INT NOT NULL, item_id INT NOT NULL, quantity NUMERIC(10, 0) NOT NULL, INDEX IDX_50F681F954177093 (room_id), INDEX IDX_50F681F9126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, create_time DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE checklistitem ADD CONSTRAINT FK_71A70F34B16D08A7 FOREIGN KEY (checklist_id) REFERENCES checklist (id)');
        $this->addSql('ALTER TABLE checklistitem ADD CONSTRAINT FK_71A70F34126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE roomitem ADD CONSTRAINT FK_50F681F954177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE roomitem ADD CONSTRAINT FK_50F681F9126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE checklistitem');
        $this->addSql('DROP TABLE roomitem');
        $this->addSql('DROP TABLE user');
    }
}
