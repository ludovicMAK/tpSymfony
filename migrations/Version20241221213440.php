<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241221213440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10B3E79F4B');
        $this->addSql('ALTER TABLE delivery CHANGE id_project_id id_project_id INT NOT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10B3E79F4B FOREIGN KEY (id_project_id) REFERENCES project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10B3E79F4B');
        $this->addSql('ALTER TABLE delivery CHANGE id_project_id id_project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10B3E79F4B FOREIGN KEY (id_project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
