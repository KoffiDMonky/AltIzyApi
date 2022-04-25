<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420201550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, numero INT DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, siren INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, interlocuteur VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D19FA60FB88E14F (utilisateur_id), INDEX IDX_D19FA604DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_de_naissance VARCHAR(10) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, niveau_etude VARCHAR(255) DEFAULT NULL, type_recherche VARCHAR(255) DEFAULT NULL, zone_recherche VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_717E22E3FB88E14F (utilisateur_id), INDEX IDX_717E22E34DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA604DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E34DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA604DE7DC5C');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E34DE7DC5C');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60FB88E14F');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3FB88E14F');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE utilisateur');
    }
}
