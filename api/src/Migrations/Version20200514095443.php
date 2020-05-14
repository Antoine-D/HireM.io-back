<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200514095443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE "user" ADD offers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD applications_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649A090B42E FOREIGN KEY (offers_id) REFERENCES offers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64929A0022 FOREIGN KEY (applications_id) REFERENCES application (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A090B42E ON "user" (offers_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64929A0022 ON "user" (applications_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649A090B42E');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64929A0022');
        $this->addSql('DROP INDEX UNIQ_8D93D649A090B42E');
        $this->addSql('DROP INDEX UNIQ_8D93D64929A0022');
        $this->addSql('ALTER TABLE "user" DROP offers_id');
        $this->addSql('ALTER TABLE "user" DROP applications_id');
    }
}
