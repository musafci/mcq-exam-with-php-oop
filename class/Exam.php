<?php

class Exam {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addQuestions($data) {
        $quesNo = mysqli_real_escape_string($this->db->link, $data['quesNo']);
        $ques = mysqli_real_escape_string($this->db->link, $data['ques']);
        $ans = array();
        $ans[1] = mysqli_real_escape_string($this->db->link, $data['ans1']);
        $ans[2] = mysqli_real_escape_string($this->db->link, $data['ans2']);
        $ans[3] = mysqli_real_escape_string($this->db->link, $data['ans3']);
        $ans[4] = mysqli_real_escape_string($this->db->link, $data['ans4']);
        $rightAns = mysqli_real_escape_string($this->db->link, $data['rightAns']);

        $query = "INSERT INTO tbl_ques (quesNo,ques)VALUES('$quesNo','$ques')";
        $insert_row = $this->db->insert($query);
        if ($insert_row) {
            foreach ($ans as $key => $ansName) {
                if ($ansName != '') {
                    if ($rightAns == $key) {
                        $rquery = "INSERT INTO tbl_ans (quesNo,rightAns,ans)VALUES('$quesNo','1','$ansName')";
                    } else {
                        $rquery = "INSERT INTO tbl_ans (quesNo,rightAns,ans)VALUES('$quesNo','0','$ansName')";
                    }
                    $insertrow = $this->db->insert($rquery);
                    if ($insertrow) {
                        continue;
                    } else {
                        die('Error....');
                    }
                }
            }

            $msg = "<span class='success'>Question Added Successfully...</span>";
            return $msg;
        }
    }

    public function getQueByOrder() {
        $query = "SELECT * FROM tbl_ques ORDER BY quesNo ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delQuestion($queid) {
        $tables = array("tbl_ques", "tbl_ans");
        foreach ($tables as $value) {
            $query = "DELETE FROM $value WHERE quesNo = '$queid'";
            $result = $this->db->delete($query);
        }
        if ($result) {
            $msg = "<span class='success'>Question Delete Successfully.....!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Fail to  Question Delete.....!</span>";
            return $msg;
        }
    }

    public function getTotalQuestion() {
        $query = "SELECT * FROM tbl_ques";
        $getResult = $this->db->select($query);
        $result = $getResult->num_rows;
        return $result;
    }

    public function getQuestion() {
        $query = "SELECT * FROM tbl_ques";
        $getData = $this->db->select($query);
        $result = $getData->fetch_assoc();
        return $result;
    }

    public function getQuesByNumber($qnumber) {
        $query = "SELECT * FROM tbl_ques WHERE quesNo = '$qnumber'";
        $getData = $this->db->select($query);
        $result = $getData->fetch_assoc();
        return $result;
    }

    public function getAnswer($qnumber) {
        $query = "SELECT * FROM tbl_ans WHERE quesNo = '$qnumber'";
        $getData = $this->db->select($query);
        return $getData;
    }

}
