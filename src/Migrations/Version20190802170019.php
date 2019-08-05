<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802170019 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, numero BIGINT NOT NULL, solde BIGINT NOT NULL, INDEX IDX_CFF6526076C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, authent_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contact BIGINT NOT NULL, cni BIGINT NOT NULL, matricule VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F4BE6066 (authent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, contact BIGINT NOT NULL, cni BIGINT NOT NULL, email VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, compte BIGINT NOT NULL, INDEX IDX_60A26480642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526076C50E4A FOREIGN KEY (proprietaire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76F4BE6066 FOREIGN KEY (authent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480642B8210');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526076C50E4A');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE prestataire');
    }
}
