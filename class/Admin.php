<?php

$filepath = realpath(dirname(__FILE__));
//include_once ($filepath . '../lib/Database.php');
//include_once ($filepath . '../lib/Session.php');
//include_once ($filepath . '../helpers/Format.php');

include '../lib/Database.php';
//include '../lib/Session.php';
include '../helpers/Format.php';

class Admin {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getAdminData($data) {
        $adminUser = $this->fm->validation($data['adminUser']);
        $adminPass = $this->fm->validation($data['adminPass']);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {
            $loginmsg = "<span class='error'>Field Must Not Be Empty...!</span>";
            return $loginmsg;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
            $result = $this->db->select($query);
            if ($result != FALSE) {
                $value = $result->fetch_assoc();
                Session::set("adminLogin", TRUE);
                Session::set("adminId", $value['adminId']);
                Session::set("adminUser", $value['adminUser']);
                header('Location:index.php');
            } else {
                $loginmsg = "<span class='error'>Login Information Not Match.</span>";
                return $loginmsg;
            }
        }
    }

}
