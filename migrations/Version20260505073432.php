<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260505073432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, first_name, last_name, password, company_name, adress, postal_code, town, iban, siret, siren FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, company_name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, siren VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL)');
        $this->addSql('INSERT INTO user (id, first_name, last_name, password, company_name, adress, postal_code, town, iban, siret, siren) SELECT id, first_name, last_name, password, company_name, adress, postal_code, town, iban, siret, siren FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, password, first_name, last_name, company_name, adress, postal_code, town, iban, siret, siren FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, company_name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, siren VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO "user" (id, password, first_name, last_name, company_name, adress, postal_code, town, iban, siret, siren) SELECT id, password, first_name, last_name, company_name, adress, postal_code, town, iban, siret, siren FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
