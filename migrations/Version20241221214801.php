<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241221214801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE testimony DROP FOREIGN KEY FK_523C9487166D1F9C');
        $this->addSql('ALTER TABLE testimony CHANGE project_id project_id INT NOT NULL');
        $this->addSql('ALTER TABLE testimony ADD CONSTRAINT FK_523C9487166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE testimony DROP FOREIGN KEY FK_523C9487166D1F9C');
        $this->addSql('ALTER TABLE testimony CHANGE project_id project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE testimony ADD CONSTRAINT FK_523C9487166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
