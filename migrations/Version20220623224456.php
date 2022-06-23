<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623224456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_shared_product (product_id INT NOT NULL, shared_product_id INT NOT NULL, INDEX IDX_A1F476364584665A (product_id), INDEX IDX_A1F4763631978695 (shared_product_id), PRIMARY KEY(product_id, shared_product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shared_product (id INT AUTO_INCREMENT NOT NULL, shared_with_id INT DEFAULT NULL, user_id INT DEFAULT NULL, product_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_F29D081AD14FE63F (shared_with_id), INDEX IDX_F29D081AA76ED395 (user_id), INDEX IDX_F29D081A4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, gender VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_shared_product ADD CONSTRAINT FK_A1F476364584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_shared_product ADD CONSTRAINT FK_A1F4763631978695 FOREIGN KEY (shared_product_id) REFERENCES shared_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shared_product ADD CONSTRAINT FK_F29D081AD14FE63F FOREIGN KEY (shared_with_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE shared_product ADD CONSTRAINT FK_F29D081AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE shared_product ADD CONSTRAINT FK_F29D081A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_shared_product DROP FOREIGN KEY FK_A1F476364584665A');
        $this->addSql('ALTER TABLE shared_product DROP FOREIGN KEY FK_F29D081A4584665A');
        $this->addSql('ALTER TABLE product_shared_product DROP FOREIGN KEY FK_A1F4763631978695');
        $this->addSql('ALTER TABLE shared_product DROP FOREIGN KEY FK_F29D081AD14FE63F');
        $this->addSql('ALTER TABLE shared_product DROP FOREIGN KEY FK_F29D081AA76ED395');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_shared_product');
        $this->addSql('DROP TABLE shared_product');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
