<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20230503155027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création des tables de la carte et des menus du restaurant';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE card_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dishes_card (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_B5733C0A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dishes_menu (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_DE629E4ACCD7E912 (menu_id), INDEX IDX_DE629E4A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dishes_card ADD CONSTRAINT FK_B5733C0A12469DE2 FOREIGN KEY (category_id) REFERENCES card_category (id)');
        $this->addSql('ALTER TABLE dishes_menu ADD CONSTRAINT FK_DE629E4ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE dishes_menu ADD CONSTRAINT FK_DE629E4A12469DE2 FOREIGN KEY (category_id) REFERENCES menu_category (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dishes_card DROP FOREIGN KEY FK_B5733C0A12469DE2');
        $this->addSql('ALTER TABLE dishes_menu DROP FOREIGN KEY FK_DE629E4ACCD7E912');
        $this->addSql('ALTER TABLE dishes_menu DROP FOREIGN KEY FK_DE629E4A12469DE2');
        $this->addSql('DROP TABLE card_category');
        $this->addSql('DROP TABLE dishes_card');
        $this->addSql('DROP TABLE dishes_menu');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_category');
    }
}
