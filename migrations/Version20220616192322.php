<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616192322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bucket_list DROP FOREIGN KEY FK_DC282CE7E3C61F9');
        $this->addSql('DROP INDEX IDX_DC282CE7E3C61F9 ON bucket_list');
        $this->addSql('ALTER TABLE bucket_list CHANGE owner_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bucket_list ADD CONSTRAINT FK_DC282CEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_DC282CEA76ED395 ON bucket_list (user_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bucket_list DROP FOREIGN KEY FK_DC282CEA76ED395');
        $this->addSql('DROP INDEX IDX_DC282CEA76ED395 ON bucket_list');
        $this->addSql('ALTER TABLE bucket_list CHANGE user_id owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bucket_list ADD CONSTRAINT FK_DC282CE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DC282CE7E3C61F9 ON bucket_list (owner_id)');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
