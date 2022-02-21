<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220221175435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nb_perso INT NOT NULL, tel VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chambre CHANGE num_chambre num_chambre INT NOT NULL');
        $this->addSql('ALTER TABLE offrevoyage ADD CONSTRAINT FK_E28F82523243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE chambre CHANGE num_chambre num_chambre INT AUTO_INCREMENT NOT NULL, CHANGE type_chambre type_chambre VARCHAR(20) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE disponibilite disponibilite VARCHAR(20) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE vue_chambre vue_chambre VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE refer_hotel refer_hotel VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE hotel CHANGE id id VARCHAR(50) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CHANGE nom_hotel nom_hotel VARCHAR(200) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE ville_hotel ville_hotel VARCHAR(200) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE image_hotel CHANGE image image VARCHAR(200) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE refer_hotel refer_hotel VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE offrevoyage DROP FOREIGN KEY FK_E28F82523243BB18');
        $this->addSql('ALTER TABLE offrevoyage CHANGE id id VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hotel_id hotel_id VARCHAR(50) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descriptions descriptions VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lieu_depart lieu_depart VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lieu_arrivee lieu_arrivee VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
