<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313173546 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE homepage (id INT AUTO_INCREMENT NOT NULL, banner VARCHAR(255) DEFAULT NULL, bannerleft VARCHAR(255) DEFAULT NULL, urlundertext VARCHAR(255) DEFAULT NULL, featureshead VARCHAR(255) DEFAULT NULL, featuresparagraf VARCHAR(255) DEFAULT NULL, colomnleftimg VARCHAR(255) DEFAULT NULL, colomnmiddleimg VARCHAR(255) DEFAULT NULL, colomnrightimg VARCHAR(255) DEFAULT NULL, colomnleftparagraf VARCHAR(255) DEFAULT NULL, colomnmiddleparagraf VARCHAR(255) DEFAULT NULL, colomnrightparagraf VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE homepage');
    }
}
