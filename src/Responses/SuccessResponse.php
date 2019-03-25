<?php

namespace RichToms\LaravelJsend\Responses;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SuccessResponse extends Response
{
    /**
     * @var string
     */
    protected $statusText = 'success';

    /**
     * @return array
     */
    protected function getResponseData()
    {
        // If the data given is an associative array, assume the developer knows what they are sending
        if (is_array($this->data) && Arr::isAssoc($this->data)) {
            return $this->data;
        }

        // If the data given is a sequential array, attempt to determine the keys to group the response by
        if (is_array($this->data)) {
            return $this->mergeKeys(
                $this->determineKeys($this->data),
                $this->data
            );
        }

        if (! is_object($this->data)) {
            return ['object' => $this->data];
        }

        // If the class name contains Resource
        if (stristr($className = class_basename($this->data), 'Resource') !== false) {
            return [
                Str::plural(
                    $this->toSlug(explode('Resource', $className)[0]),
                    stristr($className, 'Collection') !== false ? 0 : 1
                ) => $this->data->toArray(),
            ];
        }

        // If the data is not an object and is not a Laravel Resource, return the class name and the value
        return [
            $this->toSlug($className) => $this->data,
        ];
    }

    /**
     * @param  array  $keys
     * @param  array  $values
     * @return array
     */
    protected function mergeKeys($keys = [], $values = [])
    {
        // Group the values that come out with the slug that matches the key
        return array_combine($keys, array_map(function ($arr) {
            return array_values($arr);
        }, array_map(function ($key) use ($values) {
            return Arr::where($values, function ($value) use ($key) {
                return $this->determineSlug($value) === $key;
            });
        }, $keys)));
    }

    /**
     * @param  array  $values
     * @return array
     */
    protected function determineKeys($values)
    {
        return array_unique(array_map(function ($value) {
            return $this->determineSlug($value);
        }, $values));
    }

    /**
     * @param  mixed  $value
     * @return string
     */
    protected function determineSlug($value)
    {
        return $this->toSlug(Str::plural((function ($value) {
            if (is_object($value)) {
                return class_basename($value);
            }

            return $value['type'] ?? 'object';
        })($value)));
    }

    protected function toSlug($string)
    {
        return Str::snake($string);
    }
}
