<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260513143757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__client AS SELECT id, name, first_name, last_name, email, phone, mobile_phone, address, postal_code, town, siret, siren, rib, created_at, user_id FROM client');
        $this->addSql('DROP TABLE client');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(20) DEFAULT NULL, mobile_phone VARCHAR(20) DEFAULT NULL, address CLOB NOT NULL, postal_code VARCHAR(10) NOT NULL, town VARCHAR(255) NOT NULL, siret VARCHAR(14) DEFAULT NULL, siren VARCHAR(9) DEFAULT NULL, rib VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO client (id, name, first_name, last_name, email, phone, mobile_phone, address, postal_code, town, siret, siren, rib, created_at, user_id) SELECT id, name, first_name, last_name, email, phone, mobile_phone, address, postal_code, town, siret, siren, rib, created_at, user_id FROM __temp__client');
        $this->addSql('DROP TABLE __temp__client');
        $this->addSql('CREATE INDEX IDX_C7440455A76ED395 ON client (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, number, status, total_ht, tva, total_ttc, created_at, user_id, client_id FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(50) NOT NULL, status VARCHAR(50) NOT NULL, total_ht NUMERIC(10, 2) NOT NULL, tva NUMERIC(5, 2) NOT NULL, total_ttc NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, user_id INTEGER NOT NULL, client_id INTEGER NOT NULL, CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9065174419EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice (id, number, status, total_ht, tva, total_ttc, created_at, user_id, client_id) SELECT id, number, status, total_ht, tva, total_ttc, created_at, user_id, client_id FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE INDEX IDX_9065174419EB6921 ON invoice (client_id)');
        $this->addSql('CREATE INDEX IDX_90651744A76ED395 ON invoice (user_id)');
        $this->addSql('ALTER TABLE invoice_item ADD COLUMN unit_price NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE invoice_item ADD COLUMN total_ht NUMERIC(10, 2) NOT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, name, description, price, unit, created_at FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, unit VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO product (id, name, description, price, unit, created_at) SELECT id, name, description, price, unit, created_at FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__client AS SELECT id, name, first_name, last_name, email, phone, mobile_phone, address, postal_code, town, siret, siren, rib, created_at, user_id FROM client');
        $this->addSql('DROP TABLE client');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, mobile_phone VARCHAR(255) NOT NULL, address CLOB NOT NULL, postal_code VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, siret VARCHAR(14) NOT NULL, siren VARCHAR(9) NOT NULL, rib VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, user_id INTEGER DEFAULT NULL, CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO client (id, name, first_name, last_name, email, phone, mobile_phone, address, postal_code, town, siret, siren, rib, created_at, user_id) SELECT id, name, first_name, last_name, email, phone, mobile_phone, address, postal_code, town, siret, siren, rib, created_at, user_id FROM __temp__client');
        $this->addSql('DROP TABLE __temp__client');
        $this->addSql('CREATE INDEX IDX_C7440455A76ED395 ON client (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice AS SELECT id, number, status, total_ht, tva, total_ttc, created_at, user_id, client_id FROM invoice');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('CREATE TABLE invoice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(50) NOT NULL, status VARCHAR(50) NOT NULL, total_ht NUMERIC(10, 2) NOT NULL, tva NUMERIC(10, 2) NOT NULL, total_ttc NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, user_id INTEGER NOT NULL, client_id INTEGER NOT NULL, CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9065174419EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice (id, number, status, total_ht, tva, total_ttc, created_at, user_id, client_id) SELECT id, number, status, total_ht, tva, total_ttc, created_at, user_id, client_id FROM __temp__invoice');
        $this->addSql('DROP TABLE __temp__invoice');
        $this->addSql('CREATE INDEX IDX_90651744A76ED395 ON invoice (user_id)');
        $this->addSql('CREATE INDEX IDX_9065174419EB6921 ON invoice (client_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, quantity, invoice_id, product_id FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quantity INTEGER NOT NULL, invoice_id INTEGER NOT NULL, product_id INTEGER NOT NULL, CONSTRAINT FK_1DDE477B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1DDE477B4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice_item (id, quantity, invoice_id, product_id) SELECT id, quantity, invoice_id, product_id FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
        $this->addSql('CREATE INDEX IDX_1DDE477B4584665A ON invoice_item (product_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, name, description, price, unit, created_at FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, price NUMERIC(10, 2) NOT NULL, unit VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO product (id, name, description, price, unit, created_at) SELECT id, name, description, price, unit, created_at FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
    }
}
