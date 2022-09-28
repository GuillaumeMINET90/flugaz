<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928215937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transfer_containers ADD user_id INT DEFAULT NULL, ADD used_container TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE transfer_containers ADD CONSTRAINT FK_4B619AE2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_4B619AE2A76ED395 ON transfer_containers (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transfer_containers DROP FOREIGN KEY FK_4B619AE2A76ED395');
        $this->addSql('DROP INDEX IDX_4B619AE2A76ED395 ON transfer_containers');
        $this->addSql('ALTER TABLE transfer_containers DROP user_id, DROP used_container');
    }
}
