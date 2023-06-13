<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class AHP
 * 
 * @author     RumahSourceCode.Com <herdikayan@gmail.com>
 */
class AHP
{
    public $data; // matriks perbandingan AHP
    public $baris_total; // baris total dari matriks perbandingan AHP
    public $normal; // hasil normalisasi matriks AHP
    public $prioritas; //hasil rata-rata normal per baris
    public $cm; // consistency measure
    public $ci; // consistency index
    public $ri; // ratio index
    public $cr; // consistency ratio
    public $konsisten; // konsisten atau tidak konsisten

    /**     
     * Konstruktor
     *
     * @param array $data matriks perbandingan ahp
     */
    function __construct($data)
    {
        /** mengisi data sesuai inputan user */
        $this->data = $data;
        /**
         * memanggil function pada class AHP
         */
        $this->baris_total();
        $this->normal();
        $this->prioritas();
        $this->cm();

        /** Ratio index berdasarkan jumlah data */
        $nRI = array(
            1 => 0,
            2 => 0,
            3 => 0.58,
            4 => 0.9,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.46,
            10 => 1.49,
            11 => 1.51,
            12 => 1.48,
            13 => 1.56,
            14 => 1.57,
            15 => 1.59
        );
        /** menghitung CI */
        $this->ci = count($this->cm) == 0 ? 0 : ((array_sum($this->cm) / count($this->cm)) - count($this->cm)) / (count($this->cm) - 1);
        /** mengambil nilai RI */
        $this->ri = isset($nRI[count($this->data)]) ? $nRI[count($this->data)] : 0;
        /** menghitung CI */
        $this->cr = $this->ri == 0 ? 0 : $this->ci / $this->ri;
        /**menentukan konsistensi */
        $this->konsistensi = $this->cr <= 0.1 ? 'Konsisten' : 'Tidak Konsisten';
    }
    /**     
     * Menghitung baris total matriks AHP     
     */
    function baris_total()
    {
        $this->baris_total = array();
        foreach ($this->data as $key => $val) { // perulangan baris data
            foreach ($val as $k => $v) { // perulangan kolom data
                if (!isset($this->baris_total[$k]))
                    $this->baris_total[$k] = 0; // mengatur nilai awal baris 0
                $this->baris_total[$k] += $v; //menambahkan nilai baris sesuai kolom
            }
        }
    }
    /**     
     * Menghitung normalisasi matriks AHP
     */
    function normal()
    {
        $this->normal = array();
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                /** normalisasi didapat dari nilai matriks AHP dibagi baris total */
                $this->normal[$key][$k] = $v / $this->baris_total[$k];
            }
        }
    }
    /**     
     * Menghitung bobot prioritas     
     */
    function prioritas()
    {
        $this->prioritas = array();
        foreach ($this->normal as $key => $val) {
            /** prioritas didapat dari merata-ratakan matriks normal per baris */
            $this->prioritas[$key] = array_sum($val) / count($val);
        }
    }
    /**     
     * Menghitung consistency measure 
     */
    function cm()
    {
        $this->cm = array();
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                if (!isset($this->cm[$key]))
                    $this->cm[$key] = 0;

                /** cm didapat setiap baris matriks AHP dengan kolom prioritas */
                $this->cm[$key] += $v * $this->prioritas[$k];
            }
            /** kemudian membagi hasilnya dengan prioritas beris tersebut */
            $this->cm[$key] /= $this->prioritas[$key];
        }
    }
}

function get_nilai_option($selected = '')
{
    $nilai = array(
        '1' => 'Sama penting dengan',
        '2' => 'Mendekati sedikit lebih penting dari',
        '3' => 'Sedikit lebih penting dari',
        '4' => 'Mendekati lebih penting dari',
        '5' => 'Lebih penting dari',
        '6' => 'Mendekati sangat penting dari',
        '7' => 'Sangat penting dari',
        '8' => 'Mendekati mutlak dari',
        '9' => 'Mutlak sangat penting dari',
    );
    $a = '';
    foreach ($nilai as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$key - $value</option>";
        else
            $a .= "<option value='$key'>$key - $value</option>";
    }
    return $a;
}

function get_crips_option($kode_kriteria, $selected = '')
{
    $arr = get_crips();
    $a = '';
    foreach ($arr as $key => $val) {
        if ($val->kode_kriteria == $kode_kriteria) {
            if ($key == $selected)
                $a .= '<option value="' . $key . '" selected>' . $key . ' - ' . $val->nama_crips . '</option>';
            else
                $a .= '<option value="' . $key . '">' . $key . ' - ' . $val->nama_crips . '</option>';
        }
    }
    return $a;
}
function get_kriteria_option($selected = '')
{
    $arr = get_kriteria();
    $a = '';
    foreach ($arr as $key => $val) {
        if ($key == $selected)
            $a .= '<option value="' . $key . '" selected>' . $val->nama_kriteria . '</option>';
        else
            $a .= '<option value="' . $key . '">' . $val->nama_kriteria . '</option>';
    }
    return $a;
}
function get_kriteria()
{
    $rows = get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_kriteria] = $row;
    }
    return $arr;
}
function get_alternatif()
{
    $rows = get_results("SELECT * FROM tb_alternatif ORDER BY kode_alternatif");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_alternatif] = $row;
    }
    return $arr;
}
function get_crips()
{
    $rows = get_results("SELECT * FROM tb_crips ORDER BY kode_crips");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_crips] = $row;
    }
    return $arr;
}
function get_rel_alternatif()
{
    $rows = get_results("SELECT * FROM tb_rel_alternatif ORDER BY kode_alternatif, kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_alternatif][$row->kode_kriteria] = $row->kode_crips;
    }
    return $arr;
}
function get_rel_kriteria()
{
    $rows = get_results("SELECT * FROM tb_rel_kriteria ORDER BY ID1, ID2");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->ID1][$row->ID2] = $row->nilai;
    }
    return $arr;
}
function get_rel_crips($kode_kriteria)
{
    $rows = get_results("SELECT * FROM tb_rel_crips WHERE ID1 IN(SELECT kode_crips FROM tb_crips WHERE kode_kriteria='$kode_kriteria') AND ID2 IN(SELECT kode_crips FROM tb_crips WHERE kode_kriteria='$kode_kriteria') ORDER BY ID1, ID2");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->ID1][$row->ID2] = $row->nilai;
    }
    return $arr;
}
//GENERAL
function is_able($action)
{
    $role = [
        'admin' => [
            'home',
            'user.index', 'user.create', 'user.store', 'user.edit', 'user.update', 'user.destroy',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'kriteria.index', 'kriteria.create', 'kriteria.store', 'kriteria.edit', 'kriteria.update', 'kriteria.destroy',
            'crips.index', 'crips.create', 'crips.store', 'crips.edit', 'crips.update', 'crips.destroy',
            'menu_bobot', 'is_admin',
            'rel_kriteria.index', 'rel_kriteria.simpan',
            'rel_crips.index', 'rel_crips.simpan',
            'alternatif.index', 'alternatif.create', 'alternatif.store', 'alternatif.edit', 'alternatif.update', 'alternatif.destroy', 'alternatif.cetak', 'alternatif.detail', 'alternatif.detail.update',
            'rel_alternatif.index', 'rel_alternatif.edit', 'rel_alternatif.update',
            'hitung.index', 'hitung.cetak',
        ],
        'user' => [
            'home',
            // 'user.index', 'user.create', 'user.store', 'user.edit', 'user.update', 'user.destroy',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            // 'kriteria.index', 'kriteria.create', 'kriteria.store', 'kriteria.edit', 'kriteria.update', 'kriteria.destroy',
            // 'crips.index', 'crips.create', 'crips.store', 'crips.edit', 'crips.update', 'crips.destroy',
            // 'rel_kriteria.index', 'rel_kriteria.simpan',
            // 'rel_crips.index', 'rel_crips.simpan',
            // 'alternatif.index', 'alternatif.create', 'alternatif.store', 'alternatif.edit', 'alternatif.update', 'alternatif.destroy', 'alternatif.cetak',
            // 'rel_alternatif.index', 'rel_alternatif.edit', 'rel_alternatif.update',
            'hitung.index', 'hitung.cetak',
        ],
        'staff' => [
            'home',
            'user.index', 'user.create', 'user.store', 'user.edit', 'user.update', 'user.destroy',
            'user.password', 'user.password.update', 'user.logout', 'user.profil', 'user.profil.update',
            'kriteria.index', 'kriteria.create', 'kriteria.store', 'kriteria.edit', 'kriteria.update', 'kriteria.destroy',
            'crips.index', 'crips.create', 'crips.store', 'crips.edit', 'crips.update', 'crips.destroy',
            // 'menu_bobot', 'is_admin',
            // 'rel_kriteria.index', 'rel_kriteria.simpan',
            // 'rel_crips.index', 'rel_crips.simpan',
            'alternatif.index', 'alternatif.create', 'alternatif.store', 'alternatif.edit', 'alternatif.update', 'alternatif.destroy', 'alternatif.cetak', 'alternatif.detail', 'alternatif.detail.update',
            // 'rel_alternatif.index', 'rel_alternatif.edit', 'rel_alternatif.update',
            'hitung.index', 'hitung.cetak',
        ],
    ];
    $user = Auth::user();
    if ($user) {
        if (in_array($user->level, array_keys($role))) {
            return in_array($action, $role[$user->level]);
        }
    }
}

function is_hidden($action)
{
    return is_able($action) ? '' : 'hidden';
}

function is_admin()
{
    return Auth::user()->level == 'admin';
}

function is_user()
{
    return Auth::user()->level == 'user';
}

function format_date($data, $format = 'd-M-Y')
{
    return date($format, strtotime($data));
}



function get_image_url($file)
{

    if (File::exists($file) && File::isFile($file))
        return asset($file);
    else
        return asset('images/no_image.png');
}
function current_user()
{
    return User::find(Auth::id());
}

function get_level_option($selected = '')
{
    $arr = [
        'admin' => 'Admin',
        'user' => 'User',
        'staff' => 'Staff',
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_status_user_option($selected = '')
{
    $arr = [
        1 => 'Aktif',
        0 => 'NonAktif'
    ];
    $a = '';
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function show_error($errors)
{
    if ($errors->any()) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="m-0 pl-3">';
        foreach ($errors->all() as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>';
    }
}
function show_msg()
{
    if ($messsage = session()->get('message')) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">'
            . $messsage . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
}

function rp($number)
{
    return 'Rp ' . number_format($number);
}

function kode_oto($field, $table, $prefix, $length)
{
    $var = get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . ((int)substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function get_row($sql = '')
{
    $rows =  DB::select($sql);
    if ($rows)
        return $rows[0];
}

function get_results($sql = '')
{
    return DB::select($sql);
}

function get_var($sql = '')
{
    $row = DB::select($sql);
    if ($row) {
        return current(current($row));
    }
}

function query($sql, $params = [])
{
    return DB::statement($sql, $params);
}
