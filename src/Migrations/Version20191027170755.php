<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191027170755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD admin_env_id INT NOT NULL, ADD admin_ret_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1456524FD FOREIGN KEY (admin_env_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1866FEF44 FOREIGN KEY (admin_ret_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_723705D1456524FD ON transaction (admin_env_id)');
        $this->addSql('CREATE INDEX IDX_723705D1866FEF44 ON transaction (admin_ret_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1456524FD');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1866FEF44');
        $this->addSql('DROP INDEX IDX_723705D1456524FD ON transaction');
        $this->addSql('DROP INDEX IDX_723705D1866FEF44 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP admin_env_id, DROP admin_ret_id');
    }
}
