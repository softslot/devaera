<?php

declare(strict_types=1);

namespace App\Module\Article\Domain\Model\Article;

use App\Module\Article\Domain\Model\Article\ValueObject\Content;
use App\Module\Article\Domain\Model\Article\ValueObject\Id;
use App\Module\Article\Domain\Model\Article\ValueObject\Title;
use App\Module\Article\Infrastructure\Doctrine\Article\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: '`article_articles`')]
final class Article
{
    #[ORM\Embedded(class: Id::class, columnPrefix: false)]
    private Id $id;

    #[ORM\Embedded(class: Title::class, columnPrefix: false)]
    private Title $title;

    #[ORM\Embedded(class: Content::class, columnPrefix: false)]
    private Content $content;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    public function __construct(
        Id $id,
        Title $title,
        Content $content,
        ?\DateTimeImmutable $createdAt = null,
        ?\DateTimeImmutable $updatedAt = null,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = $createdAt ?? new \DateTimeImmutable();
        $this->updatedAt = $updatedAt ?? new \DateTimeImmutable();
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function setContent(Content $content): void
    {
        $this->content = $content;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
