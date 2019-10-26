<?php declare(strict_types=1);

namespace WyriHaximus\Tests\React\Cache;

use React\Cache\CacheInterface;
use function React\Promise\resolve;
use WyriHaximus\AsyncTestUtilities\AsyncTestCase;
use WyriHaximus\React\Cache\Serialize;

/**
 * @internal
 */
final class SerializeTest extends AsyncTestCase
{
    public function testGet(): void
    {
        $key = 'sleutel';
        $string = 'a:1:{s:3:"foo";s:3:"bar";}';
        $json = [
            'foo' => 'bar',
        ];

        $cache = $this->prophesize(CacheInterface::class);
        $cache->get($key, null)->shouldBeCalled()->willReturn(resolve($string));

        $jsonCache = new Serialize($cache->reveal());
        self::assertSame($json, $this->await($jsonCache->get($key)));
    }

    public function testGetNullShouldBeIgnored(): void
    {
        $key = 'sleutel';

        $cache = $this->prophesize(CacheInterface::class);
        $cache->get($key, null)->shouldBeCalled()->willReturn(resolve(null));

        $jsonCache = new Serialize($cache->reveal());
        self::assertNull($this->await($jsonCache->get($key)));
    }

    public function testSet(): void
    {
        $key = 'sleutel';
        $string = 'a:1:{s:3:"foo";s:3:"bar";}';
        $json = [
            'foo' => 'bar',
        ];

        $cache = $this->prophesize(CacheInterface::class);
        $cache->set($key, $string, null)->shouldBeCalled();

        $jsonCache = new Serialize($cache->reveal());
        $jsonCache->set($key, $json);
    }

    public function testDelete(): void
    {
        $key = 'sleutel';

        $cache = $this->prophesize(CacheInterface::class);
        $cache->delete($key)->shouldBeCalled();

        $jsonCache = new Serialize($cache->reveal());
        $jsonCache->delete($key);
    }

    public function testGetMultiple(): void
    {
        $key = 'sleutel';
        $string = 'a:1:{s:3:"foo";s:3:"bar";}';
        $json = [
            'foo' => 'bar',
        ];

        $cache = $this->prophesize(CacheInterface::class);
        $cache->getMultiple([$key], null)->shouldBeCalled()->willReturn(resolve([$key => $string]));

        $jsonCache = new Serialize($cache->reveal());
        self::assertSame([$key => $json], $this->await($jsonCache->getMultiple([$key])));
    }

    public function testGetMultipleNullShouldBeIgnored(): void
    {
        $key = 'sleutel';

        $cache = $this->prophesize(CacheInterface::class);
        $cache->getMultiple([$key], null)->shouldBeCalled()->willReturn(resolve([$key => null]));

        $jsonCache = new Serialize($cache->reveal());
        self::assertNull(\current($this->await($jsonCache->getMultiple([$key]))));
    }

    public function testSetMultiple(): void
    {
        $key = 'sleutel';
        $string = 'a:1:{s:3:"foo";s:3:"bar";}';
        $json = [
            'foo' => 'bar',
        ];

        $cache = $this->prophesize(CacheInterface::class);
        $cache->setMultiple([$key => $string], null)->shouldBeCalled();

        $jsonCache = new Serialize($cache->reveal());
        $jsonCache->setMultiple([$key => $json]);
    }

    public function testDeleteMultiple(): void
    {
        $key = 'sleutel';
        $cache = $this->prophesize(CacheInterface::class);
        $cache->deleteMultiple([$key], null)->shouldBeCalled();

        $jsonCache = new Serialize($cache->reveal());
        $jsonCache->deleteMultiple([$key]);
    }

    public function testClear(): void
    {
        $cache = $this->prophesize(CacheInterface::class);
        $cache->clear()->shouldBeCalled();

        $jsonCache = new Serialize($cache->reveal());
        $jsonCache->clear();
    }

    public function testHas(): void
    {
        $key = 'sleutel';
        $cache = $this->prophesize(CacheInterface::class);
        $cache->has($key, null)->shouldBeCalled();

        $jsonCache = new Serialize($cache->reveal());
        $jsonCache->has($key);
    }
}
