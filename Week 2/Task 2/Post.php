<?php

declare(strict_types=1);

namespace wad;

use DateTimeImmutable;

class Post
{
    public function __construct(
        private string $author,
        private string $content,
        private ?DateTimeImmutable $createdAt = null,
        /** @var Comment[] */
        private array $comments = []
    ) {
        $this->createdAt ??= new DateTimeImmutable();
    }

    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
    }

    /**
     * @return Comment[]
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    public function getCommentCount(): int
    {
        return count($this->comments);
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
