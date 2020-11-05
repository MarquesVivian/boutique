<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105094102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE correspondre (id INT AUTO_INCREMENT NOT NULL, id_tag_id INT NOT NULL, id_produit_id INT NOT NULL, INDEX IDX_2AE140C49CE5D6FC (id_tag_id), INDEX IDX_2AE140C4AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_tag (produit_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_423DC0FAF347EFB (produit_id), INDEX IDX_423DC0FABAD26311 (tag_id), PRIMARY KEY(produit_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE correspondre ADD CONSTRAINT FK_2AE140C49CE5D6FC FOREIGN KEY (id_tag_id) REFERENCES tag (id)');
        $this->addSql('ALTER TABLE correspondre ADD CONSTRAINT FK_2AE140C4AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_tag ADD CONSTRAINT FK_423DC0FAF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_tag ADD CONSTRAINT FK_423DC0FABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE correspondre');
        $this->addSql('DROP TABLE produit_tag');
    }
}
