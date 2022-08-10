<?php

declare(strict_types=1);

namespace WyriHaximus\React\Cache;

use React\Cache\CacheInterface;

use function serialize;
use function unserialize;

final class Serialize implements CacheInterface
{
    public function __construct(private readonly CacheInterface $cache)
    {
    }

    /**
     * @inheritDoc
     * @phpstan-ignore-next-line
     */
    public function get($key, $default = null)
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         * @psalm-suppress MissingClosureParamType
         */
        return $this->cache->get($key, $default)->then(static function ($result) use ($default): mixed {
            if ($result === null || $result === $default) {
                return $default;
            }

            /**
             * @psalm-suppress MixedArgument
             */
            return unserialize($result);
        });
    }

    /**
     * @inheritDoc
     * @phpstan-ignore-next-line
     */
    public function set($key, $value, $ttl = null)
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->cache->set($key, serialize($value), $ttl);
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->cache->delete($key);
    }

    /**
     * @inheritDoc
     * @phpstan-ignore-next-line
     */
    public function getMultiple(array $keys, $default = null)
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         * @psalm-suppress MissingClosureParamType
         */
        return $this->cache->getMultiple($keys, $default)->then(static function ($results) use ($default) {
            /**
             * @psalm-suppress MixedAssignment
             */
            foreach ($results as $key => $result) {
                if ($result === null || $result === $default) {
                    continue;
                }

                /**
                 * @psalm-suppress MixedAssignment
                 * @psalm-suppress MixedArrayAssignment
                 * @psalm-suppress MixedArrayOffset
                 * @psalm-suppress MixedArgument
                 */
                $results[$key] = unserialize($result);
            }

            return $results;
        });
    }

    /**
     * @inheritDoc
     * @phpstan-ignore-next-line
     */
    public function setMultiple(array $values, $ttl = null)
    {
        /**
         * @psalm-suppress MixedAssignment
         */
        foreach ($values as $key => $value) {
            $values[$key] = serialize($value);
        }

        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->cache->setMultiple($values, $ttl);
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple(array $keys)
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->cache->deleteMultiple($keys);
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->cache->clear();
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->cache->has($key);
    }
}
