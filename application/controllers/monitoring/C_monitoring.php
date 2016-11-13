<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of C_monitoring
 *
 * @author miko
 */
class C_monitoring extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model("monitoring/m_monitoring");
    }

    public function cekRegLahir() {
        $request = json_decode($this->input->get("request"));
        $action = $this->security->xss_clean($request->action);
        $noReg = $this->security->xss_clean($request->noReg);
        $response = $this->m_monitoring->cekNoregistrasi($noReg);
        // echo json_encode($response);
        $lastMemo = "";
        $memo = "";
        if ($response != null) {
            foreach ($response as $value) {
                $NOREG = $value['NOREG'];
                $NEGARAAYAH = $value['NEGARAAYAH'];
                $NEGARAIBU = $value['NEGARAIBU'];
                $F_KK = $value['F_KK'];
                $F_SURATKELAHIRAN = $value['F_SURATKELAHIRAN'];
                $F_AKTANIKAH = $value['F_AKTANIKAH'];
                $F_KTPAYAH = $value['F_KTPAYAH'];
                $F_KTPIBU = $value['F_KTPIBU'];
                $F_KTPSAKSI1 = $value['F_KTPSAKSI1'];
                $F_KTPSAKSI2 = $value['F_KTPSAKSI2'];
                $F_PASPOR = $value['F_PASPOR'];
                $F_KITAP = $value['F_KITAP'];
                $MEMOKELURAHAN = $value['MEMOKELURAHAN'];
                $MEMOKECAMATAN = $value['MEMOKECAMATAN'];
                $MEMODISPENDUK = $value['MEMODISPENDUK'];
                $FINISHKELURAHAN = $value['FINISHKELURAHAN'];
                $FINISHKECAMATAN = $value['FINISHKECAMATAN'];
                $FINISHDISPENDUK = $value['FINISHDISPENDUK'];
                if ($NEGARAIBU == 1 || $NEGARAAYAH == 1) {
                    //untuk wni
                    if ($F_KK == null || $F_SURATKELAHIRAN == null || $F_AKTANIKAH == null || $F_KTPAYAH == null || $F_KTPIBU == null || $F_KTPSAKSI1 == null || $F_KTPSAKSI2 == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_KK != null && $F_SURATKELAHIRAN != null && $F_AKTANIKAH != null && $F_KTPAYAH != null && $F_KTPIBU != null && $F_KTPSAKSI1 != null && $F_KTPSAKSI2 != null && $FINISHKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null && $FINISHKECAMATAN == null) {
                        $memo = "$MEMOKELURAHAN";
                        $lastMemo = 3;
                    } else if ($FINISHKECAMATAN != null && $FINISHDISPENDUK == null) {
                        # code...
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    } else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                } else if ($NEGARAAYAH != 1 && $NEGARAIBU != 1 && $NEGARAAYAH != null && $NEGARAIBU != null) {
                    //untuk wna
                    if ($F_SURATKELAHIRAN == null || $F_AKTANIKAH == null || $F_KTPSAKSI1 == null || $F_KTPSAKSI2 == null || $F_PASPOR == null || $F_KITAP == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_SURATKELAHIRAN != null && $F_AKTANIKAH != null && $F_KTPSAKSI1 != null && $F_KTPSAKSI2 != null && $F_PASPOR != null && $F_KITAP != null && $FINISHKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null && $FINISHKECAMATAN == null) {
                        $memo = "$MEMOKELURAHAN";
                        $lastMemo = 3;
                    } else if ($FINISHKECAMATAN != null && $FINISHDISPENDUK == null) {
                        # code...
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    } else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                } else {
                    if ($F_KTPSAKSI1 == null || $F_KTPSAKSI2 == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_KTPSAKSI1 != null && $F_KTPSAKSI2 != null && $FINISHKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null && $FINISHKECAMATAN == null) {
                        $memo = "$MEMOKELURAHAN";
                        $lastMemo = 3;
                    } else if ($FINISHKECAMATAN != null && $FINISHDISPENDUK == null) {
                        # code...
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    } else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                }
            }
            $response = array(
                'lastMemo' => $lastMemo,
                'memo' => $memo
            );
            echo json_encode($response);
        } else {
            $response = array(
                'lastMemo' => 0,
                'memo' => "belum registrasi bro"
            );
            echo json_encode($response);
        }
    }

    public function cekRegKtp() {
        $request = json_decode($this->input->get("request"));
        $action = $this->security->xss_clean($request->action);
        $noReg = $this->security->xss_clean($request->noReg);
        $response = $this->m_monitoring->cekNoregistrasiKtp($noReg);
        // echo json_encode($response);
        $lastMemo = "";
        $memo = "";
        if ($response != null) {
            foreach ($response as $value) {
                $NOREG = $value['NOREG'];
                $JENISPENDUDUK = $value['JENISPENDUDUK'];
                $F_PASPHOTO = $value['F_PASPHOTO'];
                $F_KK = $value['F_KK'];
                $F_AKTA_LAHIR = $value['F_AKTA_LAHIR'];
                $F_AKTA_NIKAH = $value['F_AKTA_NIKAH'];
                $F_KET_PINDAH = $value['F_KET_PINDAH'];
                $F_KITAP = $value['F_KITAP'];
                $F_PASPOR = $value['F_PASPOR'];
                $F_SKCK = $value['F_SKCK'];
                $MEMOKELURAHAN = $value['MEMOKELURAHAN'];
                $MEMOKECAMATAN = $value['MEMOKECAMATAN'];
                $MEMODISPENDUK = $value['MEMODISPENDUK'];

                $FINISHKELURAHAN = $value['FINISHKELURAHAN'];
                $FINISHKECAMATAN = $value['FINISHKECAMATAN'];
                $FINISHDISPENDUK = $value['FINISHDISPENDUK'];
                if ($JENISPENDUDUK == 1) {
                    //untuk wni
                    if ($F_PASPHOTO == null || $F_KK == null || $F_AKTA_LAHIR == null || $F_AKTA_NIKAH == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_PASPHOTO != null && $F_KK != null && $F_AKTA_LAHIR != null && $F_AKTA_NIKAH != null && $FINISHKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null && $FINISHKECAMATAN == null) {
                        $memo = "$MEMOKELURAHAN";
                        $lastMemo = 3;
                    } else if ($FINISHKECAMATAN != null && $FINISHDISPENDUK == null) {
                        # code...
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    } else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                } else {
                    //untuk wna
                    if ($F_PASPHOTO == null || $F_KK == null || $F_AKTA_LAHIR == null || $F_AKTA_NIKAH == null || $F_KITAP == null || $F_PASPOR == null || $F_SKCK == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_PASPHOTO != null && $F_KK != null && $F_AKTA_LAHIR != null && $F_AKTA_NIKAH != null && $F_KITAP != null && $F_PASPOR != null && $F_SKCK != null && $FINISHKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null) {
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    } else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                }
            }
            $response = array(
                'lastMemo' => $lastMemo,
                'memo' => $memo
            );
            echo json_encode($response);
        } else {
            $response = array(
                'lastMemo' => 0,
                'memo' => "belum registrasi bro"
            );
            echo json_encode($response);
        }
    }

    public function cekRegLahirKK() {
        $request = json_decode($this->input->get("request"));
        $action = $this->security->xss_clean($request->action);
        $noReg = $this->security->xss_clean($request->noReg);
        $response = $this->m_monitoring->cekNoregistrasiKK($noReg);
        // echo json_encode($response);
        $lastMemo = "";
        $memo = "";
        if ($response != null) {
            foreach ($response as $value) {
                $NOREG = $value['NOREG'];
                $JENISPENDUDUK = $value['JENISPENDUDUK'];
                $F_AKTANIKAH = $value['F_AKTANIKAH'];
                $F_KITAP = $value['F_KITAP'];
                $F_SKPD_DALAMNEGERI = $value['F_SKPD_DALAMNEGERI'];
                $F_SKD_LUARNEGERI = $value['F_SKD_LUARNEGERI'];
                $MEMOKELURAHAN = $value['MEMOKELURAHAN'];
                $MEMOKECAMATAN = $value['MEMOKECAMATAN'];
                $MEMODISPENDUK = $value['MEMODISPENDUK'];

                $FINISHKELURAHAN = $value['FINISHKELURAHAN'];
                $FINISHKECAMATAN = $value['FINISHKECAMATAN'];
                $FINISHDISPENDUK = $value['FINISHDISPENDUK'];
                if ($JENISPENDUDUK == 1) {
                    //untuk wni
                    if ($F_AKTANIKAH == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_AKTANIKAH != null && $FINISHKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null && $FINISHKECAMATAN == null) {
                        $memo = "$MEMOKELURAHAN";
                        $lastMemo = 3;
                    } else if ($FINISHKECAMATAN != null && $FINISHDISPENDUK == null) {
                        # code...
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    } else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                } else {
                    //untuk wna
                    if ($F_KITAP == null || $F_AKTANIKAH == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_KITAP != null && $F_AKTANIKAH != null && $FINISHKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null) {
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    }  else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                }
            }
            $response = array(
                'jenisPenduduk'=>$JENISPENDUDUK,
                'lastMemo' => $lastMemo,
                'memo' => $memo
            );
            echo json_encode($response);
        } else {
            $response = array(
                'lastMemo' => 0,
                'memo' => "belum registrasi bro"
            );
            echo json_encode($response);
        }
    }

    public function cekRegMati() {
        $request = json_decode($this->input->get("request"));
        $action = $this->security->xss_clean($request->action);
        $noReg = $this->security->xss_clean($request->noReg);
        $response = $this->m_monitoring->cekNoregistrasiMati($noReg);
        // echo json_encode($response);
        $lastMemo = "";
        $memo = "";
        if ($response != null) {
            foreach ($response as $value) {
                $NOREG = $value['NOREG'];
                $JENISPENDUDUK = $value['NEGARAJENAZAH'];

                $F_KTP = $value['F_KTP'];
                $F_KK = $value['F_KK'];
                $F_SURAT_KEMATIAN = $value['F_SURAT_KEMATIAN'];
                $F_AKTA_LAHIR = $value['F_AKTA_LAHIR'];
                $F_AKTA_NIKAH = $value['F_AKTA_NIKAH'];
                $F_KTPSAKSI1 = $value['F_KTPSAKSI1'];
                $F_KTPSAKSI2 = $value['F_KTPSAKSI2'];
                $F_VISA = $value['F_VISA'];
                $F_PASPOR = $value['F_PASPOR'];
                $F_KITAS = $value['F_KITAS'];
                $F_KITAP = $value['F_KITAP'];

                $MEMOKELURAHAN = $value['MEMOKELURAHAN'];
                $MEMOKECAMATAN = $value['MEMOKECAMATAN'];
                $MEMODISPENDUK = $value['MEMODISPENDUK'];

                $FINISHKELURAHAN = $value['FINISHKELURAHAN'];
                $FINISHKECAMATAN = $value['FINISHKECAMATAN'];
                $FINISHDISPENDUK = $value['FINISHDISPENDUK'];
                if ($JENISPENDUDUK == 1) {
                    //untuk wni
                    if ($F_KTP == null || $F_KK == null || $F_SURAT_KEMATIAN == null || $F_AKTA_LAHIR == null || $F_AKTA_NIKAH == null || $F_KTPSAKSI1 == null || $F_KTPSAKSI2 == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_KTP != null && $F_KK != null && $F_SURAT_KEMATIAN != null && $F_AKTA_LAHIR != null && $F_AKTA_NIKAH != null && $F_KTPSAKSI1 != null && $F_KTPSAKSI2 != null && $MEMOKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null && $FINISHKECAMATAN == null) {
                        $memo = "$MEMOKELURAHAN";
                        $lastMemo = 3;
                    } else if ($FINISHKECAMATAN != null && $FINISHDISPENDUK == null) {
                        # code...
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    } else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                } else {
                    //untuk wna
                    if ($F_SURAT_KEMATIAN == null || $F_AKTA_LAHIR == null || $F_AKTA_NIKAH == null || $F_VISA == null || $F_PASPOR == null || $F_KITAS == null || $F_KITAP == null) {
                        $memo = "-";
                        $lastMemo = 1;
                    } else if ($F_SURAT_KEMATIAN != null && $F_KTP != null && $F_AKTA_LAHIR != null && $F_AKTA_NIKAH != null && $F_VISA != null && $F_PASPOR != null && $F_KITAS != null && $F_KITAP != null && $MEMOKELURAHAN == null) {
                        $memo = "Nomer anda telah terdaftar dan persyaratan telah di upload, tolong datang ke kelurahan untuk verifikasi";
                        $lastMemo = 2;
                    } else if ($FINISHKELURAHAN != null) {
                        $memo = "$MEMOKECAMATAN";
                        $lastMemo = 4;
                    } else if ($FINISHDISPENDUK != null) {
                        # code...
                        $memo = "$MEMODISPENDUK";
                        $lastMemo = 5;
                    }
                }
            }
            $response = array(
                'lastMemo' => $lastMemo,
                'memo' => $memo
            );
            echo json_encode($response);
        } else {
            $response = array(
                'lastMemo' => 0,
                'memo' => "belum registrasi bro"
            );
            echo json_encode($response);
        }
    }

}
