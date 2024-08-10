<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240807125551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exam_result (id INT AUTO_INCREMENT NOT NULL, pupil_id INT NOT NULL, subject_id INT NOT NULL, score INT NOT NULL, remarks LONGTEXT DEFAULT NULL, INDEX IDX_D8599799D2FD11 (pupil_id), INDEX IDX_D859979923EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exam_result ADD CONSTRAINT FK_D8599799D2FD11 FOREIGN KEY (pupil_id) REFERENCES pupil (id)');
        $this->addSql('ALTER TABLE exam_result ADD CONSTRAINT FK_D859979923EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE examresult DROP FOREIGN KEY FK_CBB72B3F23EDC87');
        $this->addSql('DROP TABLE examresult');
        $this->addSql('ALTER TABLE pupil DROP birth_date');
        $this->addSql('ALTER TABLE subject CHANGE name name VARCHAR(255) NOT NULL, CHANGE date date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE examresult (id INT AUTO_INCREMENT NOT NULL, subject_id INT NOT NULL, score INT NOT NULL, remarks LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_CBB72B3F23EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE examresult ADD CONSTRAINT FK_CBB72B3F23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE exam_result DROP FOREIGN KEY FK_D8599799D2FD11');
        $this->addSql('ALTER TABLE exam_result DROP FOREIGN KEY FK_D859979923EDC87');
        $this->addSql('DROP TABLE exam_result');
        $this->addSql('ALTER TABLE pupil ADD birth_date DATE NOT NULL');
        $this->addSql('ALTER TABLE subject CHANGE name name VARCHAR(100) NOT NULL, CHANGE date date VARCHAR(50) NOT NULL');
    }
}
