<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806001250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF65260F55AE19E ON compte (numero)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76E7927C74 ON admin (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D764C62E638 ON admin (contact)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D767AC033BE ON admin (cni)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D7612B2DC9C ON admin (matricule)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A264804C62E638 ON prestataire (contact)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A264807AC033BE ON prestataire (cni)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A26480E7927C74 ON prestataire (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A2648012B2DC9C ON prestataire (matricule)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A26480CFF65260 ON prestataire (compte)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A26480C678AEBE ON prestataire (ninea)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F038BC212B2DC9C ON caissier (matricule)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F038BC2E7927C74 ON caissier (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F038BC24C62E638 ON caissier (contact)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F038BC27AC033BE ON caissier (cni)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image');
        $this->addSql('DROP INDEX UNIQ_880E0D76E7927C74 ON admin');
        $this->addSql('DROP INDEX UNIQ_880E0D764C62E638 ON admin');
        $this->addSql('DROP INDEX UNIQ_880E0D767AC033BE ON admin');
        $this->addSql('DROP INDEX UNIQ_880E0D7612B2DC9C ON admin');
        $this->addSql('DROP INDEX UNIQ_1F038BC212B2DC9C ON caissier');
        $this->addSql('DROP INDEX UNIQ_1F038BC2E7927C74 ON caissier');
        $this->addSql('DROP INDEX UNIQ_1F038BC24C62E638 ON caissier');
        $this->addSql('DROP INDEX UNIQ_1F038BC27AC033BE ON caissier');
        $this->addSql('DROP INDEX UNIQ_CFF65260F55AE19E ON compte');
        $this->addSql('DROP INDEX UNIQ_60A264804C62E638 ON prestataire');
        $this->addSql('DROP INDEX UNIQ_60A264807AC033BE ON prestataire');
        $this->addSql('DROP INDEX UNIQ_60A26480E7927C74 ON prestataire');
        $this->addSql('DROP INDEX UNIQ_60A2648012B2DC9C ON prestataire');
        $this->addSql('DROP INDEX UNIQ_60A26480CFF65260 ON prestataire');
        $this->addSql('DROP INDEX UNIQ_60A26480C678AEBE ON prestataire');
    }
}
