<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka);
    return $hasil_rupiah;
}

function reformat_date($date)
{
    if ($date == '') {
        return $date;
    } else {
        $date = strtotime($date);
        return date("d-m-Y", $date);
    }
}

function default_pic($photo)
{
    if ($photo == '') {
        return 'default.png';
    } else {
        return $photo;
    }
}

function math($ma)
{
    if (preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $ma, $matches) !== FALSE) {
        $operator = $matches[2];

        switch ($operator) {
            case '+':
                $p = $matches[1] + $matches[3];
                break;
            case '-':
                $p = $matches[1] - $matches[3];
                break;
            case '*':
                $p = $matches[1] * $matches[3];
                break;
            case '/':
                $p = $matches[1] / $matches[3];
                break;
        }

        return rupiah($p);
    }
}

function template()
{
    $ci = &get_instance();
    $query = $ci->db->query("SELECT judul FROM templates where aktif='Y'");
    $tmp = $query->row_array();
    if ($query->num_rows() >= 1) {
        return $tmp['judul'];
    } else {
        return 'errors';
    }
}
