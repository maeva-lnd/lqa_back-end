<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20230503155627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des catégories pour la carte du restaurant ainsi que celles des menus';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO card_category (name) VALUES ("Nos entrées")');
        $this->addSql('INSERT INTO card_category (name) VALUES ("Nos plats")');
        $this->addSql('INSERT INTO card_category (name) VALUES ("Nos desserts")');
        $this->addSql('INSERT INTO menu_category (name) VALUES ("Entrées au choix")');
        $this->addSql('INSERT INTO menu_category (name) VALUES ("Plats au choix")');
        $this->addSql('INSERT INTO menu_category (name) VALUES ("Desserts au choix")');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM card_category where name = "Nos entrées"');
        $this->addSql('DELETE FROM card_category where name = "Nos plats"');
        $this->addSql('DELETE FROM card_category where name = "Nos desserts"');
        $this->addSql('DELETE FROM menu_category where name = "Entrées au choix"');
        $this->addSql('DELETE FROM menu_category where name = "Plats au choix"');
        $this->addSql('DELETE FROM menu_category where name = "Desserts au choix"');
    }
}
