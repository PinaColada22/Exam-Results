<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240807114604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examresult ADD score INT NOT NULL, ADD remarks LONGTEXT DEFAULT NULL, DROP examresult, DROP nameofstudent, DROP nameofsubject');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE examresult ADD examresult VARCHAR(100) NOT NULL, ADD nameofstudent VARCHAR(100) NOT NULL, ADD nameofsubject VARCHAR(100) NOT NULL, DROP score, DROP remarks');
    }
}
