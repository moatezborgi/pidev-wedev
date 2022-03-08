<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303183326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description VARCHAR(255) NOT NULL, allday TINYINT(1) NOT NULL, backgroundcolor VARCHAR(255) NOT NULL, bordorcolor VARCHAR(255) NOT NULL, textcolor VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (num_chambre INT NOT NULL, type_chambre VARCHAR(20) DEFAULT NULL, nb_lit INT DEFAULT NULL, disponibilite VARCHAR(20) DEFAULT NULL, vue_chambre VARCHAR(50) DEFAULT NULL, refer_hotel VARCHAR(50) DEFAULT NULL, prix_nuit DOUBLE PRECISION NOT NULL, INDEX fk_chambre (refer_hotel), PRIMARY KEY(num_chambre)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id VARCHAR(50) NOT NULL, nom_hotel VARCHAR(200) DEFAULT NULL, ville_hotel VARCHAR(200) DEFAULT NULL, nb_etoile INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_hotel (code_image INT AUTO_INCREMENT NOT NULL, image VARCHAR(200) DEFAULT NULL, refer_hotel VARCHAR(50) DEFAULT NULL, INDEX fk_image (refer_hotel), PRIMARY KEY(code_image)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offrevoyage (id VARCHAR(255) NOT NULL, hotel_id VARCHAR(50) DEFAULT NULL, prix_offre DOUBLE PRECISION NOT NULL, nb_place INT NOT NULL, descriptions VARCHAR(255) NOT NULL, lieu_depart VARCHAR(255) NOT NULL, lieu_arrivee VARCHAR(255) NOT NULL, nb_nuits INT NOT NULL, nb_jours INT NOT NULL, date_depart DATE DEFAULT NULL, date_retour DATE NOT NULL, INDEX IDX_E28F82523243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nb_perso INT NOT NULL, tel VARCHAR(8) NOT NULL, refer_offre VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offrevoyage ADD CONSTRAINT FK_E28F82523243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('DROP TABLE utilisateur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offrevoyage DROP FOREIGN KEY FK_E28F82523243BB18');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, datenaissance DATE NOT NULL, genre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tel INT NOT NULL, addresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, imageuser VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, reset_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE image_hotel');
        $this->addSql('DROP TABLE offrevoyage');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE rating CHANGE entity_code entity_code VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
