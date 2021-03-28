<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313114713 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE url_stats (id INT AUTO_INCREMENT NOT NULL, url_id INT NOT NULL, browser VARCHAR(120) NOT NULL, ip_address VARCHAR(255) NOT NULL, device VARCHAR(45) NOT NULL, resolution VARCHAR(12) NOT NULL, locale VARCHAR(2) NOT NULL, city VARCHAR(30) DEFAULT NULL, country VARCHAR(30) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE url ADD user_id INT NOT NULL, ADD click_count INT NOT NULL, ADD is_public TINYINT(1) NOT NULL, ADD expired_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE url_stats');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE url DROP user_id, DROP click_count, DROP is_public, DROP expired_at');
    }
}
