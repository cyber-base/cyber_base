<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415093457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animateur (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2064DB2CE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, date DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, statut VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, nom_etablissement VARCHAR(100) NOT NULL, type_etablissement VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, tel VARCHAR(20) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, usagers_id INT NOT NULL, postes_id INT NOT NULL, ateliers_id INT NOT NULL, created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_D499BFF6533535E2 (usagers_id), INDEX IDX_D499BFF6E30A0B60 (postes_id), INDEX IDX_D499BFF6B1409BC9 (ateliers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, type_poste VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quartier (id INT AUTO_INCREMENT NOT NULL, nom_quartier VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usager (id INT NOT NULL, quartiers_id INT NOT NULL, partenaires_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, categorie VARCHAR(50) NOT NULL, niveau VARCHAR(50) NOT NULL, loisir VARCHAR(50) NOT NULL, adresse VARCHAR(100) NOT NULL, ville VARCHAR(50) NOT NULL, cp VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_3CDC65FFE7927C74 (email), INDEX IDX_3CDC65FFA6AAD912 (quartiers_id), INDEX IDX_3CDC65FF38898CF5 (partenaires_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animateur ADD CONSTRAINT FK_2064DB2CBF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF6533535E2 FOREIGN KEY (usagers_id) REFERENCES usager (id)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF6E30A0B60 FOREIGN KEY (postes_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF6B1409BC9 FOREIGN KEY (ateliers_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE usager ADD CONSTRAINT FK_3CDC65FFA6AAD912 FOREIGN KEY (quartiers_id) REFERENCES quartier (id)');
        $this->addSql('ALTER TABLE usager ADD CONSTRAINT FK_3CDC65FF38898CF5 FOREIGN KEY (partenaires_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE usager ADD CONSTRAINT FK_3CDC65FFBF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF6B1409BC9');
        $this->addSql('ALTER TABLE usager DROP FOREIGN KEY FK_3CDC65FF38898CF5');
        $this->addSql('ALTER TABLE animateur DROP FOREIGN KEY FK_2064DB2CBF396750');
        $this->addSql('ALTER TABLE usager DROP FOREIGN KEY FK_3CDC65FFBF396750');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF6E30A0B60');
        $this->addSql('ALTER TABLE usager DROP FOREIGN KEY FK_3CDC65FFA6AAD912');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF6533535E2');
        $this->addSql('DROP TABLE animateur');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE usager');
    }
}
