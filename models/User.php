<?php
class User extends DB
{
    public $table_group;

    public $id_user;
    public $username;
    public $password;
    public $email;
    public $fristname;
    public $lastname;
    public $phone;
    public $gender;


    public function __construct($id_user = null, $username = null, $password  = null, $email = null, $fristname = null, $lastname = null, $phone = null, $gender = null, $id_group = null, $group_name = null, $permission = null)
    {
        $this->id_user = $id_user;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->fristname = $fristname;
        $this->lastname = $lastname;
        $this->phone = $phone;
        $this->gender = $gender;

        self::$getDB =  $this->connect();
        MyFunction::loadModule("models.Group");
        $this->table_group = new Group($id_group, $group_name, $permission);
    }

    public function selectAllData()
    {

        $list = array();
        $result = User::$getDB->query("SELECT *  FROM users,groups where users.group = groups.id");
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    array_push($list, new self($row["id_user"], $row['username'], null, $row['email'], $row['firstname'], $row['lastname'], $row['phone'], $row['gender'], $row['group'], $row['group_name']));
                }
                return $list;
            }
            return $list;
        }
    }
    public function selectEmailUser($email)
    {
        $list = array();
        $result = self::$getDB->query('SELECT * FROM `users` , `groups` WHERE `email` = "' . $email . '" and users.group = groups.id');
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if (password_verify($password, $row['password'])) {
                        array_push($list, new self($row["id_user"], $row['username'], null, $row['email'], $row['firstname'], $row['lastname'], $row['phone'], $row['gender'], $row['group'], $row['group_name']));
                        return $list;
                    }
                }
            }
            return $list;
        }
        return $list;
    }
    public function selectId($email, $password)
    {
        $list = array();
        $result = self::$getDB->query('SELECT * FROM `users` , `groups` WHERE `email` = "' . $email . '" and users.group = groups.id');
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if (password_verify($password, $row['password'])) {
                        array_push($list, new self($row["id_user"], $row['username'], null, $row['email'], $row['firstname'], $row['lastname'], $row['phone'], $row['gender'], $row['group'], $row['group_name']));
                        return $list;
                    }
                }
            }
            return $list;
        }
        return $list;
    }
    public function delete($id)
    {
        $result = self::$getDB->query("DELETE FROM users WHERE `id_user` = '$id'");
        if ($result) {
            if (mysqli_affected_rows(self::$getDB) > 0) {
                return true;
            }
        }
        return false;
    }
    public function edit($id)
    {
        $list = array();

        $result = self::$getDB->query("SELECT * FROM users, groups WHERE id_user = '$id' and users.group = groups.id");
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    array_push($list, new self($row["id_user"], $row['username'], null, $row['email'], $row['firstname'], $row['lastname'], $row['phone'], $row['gender'], $row['group'], $row['group_name']));
                }
                return $list;
            }
            return $list;
        }
    }
    public function getUserGroup($id)
    {
        $list = array();

        $result = self::$getDB->query("SELECT * FROM users, groups WHERE id_user = '$id' and users.group = groups.id");
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    array_push($list, new self($row["id_user"], $row['username'], null, $row['email'], $row['firstname'], $row['lastname'], $row['phone'], $row['gender'], $row['group'], $row['group_name']));
                }
                return $list;
            }
            return $list;
        }
    }
    public function insert($id_user, $username, $password, $email, $fname, $lname, $phone, $gender, $store_id, $groups)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $result = self::$getDB->query("INSERT INTO `users` (`id`, `id_user`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`, `store_id`, `group`) VALUES (NULL, '$id_user', '$username', '$password', '$email', '$fname', '$lname', '$phone', '$gender', '$store_id', '$groups')");
        if ($result) {
            if (mysqli_affected_rows(self::$getDB) > 0) {
                return true;
            }
        }
        return false;
    }
    public function getPermission($permission)
    {

        $result = self::$getDB->query('SELECT * FROM groups where id = ' . $permission . '');
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $permission = json_decode($row['permission'], true);
                    if (!isset($permission[$GLOBALS['TYPE']][$GLOBALS['CONTROLLER']][$GLOBALS['ACTION']]['isLogin'])) {

                        return $permission;
                    }
                    if (isset($permission[$GLOBALS['TYPE']][$GLOBALS['CONTROLLER']][$GLOBALS['ACTION']]['isLogin']) and $permission[$GLOBALS['TYPE']][$GLOBALS['CONTROLLER']][$GLOBALS['ACTION']]['isLogin']) {

                        return $permission;
                    }
                    return false;
                }
            }
            return false;
        }
        return false;
    }

    public function count()
    {
        $count = 0;
        $result = self::$getDB->query("SELECT COUNT(*) as `count` FROM `users`");
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $count = $row['count'];
            }
            return $count;
        }
        return $count;
    }

    public function update($id_user, $username, $password, $email, $fname, $lname, $phone, $gender, $store_id, $groups)
    {
        if (!$password)
            $result = self::$getDB->query("UPDATE `users` SET  `id_user` = '$id_user', `username` = '$username', `email` = '$email', `firstname` = '$fname', `lastname` = '$lname', `phone` = '$phone', `gender` = '$gender', `store_id` = '$store_id', `group` = '$groups' WHERE `users`.`id_user` = '$id_user';");
        else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $result = self::$getDB->query("UPDATE `users` SET  `id_user` = '$id_user', `username` = '$username', `password` = '$hashed_password' , `email` = '$email', `firstname` = '$fname', `lastname` = '$lname', `phone` = '$phone', `gender` = '$gender', `store_id` = '$store_id', `group` = '$groups' WHERE `users`.`id_user` = '$id_user';");
        }
        if ($result) {
            if (mysqli_affected_rows(self::$getDB) >= 0) {
                return true;
            }
        }
        return false;
    }
    public function settingUser($id_user, $username, $password, $email, $fristname, $lastname, $gender, $phone)
    {
        if (!$password)
            $result = self::$getDB->query("UPDATE `users` SET  `id_user` = '$id_user', `username` = '$username', `email` = '$email', `firstname` = '$fristname', `lastname` = '$lastname', `phone` = '$phone', `gender` = '$gender' WHERE `users`.`id_user` = '$id_user';");
        else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $result = self::$getDB->query("UPDATE `users` SET  `id_user` = '$id_user', `username` = '$username', `password` = '$hashed_password' , `email` = '$email', `firstname` = '$fristname', `lastname` = '$lastname', `phone` = '$phone', `gender` = '$gender' WHERE `users`.`id_user` = '$id_user';");
        }
        if(!self::$getDB->error)
        {
            if(mysqli_affected_rows(self::$getDB) >= 0){
                return true;
            }
        }
        echo self::$getDB->error;
        return false;
    }
}
