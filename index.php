<?php
    include 'classes/UsersClass.php';
    include 'classes/NewUserClass.php';

    $user1  = new User(130,'Bob','Galager','03.12.2001','0','Chicago');
    $user2  = new User(145,'Alice','Kulakova','05.06.1989','1','Minsk');
    $user3  = new User(323,'Andrey','Ivanov','15.04.2002','0','Zhlobin');

    $newUser1 = new NewUser(130,'Bob','Galager','03.12.2001','0','Chicago');

    $user1->SaveInDatabase();
    $user2->SaveInDatabase();
    $user3->SaveInDatabase();

    $user2->DeleteUserById();

    echo print_r($user1)."<br>";
    echo print_r($newUser1)."<br>";

    echo $user1->GetAgeUser(strval($user1->date_birth))."<br>";
    echo $user2->GenderConvert(strval($user2->gender))."<br>";
?>