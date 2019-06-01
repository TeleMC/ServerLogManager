<?php
namespace ServerLogManager;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\Player;
use pocketmine\Server;

class EventListener implements Listener {
    private $plugin;

    public function __construct(ServerLogManager $plugin) {
        $this->plugin = $plugin;
    }

    /*public function onChat(PlayerChatEvent $ev){
      $player = $ev->getPlayer();
      if(!$ev->isCancelled())
        $this->plugin->addChatCommandLog($player->getName(), $ev->getMessage(), 1, "전체");
    }*/

    /*public function onCmd(PlayerCommandPreprocessEvent $ev){
      if(substr($ev->getMessage(), 0, 1) !== '/')
        return;
      $player = $ev->getPlayer();
      if(!$ev->isCancelled())
        $this->plugin->addChatCommandLog($player->getName(), $ev->getMessage(), 2);
    }

    public function onPlace(BlockPlaceEvent $ev){
      $player = $ev->getPlayer();
      if(!$ev->isCancelled())
        $this->plugin->addBlockLog($player->getName(), $ev->getBlock(), 0, "설치");
    }

    public function onBreak(BlockBreakEvent $ev){
      $player = $ev->getPlayer();
      if(!$ev->isCancelled())
        $this->plugin->addBlockLog($player->getName(), $ev->getBlock(), 0, "파괴");
    }*/

}
