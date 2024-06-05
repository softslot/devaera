<?php

declare(strict_types=1);

namespace App\Module\Article\Domain\Model\Article\ValueObject;

use Doctrine\DBAL\Types\Types;
use Override;
use Ramsey\Uuid\Uuid;
use Stringable;
use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final readonly class Id implements Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::INTEGER, options: ['unsigned' => true])]
    private string $value;

    public function __construct(string $value)
    {
        Assert::uuid($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    #[Override]
    public function __toString(): string
    {
        return $this->getValue();
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid7()->toString());
    }
}
