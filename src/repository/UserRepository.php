<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user WHERE email = :email
        ');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password_hash'],
            $user['firstname'],
            $user['lastname']
        );
    }

    public function addUser(User $user)
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.user (id_role, firstname, lastname, email, password_hash, created_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            1,
            $user->getName(),
            $user->getSurname(),
            $user->getEmail(),
            $user->getPassword(),
            $date->format('Y-m-d')
        ]);
    }
}