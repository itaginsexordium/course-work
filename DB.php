<?php


class DB_Connector
{
    protected $servername = "localhost";//127.0.0.1
    protected $username = "root";
    protected $password = "root";
    protected $database = "course_work";

    protected $link;

    protected $res;


    function search()
    {
        if (isset($_POST['searchGo'])){
        if ($_REQUEST['search']=='') {
        }else{
            $inputSearch = $_REQUEST['search'];
            $link = mysqli_connect($this->servername,
                $this->username,
                $this->password,
                $this->database)
            or die ("Ошибка: " . mysqli_error($this->link));


            $query = "select * from phonebook where name_='$inputSearch' || 
                                                 dateborn='$inputSearch' ||
                                                  operator='$inputSearch'||
                                                     phone='$inputSearch'||
                                                     city='$inputSearch' ||
                                                     adres='$inputSearch'||
                                                      email='$inputSearch'";
            $this->res = mysqli_query($link, $query) or die('ошибка запроса в бд' . mysqli_error($this->link));
            if ($this->res->num_rows > 0) {
                echo "<table>";
                while ($row = $this->res->fetch_assoc()) {
                    echo
                        "<td><div class=\"card\" style=\"width: 18rem;\">
    <div class=\"card-body\" >
    <p class=\"card-text\" id='infotext'>информация:   </p>
    <p class=\"card-text\"> имя фамилия:  " . $row['name_'] . "</p></p>
    <p class=\"card-text\"> дата рождения: " . $row['dateborn'] . "</p></p>
    
    <p class=\"card-text\"> Оператор: " . $row['operator'] . "</p></p>
    
    
    <p class=\"card-text\"> Город:  " . $row['city'] . "</p></p>
    
    <p class=\"card-text\"> Адрес проживания:  " . $row['adres'] . "</p></p>
   
    <p class=\"card-text\"> Номер телефона: " . $row['phone'] . "</p></p>
    <p class=\"card-text\"> Email " . $row['email'] . "</p></p>
  </div>
</div></td>";

                }
            } else {

                echo "<div class=\"alert alert-primary\" role=\"alert\">
  по предоставленным данным запись не найдена! Попробуйте снова 
</div>";
            }
        }



        }

    }

    function postinBase()
    {
        if ($_POST['addINFO']) {


            $link = mysqli_connect($this->servername,
                $this->username,
                $this->password,
                $this->database)
            or die ("Ошибка: " . mysqli_error($this->link));

            $name_ = $_REQUEST['name_'];
            $dateborn = $_REQUEST['dateborn'];
            $operator = $_REQUEST['operator'];
            $phone = $_REQUEST['phone'];
            $city = $_REQUEST['city'];
            $adres = $_REQUEST['adres'];
            $email = $_REQUEST['email'];

            $query = "insert into phonebook (name_,dateborn,operator,phone ,city,adres,email) value ($name_,$dateborn,$operator,$phone,$city,$adres,$email)";
            if (mysqli_query($link, $query)) {
                echo "<div class=\"alert alert-warning\" role=\"alert\">
                    запись добавлена
                       </div>";
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
     'ошибка: .mysqli_connect_error($this->link)'
</div>";

            }




        }
    }



    function textFromBase(){
        $this->link = mysqli_connect($this->servername,
            $this->username,
            $this->password,
            $this->database)
        or die ("Ошибка: " . mysqli_error($this->link));
        $query="select * from info";
        $result=mysqli_query($this->link,$query)or die("СЛОМАЛОСЬ НА ХУЙ код ошибки:    " ).mysqli_error($link);
        $via=$result->fetch_assoc();

        echo $via['infotxt'];




    }





}
?>