<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20230508135804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création de la table configuration et ajout de la config sur le seuil de convives maximum';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE configuration (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO configuration (name, value) VALUES ("Nombre total de places dans le restaurant", 60)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE configuration');
    }
}
