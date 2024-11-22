<?php

include('connect.php');


class User
{
    public $name;
    public $surname;
    public $student_group;
    public $login;
    public $password;
    public $role;

    function __construct($name,  $surname,  $student_group,  $login,  $password,  $role)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->student_group = $student_group;
        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
    }
}
$users = [
    new User('иван', 'иванов', 325, '11111', password_hash('11111', PASSWORD_BCRYPT), 1),
    new User('саша', 'иванов', 345, '11112', password_hash('11112', PASSWORD_BCRYPT), 1),
    new User('кеша', 'степанов', 154, '11117', password_hash('11117', PASSWORD_BCRYPT), 1),
    new User('оля', 'романова', 212, '11118', password_hash('11118', PASSWORD_BCRYPT), 2),
    new User('настя', 'синицына', 205, '11119', password_hash('11119', PASSWORD_BCRYPT), 1),
    new User('никита', 'абрамов', 111, '11120', password_hash('11120', PASSWORD_BCRYPT), 2),
    new User('рома', 'абрамов', 135, '11121', password_hash('11121', PASSWORD_BCRYPT), 1),
    new User('петя', 'матвеев', 425, '11122', password_hash('11122', PASSWORD_BCRYPT), 1),
    new User('соня', 'грищенкл', 231, '11123', password_hash('11123', PASSWORD_BCRYPT), 1),
    new User('катя', 'стрелкова', 321, '11124', password_hash('11124', PASSWORD_BCRYPT), 1),
    new User('ваислий', 'митеев', 411, '11125', password_hash('11125', PASSWORD_BCRYPT), 0),
    new User('людмила', 'пономарева', 321, '11126', password_hash('11126', PASSWORD_BCRYPT), 1),
    new User('алина', 'кузнецова', 123, '11127', password_hash('11127', PASSWORD_BCRYPT), 0),
    new User('михаил', 'моисеев', 222, '11128', password_hash('11128', PASSWORD_BCRYPT), 1),
    new User('дмитрий', 'солнцев', 227, '11129', password_hash('11129', PASSWORD_BCRYPT), 1),
    new User('петя', 'матвеев', 425, '11122', password_hash('11130', PASSWORD_BCRYPT), 1),
    new User('соня', 'грищенкл', 231, '11123', password_hash('11131', PASSWORD_BCRYPT), 1),
    new User('катя', 'стрелкова', 321, '11124', password_hash('11132', PASSWORD_BCRYPT), 1),
    new User('ваислий', 'митеев', 411, '11125', password_hash('11133', PASSWORD_BCRYPT), 0),
    new User('людмила', 'пономарева', 321, '11126', password_hash('11134', PASSWORD_BCRYPT), 1),
    new User('алина', 'кузнецова', 123, '11127', password_hash('11135', PASSWORD_BCRYPT), 0),
    new User('михаил', 'моисеев', 222, '11128', password_hash('11136', PASSWORD_BCRYPT), 1),
    new User('дмитрий', 'солнцев', 227, '11129', password_hash('11137', PASSWORD_BCRYPT), 1),
    
];

foreach ($users as $user) {
    try {

        $stmt = $link->prepare("INSERT INTO `user`(`name`, `surname`, `student_group`, `login`, `password`, `role`, `img`)
    VALUES (?, ?, ?, ?, ?, ?, null)");

        $stmt->execute([$user->name, $user->surname, $user->student_group, $user->login, $user->password, $user->role]);
    } catch (PDOException $e) {
        echo "Error: ". $e;
    }
}

echo "Migration successfull";