<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228104706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE url_stats (id INT AUTO_INCREMENT NOT NULL, url_id INT NOT NULL, browser VARCHAR(120) NOT NULL, ip_address INT NOT NULL, device VARCHAR(45) NOT NULL, resolution VARCHAR(12) NOT NULL, locale VARCHAR(2) NOT NULL, city VARCHAR(30) DEFAULT NULL, country VARCHAR(30) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, surname VARCHAR(15) NOT NULL, email VARCHAR(60) NOT NULL, password VARCHAR(60) NOT NULL, role_id INT NOT NULL, email_activation_code VARCHAR(6) NOT NULL, is_email_activated TINYINT(1) NOT NULL, reset_password_code VARCHAR(6) DEFAULT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE url_stats');
        $this->addSql('DROP TABLE user');
    }
}
