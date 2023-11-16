<?php

declare(strict_types=1);

namespace Terpz710\RandomMessagesPE;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->saveResource("messages.yml");
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $messagesConfig = new Config($this->getDataFolder() . "messages.yml", Config::YAML);
        $messages = $messagesConfig->get("messages", ["Welcome to the server, {player}!", "Enjoy your stay, {player}!"]);

        $randomMessage = $messages[array_rand($messages)];
        $formattedMessage = str_replace("{player}", $player->getName(), $randomMessage);
        $player->sendMessage($formattedMessage);
    }
}
