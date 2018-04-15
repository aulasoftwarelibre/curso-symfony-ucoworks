<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180415175030 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE subject (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, year VARCHAR(2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subject_user (subject_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(subject_id, user_id))');
        $this->addSql('CREATE INDEX IDX_1F59529223EDC87 ON subject_user (subject_id)');
        $this->addSql('CREATE INDEX IDX_1F595292A76ED395 ON subject_user (user_id)');
        $this->addSql('CREATE TABLE task (id INTEGER NOT NULL, subject_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, deadline_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_527EDB2523EDC87 ON task (subject_id)');
        $this->addSql('CREATE TABLE task_user (task_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(task_id, user_id))');
        $this->addSql('CREATE INDEX IDX_FE2042328DB60186 ON task_user (task_id)');
        $this->addSql('CREATE INDEX IDX_FE204232A76ED395 ON task_user (user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username VARCHAR(64) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:array)
        , PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE subject_user');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_user');
        $this->addSql('DROP TABLE user');
    }
}
