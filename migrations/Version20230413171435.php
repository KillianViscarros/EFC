<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413171435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937519D86650F');
        $this->addSql('DROP INDEX IDX_329937519D86650F ON score');
        $this->addSql('ALTER TABLE score CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_32993751A76ED395 ON score (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751A76ED395');
        $this->addSql('DROP INDEX IDX_32993751A76ED395 ON score');
        $this->addSql('ALTER TABLE score CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937519D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_329937519D86650F ON score (user_id_id)');
    }
}
