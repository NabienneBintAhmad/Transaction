<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902110643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_prestataire DROP FOREIGN KEY FK_C9B9AD1544470C10');
        $this->addSql('DROP INDEX IDX_C9B9AD1544470C10 ON user_prestataire');
        $this->addSql('ALTER TABLE user_prestataire DROP compte_de_travail_id');
        $this->addSql('ALTER TABLE compte ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CFF65260A76ED395 ON compte (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260A76ED395');
        $this->addSql('DROP INDEX IDX_CFF65260A76ED395 ON compte');
        $this->addSql('ALTER TABLE compte DROP user_id');
        $this->addSql('ALTER TABLE user_prestataire ADD compte_de_travail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_prestataire ADD CONSTRAINT FK_C9B9AD1544470C10 FOREIGN KEY (compte_de_travail_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_C9B9AD1544470C10 ON user_prestataire (compte_de_travail_id)');
    }
}
