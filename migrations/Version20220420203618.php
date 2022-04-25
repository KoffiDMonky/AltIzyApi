<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420203618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, auteur VARCHAR(255) DEFAULT NULL, type_contrat VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_etudiant (annonce_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_3C362C218805AB2F (annonce_id), INDEX IDX_3C362C21DDEAB1A3 (etudiant_id), PRIMARY KEY(annonce_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_entreprise (annonce_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_136D2FE38805AB2F (annonce_id), INDEX IDX_136D2FE3A4AEAFEA (entreprise_id), PRIMARY KEY(annonce_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_E33BD3B8DDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidature_entreprise (candidature_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_9E07DD19B6121583 (candidature_id), INDEX IDX_9E07DD19A4AEAFEA (entreprise_id), PRIMARY KEY(candidature_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce_etudiant ADD CONSTRAINT FK_3C362C218805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_etudiant ADD CONSTRAINT FK_3C362C21DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_entreprise ADD CONSTRAINT FK_136D2FE38805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_entreprise ADD CONSTRAINT FK_136D2FE3A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE candidature_entreprise ADD CONSTRAINT FK_9E07DD19B6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature_entreprise ADD CONSTRAINT FK_9E07DD19A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_etudiant DROP FOREIGN KEY FK_3C362C218805AB2F');
        $this->addSql('ALTER TABLE annonce_entreprise DROP FOREIGN KEY FK_136D2FE38805AB2F');
        $this->addSql('ALTER TABLE candidature_entreprise DROP FOREIGN KEY FK_9E07DD19B6121583');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE annonce_etudiant');
        $this->addSql('DROP TABLE annonce_entreprise');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE candidature_entreprise');
    }
}
