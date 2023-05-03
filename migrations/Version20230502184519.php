<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20230502184519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création des tables pour les horaires d\'ouverture';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE day_label (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opening_hours (id INT AUTO_INCREMENT NOT NULL, day_id INT NOT NULL, lunch_opening TIME DEFAULT NULL, lunch_closing TIME DEFAULT NULL, dinner_opening TIME DEFAULT NULL, dinner_closing TIME DEFAULT NULL, UNIQUE INDEX UNIQ_2640C10B9C24126 (day_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE opening_hours ADD CONSTRAINT FK_2640C10B9C24126 FOREIGN KEY (day_id) REFERENCES day_label (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE opening_hours DROP FOREIGN KEY FK_2640C10B9C24126');
        $this->addSql('DROP TABLE day_label');
        $this->addSql('DROP TABLE opening_hours');
    }
}
