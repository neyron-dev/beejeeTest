<?

namespace Framework;

final class DbConfig
{

    private array $_data;
    public function __construct(string $appDir)
    {
        $configFile = $appDir . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "db.php";
        if (!is_file($configFile)) {
            throw new \Exception("DB Config not found");
        }

        $this->_data = require_once $configFile;

        $this->validate();
    }

    private function validate()
    {
        if (empty($this->_data["host"])) {
            throw new \Exception("Host not found in the DB config");
        }
        if (empty($this->_data["port"])) {
            throw new \Exception("Port not found in the DB config");
        }
        if (empty($this->_data["user"])) {
            throw new \Exception("User not found in the DB config");
        }
        if (!isset($this->_data["password"])) {
            throw new \Exception("Password not found in the DB config");
        }
        if (!isset($this->_data["db_name"])) {
            throw new \Exception("DB Name not found in the DB config");
        }
    }

    public function getDbHost()
    {
        return $this->_data["host"];
    }

    public function getDbPort()
    {
        return $this->_data["port"];
    }

    public function getDbUser()
    {
        return $this->_data["user"];
    }

    public function getDbPassword()
    {
        return $this->_data["password"];
    }

    public function getDbName()
    {
        return $this->_data["db_name"];
    }
}
