<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200312025552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `Modules` (`id`, `url`, `icon`,`title`) VALUES
                    (1, '/calls', '/img/calls.png','Журнал Звонков'),
                    (2, '/mail', '/img/mail.png','База E-mail'),
                    (3, '/know', '/img/know.png','База знаний'),
                    (4, '/maintenance', '/img/maintenance.png', 'Выезды инженеров'),
                    (5, '/profile','/img/profile.png','Работники филии'),
                    (6,'/gauth', '/img/gauth.png', 'Дополнительная аутентификация')
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("TRUNCATE Modules");
    }
}
