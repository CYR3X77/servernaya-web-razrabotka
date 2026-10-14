<?php

namespace MyProject\Models\Comments;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Services\Db;

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    public function getText(): string { return $this->text; }
    public function getArticleId(): int { return (int) $this->articleId; }
    public function getCreatedAt(): string { return $this->createdAt; }

    public function getAuthor(): User
    {
        return User::getById((int) $this->authorId);
    }

    public function canBeEditedBy(User $user): bool
    {
        return $user->isAdmin() || (int) $this->authorId === $user->getId();
    }

    /** @return static[] */
    public static function findAllByArticleId(int $articleId): array
    {
        $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE article_id = :article_id ORDER BY id ASC;',
            [':article_id' => $articleId],
            static::class
        );
    }

    public static function add(array $data, User $author, Article $article): Comment
    {
        $text = self::validateText($data);

        $comment = new Comment();
        $comment->authorId = $author->getId();
        $comment->articleId = $article->getId();
        $comment->text = $text;
        $comment->save();

        return $comment;
    }

    public function updateFromArray(array $data): Comment
    {
        $this->text = self::validateText($data);
        $this->save();

        return $this;
    }

    private static function validateText(array $data): string
    {
        $text = trim($data['text'] ?? '');

        if ($text === '') {
            throw new InvalidArgumentException('Текст комментария не может быть пустым');
        }

        return $text;
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }
}