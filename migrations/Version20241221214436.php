<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241221214436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE testimony ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE testimony ADD CONSTRAINT FK_523C9487166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_523C9487166D1F9C ON testimony (project_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE testimony DROP FOREIGN KEY FK_523C9487166D1F9C');
        $this->addSql('DROP INDEX IDX_523C9487166D1F9C ON testimony');
        $this->addSql('ALTER TABLE testimony DROP project_id');
    }
}
