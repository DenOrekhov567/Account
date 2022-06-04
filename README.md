#Account
Плагин для Pocketmine MP 4.

#Overview
Плагин использовать только как инструмент для разработки.

#Compatibility
Плагин совместим с DataBase(github.com/DenOrekhov567/DataBase), работать без него он не будет.

#Code samples
Вообще, смотрите все о JsonMapper, чтобы добавлять свои данные.

Получить данные игрока:
$player->getAccount()->getData()->...
Предполагается, что $player это объект \pocketmine\Player

Занести данные игрока:
$player->getAccount()->getData()->... = $data;
$player->getAccount->update(); //отправить данные в таблицу
Предполагается, что $player это объект \pocketmine\Player, а $data - mixed данные.

Получить аккаунт игрока, которого нет на сервере:
Utils::getAccount($nickname)
Предполагается, что $nickname - это string.
...
