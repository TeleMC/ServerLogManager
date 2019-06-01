<?PHP

namespace ServerLogManager;

use pocketmine\block\Block;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use UiLibrary\UiLibrary;

class ServerLogManager extends PluginBase {

    private static $instance = null;
    public $pre = "§e•";

    public static function getInstance() {
        return self::$instance;
    }

    public function onLoad() {
        self::$instance = $this;
    }

    public function onEnable() {
        date_default_timezone_set("Asia/Seoul");
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        @mkdir($this->getDataFolder());
        @mkdir($this->getDataFolder() . $this->getToday());
        $this->ui = UiLibrary::getInstance();
    }

    public function getToday() {
        return date("Y-m-d", time());
    }

    public function list() {
        return [
                "block",
                "chat",
                "command"
        ];
    }

    public function addBlockLog(string $name, Block $block, int $cause, string $type) { // AreaManager 에서 처리
        $name = mb_strtolower($name);
        @mkdir($this->getDataFolder());
        @mkdir($this->getDataFolder() . $this->getToday());
        if ($cause == 0) {
            $file = $this->getDataFolder() . $this->getToday() . "/block.txt";
            $value = "[{$this->getTime()}] {$name} > {$block->getX()}:{$block->getY()}:{$block->getZ()} | {$block->getId()}:{$block->getDamage()} {$type}\n";
            if (!file_exists($file)) {
                file_put_contents($file, $value);
            } else {
                $file = fopen($file, "a");
                fwrite($file, $value, strlen($value));
                fclose($file);
            }

            $file = $this->getDataFolder() . "block.yml";
            $config = new Config($file, Config::YAML);
            $data = $config->getAll();
            $key = "{$block->getX()}:{$block->getY()}:{$block->getZ()}:{$block->getLevel()->getName()}";
            $value = "[{$this->getTime()}] {$name} > {$block->getId()}:{$block->getDamage()} {$type}";
            $data[$key][] = $value;
            $config->setAll($data);
            $config->save();
        }
    }

    public function getTime() {
        return date("h시 i분", time());
    }

    public function addChatCommandLog(string $name, string $value, int $cause, string $type = "전체") { // PacketEventMaager, CommandManager 에서 처리
        $name = mb_strtolower($name);
        if ($cause == 1) {
            $file = $this->getDataFolder() . $this->getToday() . "/chat.txt";
            $value = "[{$this->getTime()}] [{$type}] {$name} > {$value}\n";
            if (!file_exists($file)) {
                file_put_contents($file, $value);
            } else {
                $file = fopen($file, "a");
                fwrite($file, $value, strlen($value));
                fclose($file);
            }
        } elseif ($cause == 2) {
            $file = $this->getDataFolder() . $this->getToday() . "/command.txt";
            $value = "[{$this->getTime()}] {$name} > {$value}\n";
            if (!file_exists($file)) {
                file_put_contents($file, $value);
            } else {
                $file = fopen($file, "a");
                fwrite($file, $value, strlen($value));
                fclose($file);
            }
        }
    }
}
