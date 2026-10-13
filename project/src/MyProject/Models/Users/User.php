<?php

namespace MyProject\Models\Users;

use MyProject\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;

    public function getNickname(): string { return $this->nickname; }

    public function isAdmin(): bool { return $this->role === 'admin'; }

    protected static function getTableName(): string
    {
        return 'users';
    }
}