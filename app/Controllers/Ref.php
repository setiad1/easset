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

    public function delJenis() {
        $model = new RefModel();
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $v = v::key('jid', v::number())->validate($d);
        if ($v) {
            if ($model->delJenis($d) > 0) {
                echo json_encode('Berhasil menghapus data jenis');
            } else {
                echo json_encode('Gagal menghapus data jenis');
            }
        } else {
            echo json_encode('Gagal menghapus data jenis');
        }
    }

    // satuan
    public function setSatuan() {
        $data['pagefile'] = 'satuan';
        $data['pagename'] = 'Satuan';
        return view('pages/satuan', $data);
    }

    public function saveSatuan() {
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $session = \Config\Services::session();
        $d['uid'] = $session->id;
        $v = v::key('satuan', v::alnum(' '))->key('uraian', v::alnum(' ', ',', '.'))->validate($d);
        if ($v) {
            $model = new RefModel();
            if ($model->saveSatuan($d) > 0) {
                echo json_encode('Berhasil menyimpan data satuan');
            } else {
                if ($d['mode'] == 'create') {
                    echo json_encode('Gagal menyimpan data satuan');
                } else {
                    echo json_encode('Tidak ada perubahan data satuan');
                }
            }
        } else {
            echo json_encode('Data tidak valid!');
        }
    }

    public function allSatuan() {
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $model = new RefModel();
        echo json_encode($model->allSatuan($d));
    }

    public function satuanById() {
        $d = json_decode(file_get_contents("php://input"), true);
        $v = v::number()->validate($d['sid']);
        if ($v) {
            $model = new RefModel();
            echo json_encode(['message' => 'Jenis aset info founded', 'satuanInfo' => $model->satuanById($d)]);
        } else {
            echo json_encode(['message' => 'Data tidak valid!']);
        }
    }

    public function delSatuan() {
        $model = new RefModel();
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $v = v::key('sid', v::number())->validate($d);
        if ($v) {
            if ($model->delSatuan($d) > 0) {
                echo json_encode('Berhasil menghapus data satuan');
            } else {
                echo json_encode('Gagal menghapus data satuan');
            }
        } else {
            echo json_encode('Gagal menghapus data satuan');
        }
    }

    // kondisi
    public function setKondisi() {
        $data['pagefile'] = 'kondisi';
        $data['pagename'] = 'Kondisi';
        return view('pages/kondisi', $data);
    }

    public function saveKondisi() {
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $session = \Config\Services::session();
        $d['uid'] = $session->id;
        $v = v::key('kondisi', v::alnum(' '))->key('uraian', v::alnum(' ', ',', '.'))->validate($d);
        if ($v) {
            $model = new RefModel();
            if ($model->saveKondisi($d) > 0) {
                echo json_encode('Berhasil menyimpan data kondisi');
            } else {
                if ($d['mode'] == 'create') {
                    echo json_encode('Gagal menyimpan data kondisi');
                } else {
                    echo json_encode('Tidak ada perubahan data kondisi');
                }
            }
        } else {
            echo json_encode('Data tidak valid!');
        }
    }

    public function allKondisi() {
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $model = new RefModel();
        echo json_encode($model->allKondisi($d));
    }

    public function kondisiById() {
        $d = json_decode(file_get_contents("php://input"), true);
        $v = v::number()->validate($d['kid']);
        if ($v) {
            $model = new RefModel();
            echo json_encode(['message' => 'Jenis aset info founded', 'kondisiInfo' => $model->kondisiById($d)]);
        } else {
            echo json_encode(['message' => 'Data tidak valid!']);
        }
    }

    public function delKondisi() {
        $model = new RefModel();
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $v = v::key('kid', v::number())->validate($d);
        if ($v) {
            if ($model->delKondisi($d) > 0) {
                echo json_encode('Berhasil menghapus data kondisi');
            } else {
                echo json_encode('Gagal menghapus data kondisi');
            }
        } else {
            echo json_encode('Gagal menghapus data kondisi');
        }
    }

    public function fetchOptRefs() {
        $model = new RefModel();
        $d = json_decode(file_get_contents("php://input"), TRUE);
        $r = $model->fetchOptRefs($d);
        $res = array();
        // jenis
        if ($r['ref'] === 'jenis') {
            if (count($r['res']) > 0) {
                foreach ($r['res'] as $i) {
                    $res[] = array(
                        "id" => $i['id'],
                        "jenis" => $i['jenis']
                    );
                }
            }
        }
        // satuan
        if ($r['ref'] === 'satuan') {
            if (count($r['res']) > 0) {
                foreach ($r['res'] as $i) {
                    $res[] = array(
                        "id" => $i['id'],
                        "satuan" => $i['satuan']
                    );
                }
            }
        }
        // kondisi
        if ($r['ref'] === 'kondisi') {
            if (count($r['res']) > 0) {
                foreach ($r['res'] as $i) {
                    $res[] = array(
                        "id" => $i['id'],
                        "kondisi" => $i['kondisi']
                    );
                }
            }
        }
        echo json_encode($res);
    }
}
