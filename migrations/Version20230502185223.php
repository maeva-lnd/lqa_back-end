<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20230502185223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des jours de la semaine';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO day_label (name) VALUES ("Lundi")');
        $this->addSql('INSERT INTO day_label (name) VALUES ("Mardi")');
        $this->addSql('INSERT INTO day_label (name) VALUES ("Mercredi")');
        $this->addSql('INSERT INTO day_label (name) VALUES ("Jeudi")');
        $this->addSql('INSERT INTO day_label (name) VALUES ("Vendredi")');
        $this->addSql('INSERT INTO day_label (name) VALUES ("Samedi")');
        $this->addSql('INSERT INTO day_label (name) VALUES ("Dimanche")');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM day_label where name = "Lundi"');
        $this->addSql('DELETE FROM day_label where name = "Mardi"');
        $this->addSql('DELETE FROM day_label where name = "Mercredi"');
        $this->addSql('DELETE FROM day_label where name = "Jeudi"');
        $this->addSql('DELETE FROM day_label where name = "Vendredi"');
        $this->addSql('DELETE FROM day_label where name = "Samedi"');
        $this->addSql('DELETE FROM day_label where name = "Dimanche"');
    }
}
