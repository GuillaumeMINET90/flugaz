<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220924185054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE new_containers (id INT AUTO_INCREMENT NOT NULL, vendor_id INT NOT NULL, number INT NOT NULL, gaz VARCHAR(8) NOT NULL, initial_weight DOUBLE PRECISION NOT NULL, purchase_date DATE NOT NULL, return_date DATE DEFAULT NULL, INDEX IDX_4C9347C7F603EE73 (vendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE new_containers_movements (id INT AUTO_INCREMENT NOT NULL, new_container_id INT NOT NULL, technicien_id INT NOT NULL, quantity_rest DOUBLE PRECISION NOT NULL, quantity_injected DOUBLE PRECISION NOT NULL, date DATE NOT NULL, cerfa_number VARCHAR(15) NOT NULL, customer VARCHAR(255) NOT NULL, remark LONGTEXT DEFAULT NULL, INDEX IDX_778B0335E26D01FD (new_container_id), INDEX IDX_778B033513457256 (technicien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recovery_containers (id INT AUTO_INCREMENT NOT NULL, vendor_id INT NOT NULL, number INT NOT NULL, gaz VARCHAR(8) NOT NULL, tare DOUBLE PRECISION NOT NULL, purchase_date DATE NOT NULL, return_date DATE DEFAULT NULL, total_weight DOUBLE PRECISION DEFAULT NULL, INDEX IDX_94645907F603EE73 (vendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recovery_containers_movements (id INT AUTO_INCREMENT NOT NULL, recovery_container_id INT NOT NULL, technicien_id INT NOT NULL, quantity_recovered DOUBLE PRECISION NOT NULL, date DATE NOT NULL, cerfa_number VARCHAR(15) NOT NULL, customer VARCHAR(255) NOT NULL, remark LONGTEXT DEFAULT NULL, INDEX IDX_6B4C406D3983327 (recovery_container_id), INDEX IDX_6B4C40613457256 (technicien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tools (id INT AUTO_INCREMENT NOT NULL, technicien_id INT NOT NULL, type VARCHAR(60) NOT NULL, denomination VARCHAR(100) NOT NULL, serial_number VARCHAR(60) NOT NULL, control_date DATE NOT NULL, next_control DATE NOT NULL, control_certificate VARCHAR(60) NOT NULL, INDEX IDX_EAFADE7713457256 (technicien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfer_containers (id INT AUTO_INCREMENT NOT NULL, vendor_id INT NOT NULL, number INT NOT NULL, gaz VARCHAR(8) DEFAULT NULL, tare DOUBLE PRECISION NOT NULL, purchase_date DATE NOT NULL, return_date DATE DEFAULT NULL, total_weight DOUBLE PRECISION DEFAULT NULL, volume INT NOT NULL, INDEX IDX_4B619AE2F603EE73 (vendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, fullname VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT NULL, certificate VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE new_containers ADD CONSTRAINT FK_4C9347C7F603EE73 FOREIGN KEY (vendor_id) REFERENCES vendors (id)');
        $this->addSql('ALTER TABLE new_containers_movements ADD CONSTRAINT FK_778B0335E26D01FD FOREIGN KEY (new_container_id) REFERENCES new_containers (id)');
        $this->addSql('ALTER TABLE new_containers_movements ADD CONSTRAINT FK_778B033513457256 FOREIGN KEY (technicien_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE recovery_containers ADD CONSTRAINT FK_94645907F603EE73 FOREIGN KEY (vendor_id) REFERENCES vendors (id)');
        $this->addSql('ALTER TABLE recovery_containers_movements ADD CONSTRAINT FK_6B4C406D3983327 FOREIGN KEY (recovery_container_id) REFERENCES recovery_containers (id)');
        $this->addSql('ALTER TABLE recovery_containers_movements ADD CONSTRAINT FK_6B4C40613457256 FOREIGN KEY (technicien_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE tools ADD CONSTRAINT FK_EAFADE7713457256 FOREIGN KEY (technicien_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE transfer_containers ADD CONSTRAINT FK_4B619AE2F603EE73 FOREIGN KEY (vendor_id) REFERENCES vendors (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE new_containers DROP FOREIGN KEY FK_4C9347C7F603EE73');
        $this->addSql('ALTER TABLE new_containers_movements DROP FOREIGN KEY FK_778B0335E26D01FD');
        $this->addSql('ALTER TABLE new_containers_movements DROP FOREIGN KEY FK_778B033513457256');
        $this->addSql('ALTER TABLE recovery_containers DROP FOREIGN KEY FK_94645907F603EE73');
        $this->addSql('ALTER TABLE recovery_containers_movements DROP FOREIGN KEY FK_6B4C406D3983327');
        $this->addSql('ALTER TABLE recovery_containers_movements DROP FOREIGN KEY FK_6B4C40613457256');
        $this->addSql('ALTER TABLE tools DROP FOREIGN KEY FK_EAFADE7713457256');
        $this->addSql('ALTER TABLE transfer_containers DROP FOREIGN KEY FK_4B619AE2F603EE73');
        $this->addSql('DROP TABLE new_containers');
        $this->addSql('DROP TABLE new_containers_movements');
        $this->addSql('DROP TABLE recovery_containers');
        $this->addSql('DROP TABLE recovery_containers_movements');
        $this->addSql('DROP TABLE tools');
        $this->addSql('DROP TABLE transfer_containers');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE vendors');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
