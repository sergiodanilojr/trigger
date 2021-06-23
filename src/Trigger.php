<?php


namespace ElePHPant\Trigger;


/**
 * Class Trigger
 * @author Sérgio Danilo Jr. <https://github.com/sergiodanilojr>
 * @package Source\Support
 */
class Trigger
{
    /**
     * @var int
     */
    protected $timeOut = 5000;
    /**
     * @var array
     */
    private $type = [];
    /**
     * @var array
     */
    private $title = [];
    /**
     * @var array
     */
    private $message = [];
    /**
     * @var array
     */
    private $fields = [];


    /**
     * @return false|string
     */
    public function __toString()
    {
        return json_encode($this->render(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return mixed|null
     */
    public function render(bool $unique = true)
    {
        $triggers = [];
        $index = -1;
        if ($this->message) {
            foreach ($this->message as $trigger) {
                $index++;
                $triggers[] = (object)[
                    "icon" => $this->types()[$index],
                    "type" => $this->types()[$index],
                    "title" => $this->titles()[$index],
                    "message" => $trigger,
                    "field" => ($this->fields()[$index] ?? null),
                    "timeout" => $this->timeOut
                ];
            }
            return ($unique ? $triggers[0] : $triggers);
        }
        return null;
    }

    /**
     * @return array|null
     */
    public function fields(): ?array
    {
        return ($this->fields ?? null);
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function titles(): array
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function types(): array
    {
        return $this->type;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @param array|null $fields
     * @param int $timeOut
     * @return $this
     */
    public function success(string $message, ?string $title = null, ?array $fields = null, int $timeOut = 5000): Trigger
    {
        $this->setTrigger(__FUNCTION__, $message, $title, $fields, $timeOut);
        return $this;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @param array|null $fields
     * @param int $timeOut
     * @return $this
     */
    public function info(string $message, ?string $title = null, ?array $fields = null, int $timeOut = 5000): Trigger
    {
        $this->setTrigger(__FUNCTION__, $message, $title, $fields, $timeOut);
        return $this;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @param array|null $fields
     * @param int $timeOut
     * @return $this
     */
    public function warning(string $message, ?string $title = null, ?array $fields = null, int $timeOut = 5000): Trigger
    {
        $this->setTrigger(__FUNCTION__, $message, $title, $fields, $timeOut);
        return $this;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @param array|null $fields
     * @param int $timeOut
     * @return $this
     */
    public function error(string $message, ?string $title = null, ?array $fields = null, int $timeOut = 5000): Trigger
    {
        $this->setTrigger(__FUNCTION__, $message, $title, $fields, $timeOut);
        return $this;
    }

    public function flash()
    {
        if (!session_id()) {
            session_start();
        }

        $_SESSION['flash'] = $this;

        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION["flash"]);
            return $flash;
        }

        return null;
    }


    /**
     * @param string $message
     * @return string
     */
    protected function filter(string $message): string
    {
        return filter_var($message, FILTER_SANITIZE_STRIPPED);
    }

    /**
     * @param array $fields
     */
    protected function filterFields(array $fields): void
    {
        $fields = filter_var_array($fields, FILTER_SANITIZE_STRIPPED);

        $fields = array_unique(array_merge($this->fields, $fields));
        $reset = array_values($fields);
        $this->fields = $reset;
    }

    /**
     * @param string $trigger
     * @param string $message
     * @param string|null $title
     * @param array|null $fields
     * @param int $timeOut
     */
    protected function setTrigger(string $trigger, string $message, ?string $title = null, ?array $fields = null, int $timeOut = 5000)
    {
        $this->message[] = $this->filter($message);
        $this->type[] = $trigger;
        $this->timeOut = $timeOut;

        $this->title[] = ($title ? $this->filter($title) : null);

        if ($fields) {
            $this->filterFields($fields);
        }
    }
}