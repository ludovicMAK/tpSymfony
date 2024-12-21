<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241221213607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE testimony DROP FOREIGN KEY FK_523C948779F37AE5');
        $this->addSql('ALTER TABLE testimony CHANGE id_user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE testimony ADD CONSTRAINT FK_523C948779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE testimony DROP FOREIGN KEY FK_523C948779F37AE5');
        $this->addSql('ALTER TABLE testimony CHANGE id_user_id id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE testimony ADD CONSTRAINT FK_523C948779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
