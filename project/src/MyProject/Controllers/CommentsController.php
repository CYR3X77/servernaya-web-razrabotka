<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class CommentsController extends AbstractController
{
    /** POST /articles/123/comments */
    public function add(int $articleId): void
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            header('Location: /users/login');
            return;
        }

        if (empty($_POST)) {
            header('Location: /articles/' . $articleId);
            return;
        }

        try {
            $comment = Comment::add($_POST, $this->user, $article);
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('articles/view.php', [
                'article'      => $article,
                'commentError' => $e->getMessage(),
                'title'        => $article->getName(),
            ]);
            return;
        }

        header('Location: /articles/' . $articleId . '#comment' . $comment->getId());
    }

    /** GET/POST /comments/456/edit */
    public function edit(int $commentId): void
    {
        /** @var Comment|null $comment */
        $comment = Comment::getById($commentId);
        if ($comment === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            header('Location: /users/login');
            return;
        }

        if (!$comment->canBeEditedBy($this->user)) {
            throw new ForbiddenException('Нельзя редактировать чужой комментарий');
        }

        if (!empty($_POST)) {
            try {
                $comment->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('comments/edit.php', [
                    'comment' => $comment,
                    'error'   => $e->getMessage(),
                    'title'   => 'Редактирование комментария',
                ]);
                return;
            }

            header('Location: /articles/' . $comment->getArticleId() . '#comment' . $comment->getId());
            return;
        }

        $this->view->renderHtml('comments/edit.php', [
            'comment' => $comment,
            'title'   => 'Редактирование комментария',
        ]);
    }
}