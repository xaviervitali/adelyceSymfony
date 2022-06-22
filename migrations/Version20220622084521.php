<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220622084521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shared_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, shared_with_id INT DEFAULT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_F29D081A4584665A (product_id), UNIQUE INDEX UNIQ_F29D081AD14FE63F (shared_with_id), INDEX IDX_F29D081AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shared_product ADD CONSTRAINT FK_F29D081A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE shared_product ADD CONSTRAINT FK_F29D081AD14FE63F FOREIGN KEY (shared_with_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE shared_product ADD CONSTRAINT FK_F29D081AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shared_product DROP FOREIGN KEY FK_F29D081A4584665A');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE shared_product');
    }
}
