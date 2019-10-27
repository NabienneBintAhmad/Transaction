<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191018215429 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, bi BIGINT NOT NULL, bs BIGINT NOT NULL, prix BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, caissier_id INT NOT NULL, compte_id INT NOT NULL, montant BIGINT NOT NULL, date DATETIME NOT NULL, INDEX IDX_47948BBCB514973B (caissier_id), INDEX IDX_47948BBCF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_prestataire (id INT AUTO_INCREMENT NOT NULL, matricule_entreprise_id INT NOT NULL, authent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, contact BIGINT NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, cni BIGINT NOT NULL, matricule VARCHAR(255) NOT NULL, INDEX IDX_C9B9AD1599DFBC8B (matricule_entreprise_id), UNIQUE INDEX UNIQ_C9B9AD15F4BE6066 (authent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, multiservice_id INT NOT NULL, commission_id INT NOT NULL, service_retrait_id INT DEFAULT NULL, date DATETIME NOT NULL, montant BIGINT NOT NULL, envoyeur_nom_complet VARCHAR(255) NOT NULL, envoyeur_cni BIGINT NOT NULL, recepteur_nom_complet VARCHAR(255) NOT NULL, recepteur_cni BIGINT DEFAULT NULL, code BIGINT NOT NULL, libelle VARCHAR(255) NOT NULL, date_retrait DATETIME DEFAULT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_723705D191655923 (multiservice_id), INDEX IDX_723705D1202D1EB2 (commission_id), INDEX IDX_723705D1E8A97CCE (service_retrait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, contact BIGINT NOT NULL, cni BIGINT NOT NULL, email VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, compte BIGINT NOT NULL, ninea VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_60A264804C62E638 (contact), UNIQUE INDEX UNIQ_60A264807AC033BE (cni), UNIQUE INDEX UNIQ_60A26480E7927C74 (email), UNIQUE INDEX UNIQ_60A2648012B2DC9C (matricule), UNIQUE INDEX UNIQ_60A26480CFF65260 (compte), UNIQUE INDEX UNIQ_60A26480C678AEBE (ninea), INDEX IDX_60A26480642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_transaction (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, compte_travail_id INT DEFAULT NULL, admin_id INT DEFAULT NULL, prestataire_id INT DEFAULT NULL, caissier_id INT DEFAULT NULL, userpresta_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D64926EAA117 (compte_travail_id), INDEX IDX_8D93D649642B8210 (admin_id), INDEX IDX_8D93D649BE3DB2B7 (prestataire_id), INDEX IDX_8D93D649B514973B (caissier_id), INDEX IDX_8D93D64974623690 (userpresta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, numero BIGINT NOT NULL, solde BIGINT NOT NULL, date_creation DATETIME NOT NULL, UNIQUE INDEX UNIQ_CFF65260F55AE19E (numero), INDEX IDX_CFF6526076C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, authent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contact BIGINT NOT NULL, cni BIGINT NOT NULL, matricule VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), UNIQUE INDEX UNIQ_880E0D764C62E638 (contact), UNIQUE INDEX UNIQ_880E0D767AC033BE (cni), UNIQUE INDEX UNIQ_880E0D7612B2DC9C (matricule), UNIQUE INDEX UNIQ_880E0D76F4BE6066 (authent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caissier (id INT AUTO_INCREMENT NOT NULL, authent_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contact BIGINT NOT NULL, cni BIGINT NOT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1F038BC212B2DC9C (matricule), UNIQUE INDEX UNIQ_1F038BC2E7927C74 (email), UNIQUE INDEX UNIQ_1F038BC24C62E638 (contact), UNIQUE INDEX UNIQ_1F038BC27AC033BE (cni), UNIQUE INDEX UNIQ_1F038BC2F4BE6066 (authent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCB514973B FOREIGN KEY (caissier_id) REFERENCES caissier (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE user_prestataire ADD CONSTRAINT FK_C9B9AD1599DFBC8B FOREIGN KEY (matricule_entreprise_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE user_prestataire ADD CONSTRAINT FK_C9B9AD15F4BE6066 FOREIGN KEY (authent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D191655923 FOREIGN KEY (multiservice_id) REFERENCES user_prestataire (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1202D1EB2 FOREIGN KEY (commission_id) REFERENCES tarif (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1E8A97CCE FOREIGN KEY (service_retrait_id) REFERENCES user_prestataire (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64926EAA117 FOREIGN KEY (compte_travail_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B514973B FOREIGN KEY (caissier_id) REFERENCES caissier (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64974623690 FOREIGN KEY (userpresta_id) REFERENCES user_prestataire (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526076C50E4A FOREIGN KEY (proprietaire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76F4BE6066 FOREIGN KEY (authent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC2F4BE6066 FOREIGN KEY (authent_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1202D1EB2');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D191655923');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1E8A97CCE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64974623690');
        $this->addSql('ALTER TABLE user_prestataire DROP FOREIGN KEY FK_C9B9AD1599DFBC8B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BE3DB2B7');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526076C50E4A');
        $this->addSql('ALTER TABLE user_prestataire DROP FOREIGN KEY FK_C9B9AD15F4BE6066');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76F4BE6066');
        $this->addSql('ALTER TABLE caissier DROP FOREIGN KEY FK_1F038BC2F4BE6066');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBCF2C56620');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64926EAA117');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480642B8210');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649642B8210');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBCB514973B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B514973B');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE user_prestataire');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE type_transaction');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE caissier');
    }
}
