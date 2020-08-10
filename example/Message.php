<?php

namespace Example\Message;

/**
 * Class Message
 * @package Example\Message
 */
class Message extends \ElePHPant\Trigger\Trigger
{
    /**
     * @param string $message
     * @param string|null $title
     * @param array|null $fields
     * @param int $timeOut
     * @return $this
     */
    public function danger(string $message, ?string $title = null, ?array $fields = null, int $timeOut = 5000): self
    {
        $this->setTrigger(__FUNCTION__, $message, $title, $fields, $timeOut);
        return $this;
    }
}