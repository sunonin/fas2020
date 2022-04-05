<?php
class GSSManager  extends Connection
{
    public $conn = '';
    public $default_table = 'app';
    public $default_year = '2022';





    function __construct()
    {
        if (!isset($this->db)) {
            $conn = new mysqli($this->hostname, $this->dbUser, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Database is not connected: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

    public function getPMO()
    {
        $sql = "SELECT id, pmo_title from pmo";
        $query = $this->db->query($sql);
        $data = [];
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $office = $row['pmo_title'];

            $data[] = [
                'id' => $row['id'],
                'office' => $office,
                'pmo_contact_person' => $row['pmo_contact_person'],
                'position' => $row['position'],
            ];
        }
        return $data;
    }
    public function fetch()
    {
        $sql = "SELECT 
        app.sn as sn,
        app.code as code,
        mop.mode_of_proc_title as mode
        FROM $this->default_table  
        LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id 
        WHERE app_year = $this->default_year";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[] = [
                'stock_no'  => $row['sn'],
                'code'      => $row['code'],
                'mode'      => $row['mode']
            ];
        }
        return $data;
    }
    public function fetchAPP($admins)
    {
        if (in_array($_SESSION['username'], $admins)) {
            $sql = "SELECT  app.id,app.app_price,app.app_year,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,app.pmo_id,sof.source_of_funds_title 
            FROM $this->default_table  
            LEFT JOIN item_category ic on ic.id = app.category_id 
            LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
            LEFT JOIN pmo on pmo.id = app.pmo_id 
            LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id 
            where app_year in (2022)";
        } else {
            $sql = "SELECT DISTINCT app.id,app.app_price,app.app_year,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,app.pmo_id,sof.source_of_funds_title 
            FROM $this->default_table  
            LEFT JOIN item_category ic on ic.id = app.category_id 
            LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
            LEFT JOIN pmo on pmo.id = app.pmo_id 
            LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id 
            where app_year in ($this->default_year)
            ORDER BY app.app_year desc";
        }

        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $office = $row['pmo_id'];
            $fad = ['10', '11', '12', '13', '14', '15', '16'];
            $ord = ['1', '2', '3', '5'];
            $lgmed = ['7', '18', '7',];
            $lgcdd = ['8', '9', '17', '9'];
            $cavite = ['20', '34', '35', '36', '45'];
            $laguna = ['21', '40', '41', '42', '47', '51', '52'];
            $batangas = ['19', '28', '29', '30', '44'];
            $rizal = ['23', '37', '38', '39', '46', '50'];
            $quezon = ['22', '31', '32', '33', '48', '49', '53'];
            $lucena_city = ['24'];
            if (in_array($office, $fad)) {
                $office = 'FAD';
            } else if (in_array($office, $lgmed)) {
                $office = 'LGMED';
            } else if (in_array($office, $lgcdd)) {
                $office = 'LGCDD';
            } else if (in_array($office, $cavite)) {
                $office = 'CAVITE';
            } else if (in_array($office, $laguna)) {
                $office = 'LAGUNA';
            } else if (in_array($office, $batangas)) {
                $office = 'BATANGAS';
            } else if (in_array($office, $rizal)) {
                $office = 'RIZAL';
            } else if (in_array($office, $quezon)) {
                $office = 'QUEZON';
            } else if (in_array($office, $lucena_city)) {
                $office = 'LUCENA CITY';
            } else if (in_array($office, $ord)) {
                $office = 'ORD';
            }

            $data[] = [
                'id'  => $row['id'],
                'sn'  => $row['sn'],
                'code'      => $row['code'],
                'year'      => $row['app_year'],
                'code'      => $row['mode'],
                'category'      => $row['item_category_title'],
                'procurement'      => $row['procurement'],
                'pmo_title'      => $office,
                'mode'      => $row['mode_of_proc_title'],
                'source'      => $row['source_of_funds_title'],
                'app_price' => $row['app_price']
            ];
        }
        return $data;
    }


    public function setCategory()
    {
        $sql = "SELECT 
        app.category_id as id,
        ic.item_category_title as category
        FROM $this->default_table  
        LEFT JOIN item_category ic on ic.id = app.category_id 
        GROUP BY category
        ORDER BY id
        ";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[] = [
                'id' => $row['id'],
                'category' => $row['category']
            ];
        }

        return $data;
    }


    public function setAppPMO()
    {
        $sql = "SELECT DIVISION_N, DIVISION_M FROM tblpersonneldivision where DIVISION_M in ('FAD','LGMED','LGCDD','ORD','CAVITE','LAGUNA','BATANGAS','RIZAL','QUEZON', 'LUCENA CITY')";

        $getQry = $this->db->query($sql);
        $data = [];


        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[$row['DIVISION_N']] = $row['DIVISION_M'];
        }


        return $data;
    }
    public function setPMO()
    {
        $sql = "SELECT DIVISION_N, DIVISION_M FROM tblpersonneldivision where DIVISION_M in ('FAD','LGMED','LGCDD','ORD','CAVITE','LAGUNA','BATANGAS','RIZAL','QUEZON', 'LUCENA CITY')";

        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[] = [
                'id' => $row['DIVISION_N'],
                'office' => $row['DIVISION_M']
            ];
        }

        return $data;
    }
    public function setPages()
    {
        $pages = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        return $pages;
    }
    public function setSFund()
    {
        $fund =
            [
                'Regular, Local and Trust Fund',
                'Local Fund',
                'Regular Fund'
            ];
        return $fund;
    }

    public function getAppItemUnit()
    {
        $sql = "SELECT id, item_unit_title from item_unit";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[$row['id']] = $row['item_unit_title'];
        }
        return $data;
    }
    public function getItemUnit()
    {
        $sql = "SELECT id, item_unit_title from item_unit";

        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[] = [
                'id' => $row['id'],
                'unit' => $row['item_unit_title']
            ];
        }

        return $data;
    }
    public function getSF()
    {
        $sql = "SELECT id, source_of_funds_title from source_of_funds";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[$row['id']] = $row['source_of_funds_title'];
        }
        return $data;
    }
    public function getMode()
    {
        $sql = "SELECT id,mode_of_proc_title from mode_of_proc";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[$row['id']] = $row['mode_of_proc_title'];
        }
        return $data;
    }
    public function getAPPItemList($default_year)
    {
        $sql = "SELECT id,price,sn,price,procurement,unit_id,app_year from app where app_year = $default_year";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[$row['id']] = $row['procurement'];
        }



        return $data;
    }

    // public function getApp($default_year)
    // {
    //     $sql = "SELECT id,price,sn,price,procurement,unit_id,app_year from app where app_year = '$default_year'";
    //     echo $sql;
    //     $getQry = $this->db->query($sql);
    //     $data = [];
    //     while ($row = mysqli_fetch_assoc($getQry)) {
    //         $data[] = 
    //         [
    //             'id' => $row['id'],
    //             'a' => $row['procurement']
    //         ];
    //     }



    //     return $data;
    // }
    public function getApp()
    {
        $sql = "SELECT id,price,sn,price,procurement,unit_id,app_year from app where app_year = '2022'";
        $query = $this->db->query($sql);
        $data = [];
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {

            $data[] = [
                'id' => $row['id'],
                'item' => $row['procurement'],
            ];
        }
        return $data;
    }


    public function fetchPRID($pr_no)
    {
        $sql = "SELECT
            pr.`id` as 'pr_id'
        FROM
        `pr`
        WHERE pr_no  ='$pr_no'";

        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data = [
                'id'       => $row['pr_id'],
            ];
        }
        return $data;
    }
    public function fetchFund($pmo)
    {
        $cavite = ['20', '34', '35', '36', '45'];
        $laguna = ['21', '40', '41', '42', '47', '51', '52'];
        $batangas = ['19', '28', '29', '30', '44'];
        $rizal = ['23', '37', '38', '39', '46', '50'];
        $quezon = ['22', '31', '32', '33', '48', '49', '53'];
        $lucena_city = ['24'];
      
        if (in_array($pmo, $cavite)) {
            $pmo = '1';
        }else if (in_array($pmo, $laguna)) {
            $pmo = '2';

        }else if (in_array($pmo, $batangas)) {
            $pmo = '3';

        }else if (in_array($pmo, $rizal)) {
            $pmo = '4';

        }else if (in_array($pmo, $quezon)) {
            $pmo = '5';

        }else if (in_array($pmo, $lucena_city)) {
            $pmo = '6';

        }
       
        $sql = "SELECT
            `id`,
            `status`,
            `remarks`,
            `lddap`,
            `disbursed_amount`,
            `balance`,
            `fundsource_amount`,
            `province`
        FROM
            `tbl_payment`
        where province = '$pmo'";
        $getQry = $this->db->query($sql);
        $data = [];
        $amount = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[$row['id']] = [
                'status'       => $row['status'],
                'lddap'       => $row['lddap'],
                'fundsource_amount'       => $row['fundsource_amount'],
            ];
         
        }
        return $data;
    }
    public function setStockNo()
    {
        $sql = "SELECT max(id)+1 as sn FROM app order by id desc limit 1";
        $getQry = $this->db->query($sql);
        $data = '';
        if ($row = mysqli_fetch_assoc($getQry)) {
            $data =  $row['sn'];
        }
        return $data;
    }
    public function viewAPPInfo($id)
    {
        $sql = "SELECT DISTINCT
                app.id,
                app.app_price,
                app.app_year,
                app.sn,
                app.code,
                app.qty,
                app.source_of_funds_id as sfid,
                app.mode_of_proc_id as mode_id,
                app.category_id as cat_id,
                ic.item_category_title,
                app.procurement,
                mop.mode_of_proc_title,
                app.pmo_id,
                app.unit_id,
                sof.source_of_funds_title
            FROM
                $this->default_table
            LEFT JOIN item_category ic ON
                ic.id = app.category_id
            LEFT JOIN source_of_funds sof ON
                sof.id = app.source_of_funds_id
            LEFT JOIN pmo ON 
                pmo.id = app.pmo_id
            LEFT JOIN mode_of_proc mop ON
                 mop.id = app.mode_of_proc_id 
          
          WHERE app.id = '$id'";
        $query = $this->db->query($sql);
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $office = $row['pmo_id'];
            $fad = ['10', '11', '12', '13', '14', '15', '16'];
            $ord = ['1', '2', '3', '5'];
            $lgmed = ['7', '18', '7',];
            $lgcdd = ['8', '9', '17', '9'];
            $cavite = ['20', '34', '35', '36', '45'];
            $laguna = ['21', '40', '41', '42', '47', '51', '52'];
            $batangas = ['19', '28', '29', '30', '44'];
            $rizal = ['23', '37', '38', '39', '46', '50'];
            $quezon = ['22', '31', '32', '33', '48', '49', '53'];
            $lucena_city = ['24'];
            if (in_array($office, $fad)) {
                $office = 'FAD';
            } else if (in_array($office, $lgmed)) {
                $office = 'LGMED';
            } else if (in_array($office, $lgcdd)) {
                $office = 'LGCDD';
            } else if (in_array($office, $cavite)) {
                $office = 'CAVITE';
            } else if (in_array($office, $laguna)) {
                $office = 'LAGUNA';
            } else if (in_array($office, $batangas)) {
                $office = 'BATANGAS';
            } else if (in_array($office, $rizal)) {
                $office = 'RIZAL';
            } else if (in_array($office, $quezon)) {
                $office = 'QUEZON';
            } else if (in_array($office, $lucena_city)) {
                $office = 'LUCENA CITY';
            } else if (in_array($office, $ord)) {
                $office = 'ORD';
            }
            $data = [
                'sn' => $row['sn'],
                'code' => $row['code'],
                'title' => $row['procurement'],
                'unit' => $row['unit_id'],
                'fund_source' => $row['sfid'],
                'category' => $row['cat_id'],
                'office' => $office,
                'quantity' => $row['qty'],
                'app_price' => $row['app_price'],
                'mode' => $row['mode_id'],
            ];
        }
        return $data;
    }



    // pr

    public function fetchPRStatusCount($status = ['3', '4', '5', '7', '9'])
    {
        $conn = mysqli_connect("localhost", "fascalab_2020", "w]zYV6X9{*BN", "fascalab_2020");
        $options = [];
        foreach ($status as $stat) {
            $sql = "SELECT COUNT(*) as count FROM pr where stat = '" . $stat . "' and YEAR(pr_date) = '2022'";
            $query = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($query);
            $options[$stat] = $row['count'];
        }

        return $options;
    }

    public function fetchPRInfo()
    {

        $sql = "SELECT 
        pr.id as id,
        pr.pr_no as 'pr_no',
        pr.pmo as pmo,
        pr.canceled as 'canceled',
        pr.received_by as 'received_by',
        pr.submitted_by as 'submitted_by',
        pr.submitted_date as 'submitted_date',
        pr.submitted_date_gss as 'submitted_date_gss',
        pr.submitted_by_gss as 'submitted_by_gss',
        pr.received_date as 'received_date',
        pr.purpose as 'purpose',
        pr.pr_date as 'pr_date',
        pt.type as 'type',
        pr.target_date as 'target_date',    
        pr.submitted_date_budget as 'submitted_date_budget',
        pr.budget_availability_status as 'budget_availability_status',
        pr.availability_code as 'availability_code',
        ps.REMARKS as 'status',
        pr.stat as 'stat',
        pr.remarks,
        emp.UNAME as 'username',
        SUM(abc * qty) as 'total',
        is_urgent as 'urgent'
        FROM pr as pr
        LEFT JOIN pr_items items ON items.pr_no = pr.pr_no 
        LEFT JOIN tbl_pr_status as ps on ps.id = pr.stat
        LEFT JOIN tblemployeeinfo emp ON pr.received_by = emp.EMP_N
        LEFT JOIN tbl_pr_type pt on pt.id = pr.type
        where YEAR(date_added) = '2022'  and pr.pr_no != ''
        GROUP BY items.pr_no
        order by pr.id desc";

        $query = $this->db->query($sql);
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $id = $row["id"];
            $pr_no = $row["pr_no"];
            $pmo = $row["pmo"];
            $canceled = $row["canceled"];
            $received_by1 = $row["received_by"];
            $submitted_by1 = $row["submitted_by"];
            $submitted_date = $row["submitted_date"];
            $received_date = $row["received_date"];
            $received_date1 = date('F d, Y', strtotime($received_date));
            $purpose = $row["purpose"];
            $pr_date = $row["pr_date"];
            $pr_date1 = date('F d, Y', strtotime($pr_date));
            $type = $row["type"];
            $target_date = $row["target_date"];
            $target_date11 = date('F d, Y', strtotime($target_date));
            $submitted_date_budget = $row['submitted_date_budget'];
            $budget_availability_status = $row['budget_availability_status'];
            $office = $row['pmo'];




            $fad = ['10', '11', '12', '13', '14', '15', '16'];
            $ord = ['1', '2', '3', '5'];
            $lgmed = ['7', '18', '7',];
            $lgcdd = ['8', '9', '17', '9'];
            $cavite = ['20', '34', '35', '36', '45'];
            $laguna = ['21', '40', '41', '42', '47', '51', '52'];
            $batangas = ['19', '28', '29', '30', '44'];
            $rizal = ['23', '37', '38', '39', '46', '50'];
            $quezon = ['22', '31', '32', '33', '48', '49', '53'];
            $lucena_city = ['24'];
            if (in_array($office, $fad)) {
                $office = 'FAD';
            } else if (in_array($office, $lgmed)) {
                $office = 'LGMED';
            } else if (in_array($office, $lgcdd)) {
                $office = 'LGCDD';
            } else if (in_array($office, $cavite)) {
                $office = 'CAVITE';
            } else if (in_array($office, $laguna)) {
                $office = 'LAGUNA';
            } else if (in_array($office, $batangas)) {
                $office = 'BATANGAS';
            } else if (in_array($office, $rizal)) {
                $office = 'RIZAL';
            } else if (in_array($office, $quezon)) {
                $office = 'QUEZON';
            } else if (in_array($office, $lucena_city)) {
                $office = 'LUCENA CITY';
            } else if (in_array($office, $ord)) {
                $office = 'ORD';
            }

            if ($type == "1") {
                $type = "Catering Services";
            }
            if ($type == "2") {
                $type = "Meals, Venue and Accommodation";
            }
            if ($type == "3") {
                $type = "Repair and Maintenance";
            }
            if ($type == "4") {
                $type = "Supplies, Materials and Devices";
            }
            if ($type == "5") {
                $type = "Other Services";
            }
            if ($type == "6") {
                $type = "Reimbursement and Petty Cash";
            }
            if($submitted_date == ''){
                $submitted_date = $row['pr_date'];
            }

            if ($row['stat'] == 0) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 1) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 2) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 3) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 4) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 5) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 6) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 7) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 8) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 9) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 10) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 11) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 12) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small>
                </div>';
            }
            if ($row['stat'] == 16) {
                $stat = '
                <div class="kv-attribute">
                    <b><span id="showModal" class="badge" style="background-color: #AD1457;width:100%;padding:9px;">' . $row['status'] . '</span></b><br>
                    <input type="hidden" id="pr_no" value="' . $row['pr_no'] . '" />
                    <small>' . $submitted_by1 . '<br>' . date('F d, Y', strtotime($submitted_date)) . '</small><br>
                    REMARKS:'.$row['remarks'].'
                </div>';
            }
            $data[] = [
                'id' => $id,
                'pmo_id' => $row['pmo'],
                'pr_no' => $pr_no,
                'division' => $office,
                'type' => $type,
                'canceled' => $canceled,
                'received_by' => $row['username'],
                'submitted_by' => $submitted_by1,
                'submitted_date' => date('F d, Y', strtotime($row['pr_date'])),
                'received_date' => $received_date1,
                'purpose' =>  mb_strimwidth($purpose, 0, 15, "..."),
                'pr_date' => $pr_date1,
                'type' => $type,
                'target_date' => $target_date11,
                'submitted_date_to_budget' => $submitted_date_budget,
                'budget_availability_status' => $budget_availability_status,
                'office' => $office,
                'status' => $stat,
                'is_budget' => $row['submitted_date'],
                'is_gss' => $row['submitted_date_gss'],
                'total_abc' => '₱' . $row['total'],
                'urgent' => $row['urgent'],
                'stat'   => $row['stat'],
                'code'   => $row['availability_code'],
                'remarks' => $row['remarks']

            ];
        }
        return $data;
    }

    public function fetchPrNo($year)
    {
        $sql = "SELECT  count(*) as count_r FROM pr WHERE YEAR(pr_date) = '$year' order by id desc ";
        $query = $this->db->query($sql);
        $data = [];
        $current_month = date('m');
        while ($row = mysqli_fetch_assoc($query)) {
            $str = str_replace($year . "-" . $current_month . "-", "", $row['count_r']);
            if ($row['count_r'] == 1) {
                $idGet = (int)$str + 1;
                $pr_no = $year . '-' . $current_month . '-' . '00' . $idGet;
            } else if ($row['count_r'] <= 99) {
                $idGet = (int)$str + 1;

                $pr_no = $year . '-' . $current_month . '-' . '00' . $idGet;
            } else {
                $idGet = (int)$str + 1;

                $pr_no = $year . '-' . $current_month . '-' . '0' . $idGet;
            }
            $data = [
                'pr_no' => $pr_no,
                'id' => $row['count_r'] + 1
            ];
        }
        return $data;
    }
    public function fetchType()
    {
        $sql = "SELECT * from tbl_pr_type";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[$row['id']] = $row['type'];
        }
        return $data;
    }
    public function fetchFundSource()
    {
        $sql = "SELECT * FROM source_of_funds";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[$row['id']] = $row['source_of_funds_title'];
        }
        return $data;
    }
    public function view_pr($pr_no)
    {
        $sql = "SELECT
        pr.`id`,
        pr.`pr_no`,
        sf.`source_of_funds_title`,
        pr.`pmo`,
        pr.fund_source,
        `username`,
        pr.stat AS stat,
        pr.is_urgent,
        `purpose`,
        `canceled`,
        `canceled_date`,
        `type`,
        `pr_date`,
        `target_date`,
        `submitted_date`,
        `submitted_by`,
        `received_date`,
        `received_by`,
        `date_added`,
        ps.`REMARKS`,
        `sq`,
        `aoq`,
        `po`,
        `budget_availability_status`,
        `availability_code`,
        `date_certify`,
        `submitted_date_budget`,
        SUM(i.abc * i.qty) AS 'abc',
        emp.FIRST_M,
        emp.MIDDLE_M,
        emp.LAST_M
        FROM
            `pr`
        LEFT JOIN pr_items i ON
            pr.pr_no = i.pr_no
        LEFT JOIN tblemployeeinfo emp ON
            pr.received_by = emp.EMP_N
        LEFT JOIN tbl_pr_status AS ps
        ON
            pr.stat = ps.id
        LEFT JOIN tbl_pr_history AS ph
        ON
            pr.pr_no = ph.pr_no
        LEFT JOIN source_of_funds AS sf
        ON
            pr.fund_source = sf.id
        WHERE
            pr.pr_no = '$pr_no'";
        $query = $this->db->query($sql);
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {
            $office = $row['pmo'];
            $fad = ['10', '11', '12', '13', '14', '15', '16'];
            $ord = ['1', '2', '3', '5'];
            $lgmed = ['7', '18', '7',];
            $lgcdd = ['8', '9', '17', '9'];
            $cavite = ['20', '34', '35', '36', '45'];
            $laguna = ['21', '40', '41', '42', '47', '51', '52'];
            $batangas = ['19', '28', '29', '30', '44'];
            $rizal = ['23', '37', '38', '39', '46', '50'];
            $quezon = ['22', '31', '32', '33', '48', '49', '53'];
            $lucena_city = ['24'];
            $type = $row['type'];

            if (in_array($office, $fad)) {
                $office = 'FAD';
            } else if (in_array($office, $lgmed)) {
                $office = 'LGMED';
            } else if (in_array($office, $lgcdd)) {
                $office = 'LGCDD';
            } else if (in_array($office, $cavite)) {
                $office = 'CAVITE';
            } else if (in_array($office, $laguna)) {
                $office = 'LAGUNA';
            } else if (in_array($office, $batangas)) {
                $office = 'BATANGAS';
            } else if (in_array($office, $rizal)) {
                $office = 'RIZAL';
            } else if (in_array($office, $quezon)) {
                $office = 'QUEZON';
            } else if (in_array($office, $lucena_city)) {
                $office = 'LUCENA CITY';
            } else if (in_array($office, $ord)) {
                $office = 'ORD';
            }
            // TYPE
            if ($type == "1") {
                $type = "Catering Services";
            }
            if ($type == "2") {
                $type = "Meals, Venue and Accommodation";
            }
            if ($type == "3") {
                $type = "Repair and Maintenance";
            }
            if ($type == "4") {
                $type = "Supplies, Materials and Devices";
            }
            if ($type == "5") {
                $type = "Other Services";
            }
            if ($type == "6") {
                $type = "Reimbursement and Petty Cash";
            }
            if ($type == "7") {
                $type = "Public Bidding";
            }
            if ($type == "8") {
                $type = "Not Applicable N/A";
            }
            // STATUS

            $data = [
                'pr_no' => $row['pr_no'],
                'fund_source' => $row['source_of_funds_title'],
                'fs' => $row['fund_source'],
                'office' => $office,
                'pr_date' => date('F d, Y', strtotime($row['pr_date'])),
                'target_date' => date('F d, Y', strtotime($row['target_date'])),
                'type' => $type,
                'pr_type' => $row['type'],
                'purpose' => $row['purpose'],
                'unit' => $row['unit'],
                'qty' => $row['qty'],
                'abc' => $row['abc'],
                'received_by' => $row['FIRST_M'] . ' ' . $row['MIDDLE_M'] . ' ' . $row['LAST_M'],
                'status' => $row['REMARKS'],
                'stat' => $row['stat'],
                'is_urgent' => $row['is_urgent']
            ];
        }
        return $data;
    }
    public function view_pr_items($pr_no)
    {
        $sql = "SELECT 
            pi.id,
            item.item_unit_title, 
            pi.description, 
            app.procurement,
            app.app_price,
            pi.qty,
            pi.qty * app.app_price  as 'total_abc',
            pi.abc,
            app.sn as stock_number
            FROM pr_items pi 
            LEFT JOIN app on app.id = pi.items 
            LEFT JOIN item_unit item on item.id = pi.unit
            WHERE pr_no = '$pr_no'";
        $query = $this->db->query($sql);
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {

            $data[] = [
                'id' => $row['id'],
                'items' => $row['procurement'],
                'description' => $row['description'],
                'unit' => $row['item_unit_title'],
                'qty' => $row['qty'],
                'abc' => $row['abc'],
                'total' => $row['app_price'],
                'stock_number' => $row['stock_number']
            ];
        }
        return $data;
    }
    public function fetch_abc($pr_no)
    {
        $sql = "SELECT SUM(pr.qty * pr.abc) as total
        FROM pr_items pr 
        LEFT JOIN app on app.id = pr.items 
        LEFT JOIN item_unit item on item.id = pr.unit
     WHERE pr_no = '$pr_no'";
        $query = $this->db->query($sql);
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {

            $data = [
                'total' => $row['total']
            ];
        }
        return $data;
    }

    public function monitorPR($month = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])
    {
        $conn = mysqli_connect("localhost", "fascalab_2020", "w]zYV6X9{*BN", "fascalab_2020");
        $options = [];
        foreach ($month as $months) {
            $sql = "SELECT COUNT(*) as count FROM pr where MONTH(pr_date) = '" . $months . "' and YEAR(pr_date) = '2022'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($query);
            $options[$months] = $row['count'];
        }
        return $options;
    }
    public function countEncodePR()
    {
        $sql = "SELECT
                    p.pmo_title,
                    COUNT(*) as 'count',
                    f.total_funds
                    
                FROM
                    pr
                    LEFT join pmo as p on p.id = pr.pmo
                    LEFT JOIN funds as f on f.pmo_id = p.id
                    
                WHERE
                    YEAR(pr_date) = '2022'
                GROUP BY
                    pmo";
        $query = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = [
                'pmo_title' => $row['pmo_title'],
                'encoded' => $row['count'],
                'available_funds' => '₱' . number_format($row['total_funds'], 2),

            ];
        }
        return $data;
    }
    public function transparencyTable()
    {
        $sql = 'SELECT
        p.pmo_title,
        pr.pr_no,
        pr.pr_date,
        a.procurement,
        PI.qty,
        iu.item_unit_title as "unit",
        PI.abc,
        s.supplier_title,
        sq.ppu
    FROM
        `pr` AS pr
    LEFT JOIN pr_items PI ON  PI.pr_no = pr.pr_no
    LEFT JOIN app a ON  a.id = PI.items
    LEFT JOIN pmo p ON p.id = pr.pmo
    LEFT JOIN rfq r ON r.pr_no = pr.pr_no 
    LEFT JOIN rfq_items ri ON  r.id = r.id
    LEFT JOIN supplier_quote sq ON sq.rfq_item_id = a.id
    LEFT JOIN supplier s ON s.id = sq.supplier_id
    LEFT JOIN item_unit iu on iu.id = PI.unit
    WHERE
        YEAR(pr.pr_date) = 2022 AND sq.is_winner = 1
        GROUP BY pr.id
    ORDER BY
        p.pmo_title';
        $query = $this->db->query($sql);
        $data = [];

        while ($row = mysqli_fetch_assoc($query)) {

            $data[] = [
                'pmo_title' => $row['pmo_title'],
                'pr_no' => $row['pr_no'],
                'pr_date' => date('F d,Y', strtotime($row['pr_date'])),
                'procurement' => $row['procurement'],
                'qty' => $row['qty'],
                'unit' => $row['unit'],
                'abc' => $row['abc'],
                'supplier_title' => $row['supplier_title'],
                'ppu' => '₱' . number_format($row['ppu'], 2)
            ];
        }
        return $data;
    }
    public function fetchModeofProc()
    {
        $sql = "SELECT * from mode_of_proc ";
        $getQry = $this->db->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($getQry)) {
            $data[] = [
                'id' => $row['id'],
                'type' => $row['mode_of_proc_title']
            ];
        }
        return $data;
    }
}
