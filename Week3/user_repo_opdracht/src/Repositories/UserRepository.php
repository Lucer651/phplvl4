<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Domain\User;
use PDO;

class UserRepository
{
    public function __construct(private readonly PDO $pdo) {}
    public function findByUsername(string $username): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE username = :username'
        );
        $stmt->execute([':username' => $username]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return [
            'user' => $this->hydrate($row),
            'password' => $row['password'],
        ];
    }

    public function register(string $username, string $email, string $passwordHash): User
    {
        // Note: the column in your CREATE TABLE is called 'password', not 'password_hash'
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)'
        );
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $passwordHash,
        ]);

        $id = (int) $this->pdo->lastInsertId();
        return new User($id, $username, $email);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE email = :email'
        );
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return [
            'user' => $this->hydrate($row),
            'password' => $row['password'],
        ];
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE id = :id'
        );
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return $row ? $this->hydrate($row) : null;
    }
    private function hydrate(array $row): User
    {
        return new User(
            id: (int) $row['id'],
            username: $row['username'],
            email: $row['email'],
        );
    }
}