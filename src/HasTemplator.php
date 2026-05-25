<?php

namespace LindenCMS\Templator;

use Closure;

trait HasTemplator
{
    protected function loop(iterable $in, ?Closure $callback = null): string
    {
        if (!$callback) {
            $callback = fn($v, $k) => $v;
        }

        return implode(array_map(
            fn($key, $value) => $callback($value, $key),
            array_keys($in),
            array_values($in)
        ));
    }

    protected function pl(string|Closure $template): string
    {
        if ($template instanceof Closure) {
            return $template();
        }

        return $template;
    }

    protected function if(mixed $flag, string|Closure $template, string|Closure|null $elseTemplate = null)
    {
        if ($flag) {
            if ($template instanceof Closure) {
                return $template();
            }

            return $template;
        }

        if ($elseTemplate) {
            if ($elseTemplate instanceof Closure) {
                return $elseTemplate();
            }

            return $elseTemplate;
        }
    }

    /**
     * Merge all $vals into the one string
     * @param array $vals
     * @return string
     */
    protected function mr(...$vals): string
    {
        return implode($vals);
    }
}
