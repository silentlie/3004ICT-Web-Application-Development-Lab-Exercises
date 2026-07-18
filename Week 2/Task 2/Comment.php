<?php

declare(strict_types=1);

namespace wad;

use DateTimeImmutable;

class Comment
{
    public function __construct(
        private string $author,
        private string $content,
        private ?DateTimeImmutable $createdAt = null
    ) {
        $this->createdAt ??= new DateTimeImmutable();
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
