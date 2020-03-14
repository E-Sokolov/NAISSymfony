<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311060313putStandartValues extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'put standart values in tables on glb database';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql( "INSERT INTO `clienttype` (`id`, `type`, `description`, `active`) VALUES
                    (2, 'Адвокат', 'Адвокати', ''),
                    (3, 'АК', 'Арбітражні керуючі', ''),
                    (4, 'АС', 'Акредитовані суб\'єкти (КП, БТІ та ін.)', ''),
                    (5, 'БУ', 'Банківська установа', ''),
                    (6, 'ГтУЮ', 'ГтУЮ + відділи, сектори, управління (не УДВС ГтУЮ), в тому числі УДВС, УДР', ''),
                    (7, 'ВДВС', 'Відділ державної виконавчої служби районних, районних у містах, міських (міст обласного значення) управлінь юстиції, у т.ч відділи примусового виконання рішень', ''),
                    (8, 'ВДРАЦС', 'Відділи ДРАЦС', ''),
                    (9, 'ДНК', 'Державна нотаріальна контора', ''),
                    (10, 'ПН', 'Приватні нотаріуси', ''),
                    (11, 'ПВ', 'Приватні виконавці', ''),
                    (12, 'ДФС', 'ДПІ, ДФС', ''),
                    (13, 'МВС', 'Головні управління нацполіції, поліція охорони в областях, регіональні сервісні центри МВС в областях, управління кіберполіції', ''),
                    (14, 'ОДВ', 'РДА, управління соц.захисту РДА,  управління ЖКГ РДА / міста, служба у справах дітей, управління праці та соц.захисту, департаменти РДА / ОДА', ''),
                    (15, 'ОМС', 'Сільські, селищні, міськи ради та їх виконавчі комітети', ''),
                    (16, 'ЦНАП', 'Відділи / центри надання адмін.послуг виконкомів / ОМС / РДА', ''),
                    (17, 'ЦНАП ОДВ', 'Відділи / центри надання адмін.послуг райдержадмінстрації', 'може використовуватись замість значення ЦНАП'),
                    (18, 'ЦНАП ОМС', 'Відділи / центри надання адмін.послуг органів місцевого самоврядування (виконкомів)', 'може використовуватись замість значення ЦНАП'),
                    (19, 'Прокуратура', 'Прокуратура', ''),
                    (20, 'СБУ', 'СБУ', ''),
                    (21, 'Суд', 'Суди', ''),
                    (22, 'ЦНБВПД', 'Центри з надання безоплатної вторинної правової допомоги', ''),
                    (23, 'Інші', 'Сільськогосподарські підприємства, фермерські господарства, фінансово-господарські установи (не банки), кредитні спілки, ФОП/ТОВ (користувачі МРО) ', ''),
                    (24, 'Офіс', 'Офіс філії', ''),
                    (25, 'Усі', 'Декілька типів заявників, за бажанням можете розшифрувати у полі \"Заявник\"', ''),
                    (26, 'МЮУ', 'МЮУ (для Київ обл філії)', '')");
        $this->addSql("
                    INSERT INTO `mailtype` (`id`, `alias`, `fullname`) VALUES
                    (1, 'ОЮ', 'Органи Юстиції'),
                    (2, 'РС', 'Реєстраційні служби'),
                    (3, 'ДРАЦС', 'Відділи ДРАЦС'),
                    (4, 'ДВС', 'Відділи ДВС'),
                    (5, 'ДНК', 'ДНК ПН'),
                    (6, 'Філія', 'Філія');
        ");
        $this->addSql("
                    INSERT INTO `resource` (`id`, `resource`, `fullname`) VALUES
                    (1, 'РНБ', 'Єдиний реєстр спеціальних бланків нотаріальних документів'),
                    (2, 'РСМ', 'Державний реєстр друкованих засобів масової інформації та інформаційних агентств як суб\'єктів інформаційної діяльності, Єдиний реєстр громадських формувань, Реєстр громадських об’єднань'),
                    (3, 'ДРОРМ', 'Державний реєстр обтяжень рухомого майна'),
                    (4, 'МРО', 'Модернізований реєстр обтяжень'),
                    (5, 'СР', 'Спадковий реєстр'),
                    (6, 'ЄРД', 'Єдиний реєстр довіреностей'),
                    (7, 'ДРАЦС АРМ', 'Державний реєстр актів цивільного стану громадян'),
                    (8, 'ДРАЦС web', 'Державний реєстр актів цивільного стану громадян'),
                    (9, 'ЄРПБ', 'Єдиний реєстр підприємств, щодо яких порушено провадження у справі про банкрутство'),
                    (10, 'ДРРП АРМ', 'Державний реєстр речових прав на нерухоме майно '),
                    (11, 'ДРРП UB ', 'Державний реєстр речових прав на нерухоме майно '),
                    (12, 'ЄДРОК UB', 'Єдиний державний реєстр осіб, які вчинили корупційні правопорушення'),
                    (13, 'ЛЮСТР. UB', 'Єдиний державний реєстр осіб, щодо яких застосовано положення Закону України \"Про очищення влади\"'),
                    (14, 'ЕРА UB ', 'Електронний реєстр апостилів'),
                    (15, 'ЄДР АРМ', 'Єдиний державний реєстр юридичних осіб, фізичних осіб – підприємців та громадських формувань'),
                    (16, 'ЄДР web', 'Єдиний державний реєстр юридичних осіб, фізичних осіб – підприємців та громадських формувань'),
                    (17, 'АСВП', 'Автоматизована система виконавчого провадження'),
                    (18, 'АСВП UB ', 'Автоматизована система виконавчого провадження'),
                    (19, 'СЕЗАК', 'Система електронної звітності арбітражних керуючих'),
                    (20, 'СЕЗН', 'Система електронної звітності нотаріусів'),
                    (21, 'ЕЦП ', 'Проблеми у користувача із ЕЦП'),
                    (22, 'Підключення', 'Підключення Користувача до ряду реєстрів'),
                    (23, 'ВКЗ', 'Роботи / консультації по налаштуванню ВКЗ'),
                    (24, 'Увага', 'Глобальні проблеми у ряда користувачів з певним реєстром / системою'),
                    (25, 'Зв\'язок', 'Роботи / консультації по налаштуванню каналу зв\'язку Філії'),
                    (26, 'Реєстри', 'Проблема у одного користувача з кількома реєстрами / системами'),
                    (27, 'Усі нотаріальні', 'Проблема у нотаріуса з усіма реєстрами / системами'),
                    (28, 'Усі АРМи', 'Проблема у користувача з усіма АРМами реєстрів (нотаріальні та/або ДРАЦС та/або ЄДР)'),
                    (29, 'Усі UB', 'Масова проблема з UB'),
                    (30, 'Увага', 'Глобальні проблеми у ряда користувачів з певним реєстрами / системами'),
                    (31, 'РДП', 'Проблема із віддаленим робочим столом'),
                    (32, 'ЕЦП', 'Проблеми у користувача із ЕЦП (консультація зі скачування сертифікатів, підозра на блокування ключа в наслідок великої кількості не вірно введених паролів, консультація з підключення зчитувача id-карт, перевстановлення Користувача-ІІТ та ін.)'),
                    (33, 'Ел.пошта', 'Проблеми з електронною поштою @minjust.gov.ua'),
                    (34, 'Інше', 'Інші питання'),
                    (35, 'UB', '');
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql( "TRUNCATE clienttype");
        $this->addSql( "TRUNCATE mailtype");
        $this->addSql( "TRUNCATE resource");
    }
}
