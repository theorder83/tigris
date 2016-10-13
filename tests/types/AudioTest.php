<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Audio;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Exceptions\TelegramTypeException;

class AudioTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Audio::parse([
            'file_id' => 'foo',
            'duration' => 123,
        ]);
        
        $this->assertInstanceOf(Audio::class, $a);
        $this->assertAttributeSame('foo', 'file_id', $a);
        $this->assertAttributeSame(123, 'duration', $a);

        $b = Audio::parse($a);
        $this->assertSame($a, $b);

        $z = Audio::parse(null);
        $this->assertNull($z);

        try {
            Audio::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Audio::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
