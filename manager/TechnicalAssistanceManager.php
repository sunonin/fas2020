<?php

class TechnicalAssistanceManager
{
    public $conn = '';


    function __construct()
    {
        $this->conn = mysqli_connect("localhost", "fascalab_2020", "w]zYV6X9{*BN", "fascalab_2020");
    }
    public function getReqType()
    {
        $sql = "SELECT * FROM `tbl_ta_typerequest`";

        $query = mysqli_query($this->conn, $sql);
        $data[] = '';
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = [
                'id' => $row['ID'],
                'title' => $row['TITLE']
            ];
        }
        return $data;
    }

    public function fetchdata()
    {
        $sql = "SELECT ur.REQ_ID as enable,tr.ID AS id, ur.ID AS tr_id ,tr.title as title, ur.TITLE as request_type, ur.REQUEST_ID as req_id, ur.class as req_class 
        FROM `tbl_ta_typerequest` tr 
        LEFT JOIN tbl_ta_subrequest ur on tr.ID = ur.REQUEST_ID
         ";

        $query = mysqli_query($this->conn, $sql);
        $data[] = '';
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['enable'] != '') {
                $id = $row['enable'];
            } else {
                $id = ' ';
            }
            $data[] = [
                'id' => $row['id'],
                'request_id' => $row['tr_id'],
                'title' => $row['title'],
                'request_type' => $row['request_type'],
                'req_id' => $row['req_id'],
                'req_class' => $row['req_class'],
                'enable' => $id
            ];
        }
        return $data;
    }

    public function viewRequest($cn)
    {
        $sql = "SELECT `ID`, `CONTROL_NO`, `REQ_DATE`, `REQ_TIME`, `REQ_BY`, `OFFICE`, `POSITION`, 
        `CONTACT_NO`, `EMAIL_ADD`, `EQUIPMENT_TYPE`, `BRAND_MODEL`, `PROPERTY_NO`, `SERIAL_NO`, 
        `IP_ADDRESS`, `MAC_ADDRESS`, `TYPE_REQ`, `TYPE_REQ_DESC`, `TEXT1`, `TEXT2`, `TEXT3`, `TEXT4`,
         `TEXT9`, `TEXT5`, `TEXT6`, `TEXT7`, `TEXT8`, `ISSUE_PROBLEM`, `ASSIGN_DATE`, `START_DATE`, `START_TIME`, `STATUS_DESC`, `COMPLETED_DATE`, `COMPLETED_TIME`, `DATE_RATED`, `ASSIST_BY`, `PERSON_ASSISTED`, `TIMELINESS`, `QUALITY`, `STATUS`, `STATUS_REQUEST`
                FROM `tbltechnical_assistance` WHERE `CONTROL_NO` = '$cn'";

        $query = mysqli_query($this->conn, $sql);
        $data[] = '';
        while ($row = mysqli_fetch_assoc($query)) {
            $request_date = date('M d, Y', strtotime($row['REQ_DATE']));
            $request_time = date('g:i A', strtotime($row['REQ_TIME']));

            if ($row['START_DATE'] == '' || $row['START_DATE'] == null) {
                $started_date = '';
            } else {
                $started_date = date('M d, Y', strtotime($row['START_DATE']));
            }
            if ($row['START_TIME'] == '' || $row['START_TIME'] == null) {
                $started_time = '';
            } else {
                $started_time = date('g:i A', strtotime($row['START_TIME']));
            }
            if ($row['COMPLETED_DATE'] == '' || $row['COMPLETED_DATE'] == null) {
                $completed_date = '';
            } else {
                $completed_date = date('M d, Y', strtotime($row['COMPLETED_DATE']));
            }
            if ($row['COMPLETED_TIME'] == '' || $row['COMPLETED_TIME'] == null) {
                $completed_time = '';
            } else {
                $completed_time = date('g:i A', strtotime($row['COMPLETED_TIME']));
            }

            $data[] = [
                'id' => $row['ID'],
                'control_no' => $row['CONTROL_NO'],
                'request_date' => $request_date,
                'request_time' => $request_time,
                'started_date' => $started_date,
                'started_time' => $started_time,
                'completed_date' => $completed_date,
                'completed_time' => $completed_time,
                'request_by' => ucwords(strtolower($row['REQ_BY'])),
                'office' => $row['OFFICE'],
                'position' => $row['POSITION'],
                'contact_details' => $row['CONTACT_NO'],
                'email_address' => $row['EMAIL_ADD'],
                'type_of_request' => $row['TYPE_REQ'],
                'subtype_request' => $row['TYPE_REQ_DESC'],
                'txt1' => $row['TEXT1'],
                'txt2' => $row['TEXT2'],
                'txt3' => $row['TEXT3'],
                'txt4' => $row['TEXT4'],
                'txt5' => $row['TEXT5'],
                'txt6' => $row['TEXT6'],
                'txt7' => $row['TEXT7'],

                'issue' => $row['ISSUE_PROBLEM'],
                'status_desc' => $row['STATUS_DESC'],
                'timeliness' => $row['TIMELINESS'],
                'quality' => $row['QUALITY'],
                'assisted_by' => ucwords(strtolower($row['ASSIST_BY'])),
                'equipment_type' => $row['EQUIPMENT_TYPE'],
                'brand_model' => $row['BRAND_MODEL'],
                'property_no' => $row['PROPERTY_NO'],
                'serial_no' => $row['SERIAL_NO'],
                'ip_address' => $row['IP_ADDRESS'],
                'mac_address' => $row['MAC_ADDRESS'],
                'status' => $row['STATUS'],
                'ict_comments' => $row['STATUS_DESC'],
                'status_request' => $row['STATUS_REQUEST'],
            ];
        }
        return $data;
    }
    public function getSubRequest()
    {
        $sql = "SELECT ID,`TITLE` FROM `tbl_ta_subrequest` WHERE CLASS != ''";

        $query = mysqli_query($this->conn, $sql);
        $data[] = '';
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = [
                'type' =>  $row['TITLE'] . ","
            ];
        }
        return $data;
    }

    // RATE SERVICE
    public function showRateForm($control_no)
    {
        $sql = "SELECT ur.REQ_ID as enable,tr.ID AS id, ur.ID AS tr_id ,tr.title as title, ur.TITLE as request_type, ur.REQUEST_ID as req_id, ur.class as req_class 
        FROM `tbl_ta_typerequest` tr 
        LEFT JOIN tbl_ta_subrequest ur on tr.ID = ur.REQUEST_ID
        LEFT JOIN tbltechnical_assistance as ta on tr.TITLE = ta.TYPE_REQ
        where ta.CONTROL_NO = '$control_no'";

        $query = mysqli_query($this->conn, $sql);
        $data[] = '';
        if ($row = mysqli_fetch_assoc($query)) {
            if ($row['enable'] != '') {
                $id = $row['enable'];
            } else {
                $id = ' ';
            }
          
          
            $data[] = [
                'id' => $row['id'],
                'request_id' => $row['tr_id'],
                'title' => $row['title'],
                'request_type' => $row['request_type'],
                'req_id' => $row['req_id'],
                'req_class' => $row['req_class'],
                'enable' => $id,
                'is_check' => 'checked',
            ];
        }
        return $data;
    }
}
