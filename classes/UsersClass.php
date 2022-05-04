<?php
    session_start();
    include 'connect_database.php';

/**
    Класс User.
    Класс содержит поля id, имя, фамилия, дата рождения, пол(0-мужской,1-женский), город рождения.
    Содержит методы:
    1. Сохранение полей экземпляра класса в БД;
 *  Поясню сразу за использование одинарных кавычек вместо обратных в sql-запросе :)
 *  Это противоречит вашим правилам написания и я с ними полностью согласна и использую в
 *  повседневной жизни, но запрос у меня работает только с одинарными, прошу понять и простить)
    2. Удаление человека из БД в соответствии с id объекта;
    3. static преобразование даты рождения в возраст (полных лет);
    4. static преобразование пола из двоичной системы в текстовую (муж, жен);
    5. Конструктор класса либо создает человека в БД с заданной
    информацией, либо берет информацию из БД по id (предусмотреть
    валидацию данных);
 * !!! Не совсем поняла 5 пункт задания, у нас для сохранения в БД есть отдельный метод из п.1, по сути это одно и тоже действие
 * и будет логичнее использовать только одну реализацию, либо через конструктор, либо через метод. Иначе после п.5, метод сохранения
 * теряет свой смысл. Возможно я неправильно вас поняла, буду благодарна отклику по данному вопросу.
    6. Форматирование человека с преобразованием возраста и (или) пола
    (п.3 и п.4) в зависимотси от параметров (возвращает новый
    экземпляр StdClass со всеми полями изначального класса).
 */

    class User
    {
        public $id;
        public $firstname;
        public $lastname;
        public $date_birth;
        public $gender;
        public $city;

        public function __construct($id,$firstname,$lastname,$date_birth,$gender,$city)
        {
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->date_birth = $date_birth;
            $this->gender = $gender;
            $this->city = $city;

            //это п.5, выше описала свои мысли, пока оставлю закомментированным.
            //$data = date('Y-m-d', strtotime($this->date_birth));
            //$query = "INSERT INTO users (id,first_name,last_name,date_birth,gender,city_birth) VALUES ('$this->id','$this->firstname','$this->lastname','$data','$this->gender','$this->city')";
            //mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        }


        public function SaveInDatabase()
        {
            $data = date('Y-m-d', strtotime($this->date_birth));
            $query = "INSERT INTO users (id,first_name,last_name,date_birth,gender,city_birth) VALUES ('$this->id','$this->firstname','$this->lastname','$data','$this->gender','$this->city')";
            mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        }


        public function DeleteUserById()
        {
            $query = "DELETE FROM users WHERE id='$this->id'";
            mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        }

        static function GetAgeUser($birthday)
        {
            $age = date('Ymd') - date('Ymd', strtotime($birthday));
            $convert_age = mb_substr($age, 0,-4);

            return $convert_age;
        }


        static function GenderConvert($gender)
        {
            if ($gender == 0) {
                $gender_str = 'муж';
            } elseif ($gender == 1){
                $gender_str = 'жен';
            }

            return $gender_str;
        }
    }
?>