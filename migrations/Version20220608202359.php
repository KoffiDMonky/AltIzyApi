<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220608202359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, numero INT DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, auteur VARCHAR(255) DEFAULT NULL, type_contrat VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_etudiant (annonce_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_3C362C218805AB2F (annonce_id), INDEX IDX_3C362C21DDEAB1A3 (etudiant_id), PRIMARY KEY(annonce_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_entreprise (annonce_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_136D2FE38805AB2F (annonce_id), INDEX IDX_136D2FE3A4AEAFEA (entreprise_id), PRIMARY KEY(annonce_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_E33BD3B8DDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature_entreprise (candidature_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_9E07DD19B6121583 (candidature_id), INDEX IDX_9E07DD19A4AEAFEA (entreprise_id), PRIMARY KEY(candidature_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE correspondance (id INT AUTO_INCREMENT NOT NULL, candidature_id INT DEFAULT NULL, annonce_id INT DEFAULT NULL, date DATE NOT NULL, id_etudiant_cible INT DEFAULT NULL, id_entreprise_cible INT DEFAULT NULL, statut TINYINT(1) NOT NULL, INDEX IDX_A562D1E7B6121583 (candidature_id), INDEX IDX_A562D1E78805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, siren VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, interlocuteur VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D19FA60FB88E14F (utilisateur_id), INDEX IDX_D19FA604DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_de_naissance VARCHAR(10) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, niveau_etude VARCHAR(255) DEFAULT NULL, type_recherche VARCHAR(255) DEFAULT NULL, zone_recherche VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_717E22E3FB88E14F (utilisateur_id), INDEX IDX_717E22E34DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, correspondance_id INT DEFAULT NULL, etudiant_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, date DATE NOT NULL, contenu VARCHAR(255) NOT NULL, expediteur VARCHAR(255) NOT NULL, destinataire VARCHAR(255) NOT NULL, INDEX IDX_B6BD307FF173F79A (correspondance_id), INDEX IDX_B6BD307FDDEAB1A3 (etudiant_id), INDEX IDX_B6BD307FA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_annonce (tag_id INT NOT NULL, annonce_id INT NOT NULL, INDEX IDX_C464BE4FBAD26311 (tag_id), INDEX IDX_C464BE4F8805AB2F (annonce_id), PRIMARY KEY(tag_id, annonce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_candidature (tag_id INT NOT NULL, candidature_id INT NOT NULL, INDEX IDX_FFF2A958BAD26311 (tag_id), INDEX IDX_FFF2A958B6121583 (candidature_id), PRIMARY KEY(tag_id, candidature_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_etudiant (tag_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_474F5938BAD26311 (tag_id), INDEX IDX_474F5938DDEAB1A3 (etudiant_id), PRIMARY KEY(tag_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_entreprise (tag_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_A8027831BAD26311 (tag_id), INDEX IDX_A8027831A4AEAFEA (entreprise_id), PRIMARY KEY(tag_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, uid VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce_etudiant ADD CONSTRAINT FK_3C362C218805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_etudiant ADD CONSTRAINT FK_3C362C21DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_entreprise ADD CONSTRAINT FK_136D2FE38805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_entreprise ADD CONSTRAINT FK_136D2FE3A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE candidature_entreprise ADD CONSTRAINT FK_9E07DD19B6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature_entreprise ADD CONSTRAINT FK_9E07DD19A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE correspondance ADD CONSTRAINT FK_A562D1E7B6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id)');
        $this->addSql('ALTER TABLE correspondance ADD CONSTRAINT FK_A562D1E78805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA604DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E34DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF173F79A FOREIGN KEY (correspondance_id) REFERENCES correspondance (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE tag_annonce ADD CONSTRAINT FK_C464BE4FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_annonce ADD CONSTRAINT FK_C464BE4F8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_candidature ADD CONSTRAINT FK_FFF2A958BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_candidature ADD CONSTRAINT FK_FFF2A958B6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_etudiant ADD CONSTRAINT FK_474F5938BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_etudiant ADD CONSTRAINT FK_474F5938DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_entreprise ADD CONSTRAINT FK_A8027831BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_entreprise ADD CONSTRAINT FK_A8027831A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA604DE7DC5C');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E34DE7DC5C');
        $this->addSql('ALTER TABLE annonce_etudiant DROP FOREIGN KEY FK_3C362C218805AB2F');
        $this->addSql('ALTER TABLE annonce_entreprise DROP FOREIGN KEY FK_136D2FE38805AB2F');
        $this->addSql('ALTER TABLE correspondance DROP FOREIGN KEY FK_A562D1E78805AB2F');
        $this->addSql('ALTER TABLE tag_annonce DROP FOREIGN KEY FK_C464BE4F8805AB2F');
        $this->addSql('ALTER TABLE candidature_entreprise DROP FOREIGN KEY FK_9E07DD19B6121583');
        $this->addSql('ALTER TABLE correspondance DROP FOREIGN KEY FK_A562D1E7B6121583');
        $this->addSql('ALTER TABLE tag_candidature DROP FOREIGN KEY FK_FFF2A958B6121583');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF173F79A');
        $this->addSql('ALTER TABLE annonce_entreprise DROP FOREIGN KEY FK_136D2FE3A4AEAFEA');
        $this->addSql('ALTER TABLE candidature_entreprise DROP FOREIGN KEY FK_9E07DD19A4AEAFEA');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4AEAFEA');
        $this->addSql('ALTER TABLE tag_entreprise DROP FOREIGN KEY FK_A8027831A4AEAFEA');
        $this->addSql('ALTER TABLE annonce_etudiant DROP FOREIGN KEY FK_3C362C21DDEAB1A3');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8DDEAB1A3');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FDDEAB1A3');
        $this->addSql('ALTER TABLE tag_etudiant DROP FOREIGN KEY FK_474F5938DDEAB1A3');
        $this->addSql('ALTER TABLE tag_annonce DROP FOREIGN KEY FK_C464BE4FBAD26311');
        $this->addSql('ALTER TABLE tag_candidature DROP FOREIGN KEY FK_FFF2A958BAD26311');
        $this->addSql('ALTER TABLE tag_etudiant DROP FOREIGN KEY FK_474F5938BAD26311');
        $this->addSql('ALTER TABLE tag_entreprise DROP FOREIGN KEY FK_A8027831BAD26311');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60FB88E14F');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3FB88E14F');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE annonce_etudiant');
        $this->addSql('DROP TABLE annonce_entreprise');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE candidature_entreprise');
        $this->addSql('DROP TABLE correspondance');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_annonce');
        $this->addSql('DROP TABLE tag_candidature');
        $this->addSql('DROP TABLE tag_etudiant');
        $this->addSql('DROP TABLE tag_entreprise');
        $this->addSql('DROP TABLE user');
    }
}
