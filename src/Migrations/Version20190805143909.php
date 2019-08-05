<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190805143909 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_prestataire ADD authent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_prestataire ADD CONSTRAINT FK_C9B9AD15F4BE6066 FOREIGN KEY (authent_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C9B9AD15F4BE6066 ON user_prestataire (authent_id)');
        $this->addSql('ALTER TABLE caissier ADD authent_id INT NOT NULL');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC2F4BE6066 FOREIGN KEY (authent_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F038BC2F4BE6066 ON caissier (authent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE caissier DROP FOREIGN KEY FK_1F038BC2F4BE6066');
        $this->addSql('DROP INDEX UNIQ_1F038BC2F4BE6066 ON caissier');
        $this->addSql('ALTER TABLE caissier DROP authent_id');
        $this->addSql('ALTER TABLE user_prestataire DROP FOREIGN KEY FK_C9B9AD15F4BE6066');
        $this->addSql('DROP INDEX UNIQ_C9B9AD15F4BE6066 ON user_prestataire');
        $this->addSql('ALTER TABLE user_prestataire DROP authent_id');
    }
}
