<?php

class User {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function userRegistration($name, $username, $password, $email) {
        $name = $this->fm->validation($name);
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);
        $email = $this->fm->validation($email);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if ($name == '' || $username == '' || $password == '' || $email == '') {
            echo "<span class='error'>Field Must Not Be Empty....!</span>";
            exit();
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            echo "<span class='error'>Invalid Email Address.....</span>";
            exit();
        } else {
            $chkquery = "SELECT * FROM tbl_user WHERE email = '$email'";
            $chkresult = $this->db->select($chkquery);
            if ($chkresult != false) {
                echo "<span class='error'>Email Address Already Exist.....</span>";
                exit();
            } else {
                $query = "INSERT INTO tbl_user (name,username,password,email)VALUES('$name','$username','$password','$email')";
                $result = $this->db->insert($query);
                if ($result) {
                    echo "<span class='success'>User Registration Successfully..!</span>";
                    exit();
                } else {
                    echo "<span class='error'>Fail To User Registration..!</span>";
                    exit();
                }
            }
        }
    }

    public function userLogin($email, $password) {
        $email = $this->fm->validation($email);
        $password = $this->fm->validation($password);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if ($email == '' || $password == '') {
            echo "empty";
            exit();
        } else {
            $query = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";
            $result = $this->db->select($query);
            if ($result != FALSE) {
                $value = $result->fetch_assoc();
                if ($value['status'] == '1') {
                    echo "disable";
                    exit();
                } else {
                    Session::init();
                    Session::set("login", TRUE);
                    Session::set("userid", $value['userId']);
                    Session::set("name", $value['name']);
                    Session::set("username", $value['username']);
                }
            } else {
                echo "error";
                exit();
            }
        }
    }

    public function getUserData($userid) {
        $query = "SELECT * FROM tbl_user WHERE userId = '$userid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllUser() {
        $query = "SELECT * FROM tbl_user ORDER BY userId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateUserData($userid, $data) {
        $name = $this->fm->validation($data['name']);
        $username = $this->fm->validation($data['username']);
        $email = $this->fm->validation($data['email']);

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);

        $query = "UPDATE tbl_user SET name = '$name',username = '$username',email='$email' WHERE userId = '$userid'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>User Data Updated Successfully.....!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Fail to Update User Data.....!</span>";
            return $msg;
        }
    }

    public function disableUser($disid) {
        $query = "UPDATE tbl_user SET status = '1' WHERE userId = '$disid'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>User Disable Successfully.....!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Fail to  User Disable.....!</span>";
            return $msg;
        }
    }

    public function enableUser($enaid) {
        $query = "UPDATE tbl_user SET status = '0' WHERE userId = '$enaid'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class='success'>User Enable Successfully.....!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Fail to  User Enable.....!</span>";
            return $msg;
        }
    }

    public function deleteUser($delid) {
        $query = "DELETE FROM tbl_user WHERE userId = '$delid'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "<span class='success'>User Delete Successfully.....!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Fail to  User Delete.....!</span>";
            return $msg;
        }
    }

}
