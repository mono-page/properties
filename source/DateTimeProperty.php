<?php declare(strict_types=1);

namespace Monopage\Properties;

use DateTimeImmutable;
use DateTimeZone;
use Exception;
use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Properties\Exceptions\PropertyValidationException;

class DateTimeProperty extends DateTimeImmutable implements ValueObjectInterface, StringableInterface
{
    protected function __construct(string $time = 'now', DateTimeZone $timezone = null)
    {
        parent::__construct($time, $timezone);
    }

    /**
     * @param string $value
     * @param string $format
     *
     * @return static
     *
     * @throws PropertyValidationException
     */
    public static function create(string $value, string $format = 'Y-m-d H:i:s'): self
    {
        # @todo В данный момент не ясно, расширять ли существующий обьект или создавать новый

        try {
            return new self($value);
        } catch (Exception $e) {
            throw new PropertyValidationException('Wrong value');
        }
    }

    public function __toString(): string
    {
        return $this->format('c'); # ISO8601 'Y-m-d\TH:i:sO'
    }
}