<?php

namespace App\Entity;

use http\Exception\InvalidArgumentException;

class Keyboard
{
    protected $keyboard = [];

    public function __construct()
    {
        $this->keyboard['one_time'] = false;
        $this->keyboard['buttons'] = [];
    }

    /**
     * @return $this
     */
    public function setOneTime()
    {
        $this->keyboard['one_time'] = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function setInline()
    {
        $this->keyboard['inline'] = true;
        return $this;
    }

    /**
     * @param string $label
     * @param string $color
     * @param array|null $payload
     * @param string $type
     * @return $this
     */
    protected function setButton(string $label, string $color = 'primary', array $payload = null, string $type = 'text')
    {
        if (!$label) {
            throw new InvalidArgumentException('label');
        }

        $button = ['color' => $color, 'action' => ['type' => $type, 'label' => $label]];

        if ($payload) {
            $button['action']['payload'] = json_encode($payload);
        }

        $this->keyboard['buttons'][] = [$button];

        return $this;
    }

    /**
     * @param string $label
     * @param array|null $payload
     * @return $this
     */
    public function setPositiveButton(string $label, array $payload = null)
    {
        $this->setButton($label, 'positive', $payload);
        return $this;
    }

    /**
     * @param string $label
     * @param array|null $payload
     * @return $this
     */
    public function setPrimaryButton(string $label, array $payload = null)
    {
        $this->setButton($label, 'primary', $payload);
        return $this;
    }

    /**
     * @param string $label
     * @param array|null $payload
     * @return $this
     */
    public function setNegativeButton(string $label, array $payload = null)
    {
        $this->setButton($label, 'negative', $payload);
        return $this;
    }

    /**
     * @param string $label
     * @param array|null $payload
     * @return $this
     */
    public function setSecondaryButton(string $label, array $payload = null)
    {
        $this->setButton($label, 'secondary', $payload);
        return $this;
    }

    /**
     * @return false|string
     */
    public function toString()
    {
        return json_encode($this->keyboard);
    }
}
