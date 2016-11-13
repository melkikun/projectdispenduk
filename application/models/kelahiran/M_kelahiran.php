<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_kelahiran
 *
 * @author Melkikun
 */
class M_kelahiran extends CI_Model {

    //put your code here
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->db->conn_id;
    }

    public function cekreg($param) {
        $this->db->select("NOREG, NEGARAAYAH, NEGARAIBU, F_SURATKELAHIRAN, "
                . "F_AKTANIKAH, F_KK, F_KTPAYAH, "
                . "F_KTPIBU,F_KTPSAKSI1, F_KTPSAKSI2, "
                . "F_PASPOR, F_KITAP, F_BAP_POLISI, F_PERTANGGUNGANMUTLAK");
        $this->db->distinct();
        $this->db->from('REG_LAHIR');
        $this->db->where('NOREG', $param);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function uploadSingleImage($request) {
        $tmp_file = $request['tmp_file'];
        $no_reg = $this->db->escape($request['no_reg']);
        $type = $request['type'];
        $response = false;
        switch ($type) {
            case "kk":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_KK = EMPTY_BLOB() WHERE NOREG = $no_reg "
                        . "returning F_KK into :IMG";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }
                return $response;
                break;
            case "akta-nikah":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_AKTANIKAH = EMPTY_BLOB() WHERE NOREG = $no_reg "
                        . "returning F_AKTANIKAH into :IMG";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }
                return $response;
                break;
            case "surat-kelahiran":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_SURATKELAHIRAN = EMPTY_BLOB() WHERE NOREG = $no_reg "
                        . "returning F_SURATKELAHIRAN into :IMG";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }
                return $response;
                break;
            case "paspor":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_PASPOR = EMPTY_BLOB() WHERE NOREG = $no_reg "
                        . "returning F_PASPOR into :IMG";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }
                return $response;
                break;
            case "ijintt":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_KITAP = EMPTY_BLOB() WHERE NOREG = $no_reg "
                        . "returning F_KITAP into :IMG";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }
                return $response;
                break;
            case "bap":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_BAP_POLISI = EMPTY_BLOB() WHERE NOREG = $no_reg "
                        . "returning F_BAP_POLISI into :IMG";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }
                return $response;
                break;
            case "sp":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_PERTANGGUNGANMUTLAK = EMPTY_BLOB() WHERE NOREG = $no_reg "
                        . "returning F_PERTANGGUNGANMUTLAK into :IMG";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }
                return $response;
                break;
            default:
                break;
                return $response;
        }
    }

    public function uploadDoubleImage($request) {
        $tmp_file1 = $request['tmp_file1'];
        $tmp_file2 = $request['tmp_file1'];
        $no_reg = $this->db->escape($request['no_reg']);
        $type = $request['type'];
        $response = false;
        switch ($type) {
            case "ktp":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_KTPAYAH = EMPTY_BLOB(), F_KTPIBU = EMPTY_BLOB() "
                        . "WHERE NOREG = $no_reg "
                        . "returning F_KTPAYAH, F_KTPIBU into :IMG, :IMG2 ";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                oci_bind_by_name($insertImageParse, ':IMG2', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file1);
                    $lob->savefile($tmp_file2);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }

                break;
            case "saksi":
                $lob = oci_new_descriptor($this->conn, OCI_D_LOB);
                $insertImageSql = "UPDATE REG_LAHIR SET F_KTPSAKSI1 = EMPTY_BLOB(), F_KTPSAKSI2 = EMPTY_BLOB() "
                        . "WHERE NOREG = $no_reg "
                        . "returning F_KTPSAKSI1, F_KTPSAKSI2 into :IMG, :IMG2 ";
                $insertImageParse = oci_parse($this->conn, $insertImageSql);
                oci_bind_by_name($insertImageParse, ':IMG', $lob, -1, OCI_B_BLOB);
                oci_bind_by_name($insertImageParse, ':IMG2', $lob, -1, OCI_B_BLOB);
                $response = oci_execute($insertImageParse, OCI_NO_AUTO_COMMIT);
                if ($response) {
                    $lob->savefile($tmp_file1);
                    $lob->savefile($tmp_file2);
                    oci_commit($this->conn);
                    oci_free_statement($insertImageParse);
                    $response = true;
                } else {
                    oci_rollback($this->conn);
                    $response = false;
                }
                break;
            default:
                break;
        }
        return $response;
    }

    public function submitLahir($request) {
        $reg_lahir = $request['reg_lahir'];
        $reg_bayi = $request['reg_bayi'];
        $response = FALSE;
        $flag = "";
        $this->db->trans_begin();
        $this->db->insert('REG_LAHIR', $reg_lahir);
        if ($this->db->trans_status() === FALSE) {
            $flag .= 0;
        } else {
            $flag .= 1;
            $this->db->insert_batch('BAYI_SEMENTARA', $reg_bayi);
            if ($this->db->trans_status() === FALSE) {
                $flag .= 0;
            } else {
                $flag .= 1;
            }
        }
        if (strpos($flag, '0') === 0) {
            $response = FALSE;
            $this->db->trans_rollback();
        } else {
            $response = TRUE;
            $this->db->trans_commit();
        }
        return $response;
    }

}