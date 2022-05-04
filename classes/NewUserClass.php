<?php
/**
    Класс NewUser.
    Форматирует человека с преобразованием возраста и пола
    (п.3 и п.4) в зависимости от параметров (возвращает новый
    экземпляр StdClass со всеми полями изначального класса).
 */

    class NewUser extends User
    {

        public function __construct($id,$firstname,$lastname,$date_birth,$gender,$city)
        {
            parent::__construct($id,$firstname,$lastname,$date_birth,$gender,$city);
            $this->date_birth = parent::GetAgeUser($this->date_birth);
            $this->gender = parent::GenderConvert($this->gender);
        }

    }
?>