<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\View\View;

class ArticlesController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'title'   => $article->getName(),
        ]);
    }

    public function edit(int $articleId): void
    {
        /** @var Article|null $article */
        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $name = $article->getName();
        $text = $article->getText();
        $error = null;

        if (!empty($_POST)) {
            $name = trim($_POST['name'] ?? '');
            $text = trim($_POST['text'] ?? '');

            if ($name === '' || $text === '') {
                $error = 'Название и текст статьи не должны быть пустыми';
            } else {
                $article->setName($name);
                $article->setText($text);
                $article->save();

                header('Location: /articles/' . $article->getId(), true, 302);
                return;
            }
        }

        $this->view->renderHtml('articles/edit.php', [
            'article' => $article,
            'name'    => $name,
            'text'    => $text,
            'error'   => $error,
            'title'   => 'Редактирование статьи',
        ]);
    }
}