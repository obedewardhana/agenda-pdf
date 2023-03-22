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
        $newdate = strtotime($date);
        return date("d-m-Y", $newdate);
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

function default_doc($doc)
{
    if ($doc == '') {
        return 'No Data';
    } else {
        $html = '<a class="links" href="'.base_url()."".$doc.'" target="_blank"></a>';
        return $html;
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

function convertToText($filename)
{

    $fileArray = pathinfo($filename);
    $file_ext  = $fileArray['extension'];
    if ($file_ext == "doc") {
        $fileHandle = fopen($filename, "r");
        $line = @fread($fileHandle, filesize($filename));
        $lines = explode(chr(0x0D), $line);
        $outtext = "";
        foreach ($lines as $thisline) {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE) || (strlen($thisline) == 0)) {
            } else {
                $outtext .= $thisline . " ";
            }
        }
        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext);
        return $outtext;
    } else {
        return "Invalid File Type";
    }
}
