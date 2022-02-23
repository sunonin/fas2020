<?php

class FundSource extends Connection
{ 
    public $default_table = 'tbl_fundsource';
    public $default_table_entry = 'tbl_fundsource_entry';

    const EXPENSE_CLASSS_PS     = "ps";
    const EXPENSE_CLASSS_MOOE   = "mooe";
    const EXPENSE_CLASSS_FE     = "fe";
    const EXPENSE_CLASSS_CO     = "co";

    function __construct() {
        if (!isset($this->db)) {
            $conn = new mysqli($this->hostname, $this->dbUser, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Database is not connected: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

    public function fetch($id) {
        $sql = "SELECT * FROM $this->default_table WHERE id = $id";

        $getQry = $this->db->query($sql);
        $result = mysqli_fetch_array($getQry);
        
        return $result;
    }

    public function post($data) {
        $sql = "INSERT INTO $this->default_table 
                SET source = '".$data['source']."',
                name = '".$data['name']."',
                ppa = '".$data['ppa']."',
                legal_basis = '".$data['legal_basis']."',
                particulars = '".$data['particulars']."',
                total_allotment_amount = '".$data['total_allotment_amount']."',
                total_allotment_obligated = '".$data['total_allotment_obligated']."',
                total_balance = '".$data['total_balance']."',
                created_by = '".$data['created_by']."',
                date_created = NOW()";
        
        $this->db->query($sql);
        $last_id = mysqli_insert_id($this->db);

        return $last_id;
    }

    public function update($data, $id) {
        $sql = "UPDATE $this->default_table 
                SET source = '".$data['source']."',
                name = '".$data['name']."',
                ppa = '".$data['ppa']."',
                legal_basis = '".$data['legal_basis']."',
                particulars = '".$data['particulars']."',
                total_allotment_amount = '".$data['total_allotment_amount']."',
                total_allotment_obligated = '".$data['total_allotment_obligated']."',
                total_balance = '".$data['total_balance']."'
                WHERE id = $id"; 
        
        $this->db->query($sql);

        return $data; 
    }

    public function postEntry($data) {
        $sql = "INSERT INTO $this->default_table_entry 
                SET source_id = '".$data['source_id']."',
                is_lock = '".$data['is_lock']."',
                expense_class = '".$data['expense_class']."',
                uacs = '".$data['uacs']."',
                expense_group = '".$data['expense_group']."',
                allotment_amount = '".$data['allotment_amount']."',
                obligated_amount = '".$data['obligated_amount']."',
                balance = '".$data['balance']."'";

        $this->db->query($sql);
        
        return $data;
    }

    public function updateEntryStatus($id, $val) {
        $sql = "UPDATE $this->default_table_entry 
                SET is_lock = '".$val."'
                WHERE id = $id";

        $this->db->query($sql);
        
        return $id;
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->default_table WHERE id = $id";
        $this->db->query($sql);
        
        return $id;
    }

    public function clearEntry($id) {
        $sql = "DELETE FROM $this->default_table_entry WHERE source_id = $id";
        $this->db->query($sql);
        
        return $id;
    }

    public function removeUnusedEntry($id) {
        $sql = "DELETE
                FROM
                    tbl_fundsource_entry
                WHERE
                    id IN(
                    SELECT
                        fse.id
                    FROM
                        tbl_fundsource_entry fse
                    LEFT JOIN tbl_obentries oe ON
                        oe.uacs = fse.id
                    WHERE
                        fse.source_id = $id AND oe.id IS NULL AND fse.is_lock = false
                    GROUP BY
                        fse.id
                )";

        $this->db->query($sql);
        
        return $id;
    }

    public function markAsDeleted($id) {
        $sql = "UPDATE $this->default_table SET status = 'Deleted' WHERE id = $id";
    
        $this->db->query($sql);
        
        return $id;
    }

    public function updateUacs($id, $new_balance, $new_obligated) {
        $sql = "UPDATE $this->default_table_entry 
                SET balance = $new_balance, 
                obligated_amount = $new_obligated 
                WHERE id = $id";
        
        $this->db->query($sql);
        
        return $id;
    }

    public function setLock($id) {
        $sql = "UPDATE $this->default_table SET is_lock = true WHERE id = $id";

        $this->db->query($sql);

        return $id;
    }

    public function setUnlock($id) {
        $sql = "UPDATE $this->default_table SET is_lock = false WHERE id = $id";

        $this->db->query($sql);

        return $id;
    }

}