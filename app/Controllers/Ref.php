<?php

namespace App\Controllers;

use App\Models\RefModel;
use App\Libraries\Utils;
use Respect\Validation\Validator as v;

class Ref extends BaseController {
    public function index() {
        $data['pagefile'] = 'home';
        $data['pagename'] = 'Home';
        return view('pages/home', $data);
    }

    // jenis
    public function setJenis() {
        $data['pagefile'] = 'jenis';
        $data['pagename'] = 'Jenis';
        return view('pages/jenis', $data);
    }

    public function saveJenis() {
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $session = \Config\Services::session();
        $d['uid'] = $session->id;
        $v = v::key('jenis', v::alnum(' '))->key('uraian', v::alnum(' ', ',', '.'))->validate($d);
        if ($v) {
            $model = new RefModel();
            if ($model->saveJenis($d) > 0) {
                echo json_encode('Berhasil menyimpan data jenis');
            } else {
                if ($d['mode'] == 'create') {
                    echo json_encode('Gagal menyimpan data jenis');
                } else {
                    echo json_encode('Tidak ada perubahan data jenis');
                }
            }
        } else {
            echo json_encode('Data tidak valid!');
        }
    }

    public function allJenis() {
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $model = new RefModel();
        echo json_encode($model->allJenis($d));
    }

    public function jenisById() {
        $d = json_decode(file_get_contents("php://input"), true);
        $v = v::number()->validate($d['jid']);
        if ($v) {
            $model = new RefModel();
            echo json_encode(['message' => 'Jenis aset info founded', 'jenisInfo' => $model->jenisById($d)]);
        } else {
            echo json_encode(['message' => 'Data tidak valid!']);
        }
    }

    // satuan
    public function setSatuan() {
        $data['pagefile'] = 'satuan';
        $data['pagename'] = 'Satuan';
        return view('pages/satuan', $data);
    }
}