<?php

namespace LindenCMS\Templator;

abstract class Component
{
    use HasTemplator;

    protected string $slot;
    protected array $slots = [];

    abstract protected function template(): string;
    
    public function __toString()
    {
        return $this->template();
    }

    public function slot(string $slot): static
    {
        $this->slot = $slot;
        return $this;
    }

    public function addSlot(string $key, string $slot): static
    {
        $this->slots[$key] = $slot;
        return $this;
    }

    public function getSlot($key): string
    {
        return $this->slots[$key] ?? '';
    }

    public function setProps(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        return $this;
    }
}