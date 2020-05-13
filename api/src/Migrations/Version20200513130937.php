<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513130937 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE greeting_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE application_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contracts_types_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE application_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE offers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE application (id INT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, gender VARCHAR(2) NOT NULL, picture VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, age INT NOT NULL, address VARCHAR(255) NOT NULL, motivation_field VARCHAR(255) NOT NULL, salary_wanted INT NOT NULL, cv VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contracts_types (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE application_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE offers (id INT NOT NULL, contract_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, company_description VARCHAR(255) NOT NULL, offer_description VARCHAR(255) NOT NULL, start_date DATE NOT NULL, work_location VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA460427CD1DF15B ON offers (contract_type_id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427CD1DF15B FOREIGN KEY (contract_type_id) REFERENCES contracts_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE greeting');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE offers DROP CONSTRAINT FK_DA460427CD1DF15B');
        $this->addSql('DROP SEQUENCE application_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contracts_types_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE application_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE offers_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE greeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE greeting (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE contracts_types');
        $this->addSql('DROP TABLE application_status');
        $this->addSql('DROP TABLE offers');
    }
}
