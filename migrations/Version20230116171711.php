<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230116171711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, budget_min INT NOT NULL, budget_max INT NOT NULL, home_area INT NOT NULL, bedroom_number SMALLINT NOT NULL, bathroom_number SMALLINT NOT NULL, room_number SMALLINT NOT NULL, plot_area_min INT NOT NULL, plot_area_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_sectors (client_id INT NOT NULL, sectors_id INT NOT NULL, INDEX IDX_E7A942E519EB6921 (client_id), INDEX IDX_E7A942E53479DC16 (sectors_id), PRIMARY KEY(client_id, sectors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_property_type (client_id INT NOT NULL, property_type_id INT NOT NULL, INDEX IDX_E470D22719EB6921 (client_id), INDEX IDX_E470D2279C81C6EB (property_type_id), PRIMARY KEY(client_id, property_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, plot_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_14B78418549213EC (property_id), INDEX IDX_14B78418680D0B01 (plot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plot (id INT AUTO_INCREMENT NOT NULL, sector_id INT NOT NULL, owner_id INT DEFAULT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zipcode VARCHAR(6) NOT NULL, adress VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, plot_area INT NOT NULL, slope VARCHAR(255) DEFAULT NULL, features VARCHAR(255) DEFAULT NULL, INDEX IDX_BEBB8F89DE95C867 (sector_id), INDEX IDX_BEBB8F897E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, property_type_id INT NOT NULL, owner_id INT DEFAULT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zipcode VARCHAR(6) NOT NULL, address VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, home_area INT NOT NULL, plot_area INT NOT NULL, room_number SMALLINT DEFAULT NULL, bathroom_number SMALLINT DEFAULT NULL, exposure VARCHAR(255) NOT NULL, bedroom_number SMALLINT DEFAULT NULL, garage TINYINT(1) NOT NULL, parking SMALLINT DEFAULT NULL, separated_wc TINYINT(1) NOT NULL, linving_area INT NOT NULL, INDEX IDX_8BF21CDE9C81C6EB (property_type_id), INDEX IDX_8BF21CDE7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sectors (id INT AUTO_INCREMENT NOT NULL, zipcode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visit (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, property_id INT DEFAULT NULL, plot_id INT DEFAULT NULL, appointement_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', report LONGTEXT NOT NULL, INDEX IDX_437EE93919EB6921 (client_id), INDEX IDX_437EE939549213EC (property_id), INDEX IDX_437EE939680D0B01 (plot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_sectors ADD CONSTRAINT FK_E7A942E519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_sectors ADD CONSTRAINT FK_E7A942E53479DC16 FOREIGN KEY (sectors_id) REFERENCES sectors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_property_type ADD CONSTRAINT FK_E470D22719EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_property_type ADD CONSTRAINT FK_E470D2279C81C6EB FOREIGN KEY (property_type_id) REFERENCES property_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418680D0B01 FOREIGN KEY (plot_id) REFERENCES plot (id)');
        $this->addSql('ALTER TABLE plot ADD CONSTRAINT FK_BEBB8F89DE95C867 FOREIGN KEY (sector_id) REFERENCES sectors (id)');
        $this->addSql('ALTER TABLE plot ADD CONSTRAINT FK_BEBB8F897E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE9C81C6EB FOREIGN KEY (property_type_id) REFERENCES property_type (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE93919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE939549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE939680D0B01 FOREIGN KEY (plot_id) REFERENCES plot (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_sectors DROP FOREIGN KEY FK_E7A942E519EB6921');
        $this->addSql('ALTER TABLE client_sectors DROP FOREIGN KEY FK_E7A942E53479DC16');
        $this->addSql('ALTER TABLE client_property_type DROP FOREIGN KEY FK_E470D22719EB6921');
        $this->addSql('ALTER TABLE client_property_type DROP FOREIGN KEY FK_E470D2279C81C6EB');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418549213EC');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418680D0B01');
        $this->addSql('ALTER TABLE plot DROP FOREIGN KEY FK_BEBB8F89DE95C867');
        $this->addSql('ALTER TABLE plot DROP FOREIGN KEY FK_BEBB8F897E3C61F9');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE9C81C6EB');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE7E3C61F9');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE93919EB6921');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE939549213EC');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE939680D0B01');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_sectors');
        $this->addSql('DROP TABLE client_property_type');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE plot');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE property_type');
        $this->addSql('DROP TABLE sectors');
        $this->addSql('DROP TABLE visit');
    }
}
