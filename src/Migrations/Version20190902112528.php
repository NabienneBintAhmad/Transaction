<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902112528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_prestataire ADD compte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_prestataire ADD CONSTRAINT FK_C9B9AD15F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_C9B9AD15F2C56620 ON user_prestataire (compte_id)');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260A76ED395');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260D5B86DEE');
        $this->addSql('DROP INDEX IDX_CFF65260A76ED395 ON compte');
        $this->addSql('DROP INDEX IDX_CFF65260D5B86DEE ON compte');
        $this->addSql('ALTER TABLE compte DROP user_prestataire_id, DROP user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte ADD user_prestataire_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260D5B86DEE FOREIGN KEY (user_prestataire_id) REFERENCES user_prestataire (id)');
        $this->addSql('CREATE INDEX IDX_CFF65260A76ED395 ON compte (user_id)');
        $this->addSql('CREATE INDEX IDX_CFF65260D5B86DEE ON compte (user_prestataire_id)');
        $this->addSql('ALTER TABLE user_prestataire DROP FOREIGN KEY FK_C9B9AD15F2C56620');
        $this->addSql('DROP INDEX IDX_C9B9AD15F2C56620 ON user_prestataire');
        $this->addSql('ALTER TABLE user_prestataire DROP compte_id');
    }
}
