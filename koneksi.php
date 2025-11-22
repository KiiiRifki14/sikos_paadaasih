<?php
class database {

    // Gunakan 'public' alih-alih 'var' agar sesuai standar PBO modern & menghilangkan warning
    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "sikos_paadaasih";
    public $koneksi;

    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    // ==============================================================
    // A. FITUR AUTH (LOGIN & REGISTER)
    // ==============================================================

    function login($email, $password) {
        $email = mysqli_real_escape_string($this->koneksi, $email);
        $query = mysqli_query($this->koneksi, "SELECT * FROM tb_users WHERE email='$email'");
        $data_user = mysqli_fetch_array($query);
        
        if ($data_user) {
            if ($password == $data_user['password']) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $data_user['role'];
                $_SESSION['id_user'] = $data_user['id_user'];
                $_SESSION['nama_lengkap'] = $data_user['nama_lengkap'];
                $_SESSION['status'] = "login";
                return true;
            }
        }
        return false;
    }

    function register($nama, $email, $hp, $pass) {
        $query = "INSERT INTO tb_users (nama_lengkap, email, no_hp, password, role) 
                  VALUES ('$nama', '$email', '$hp', '$pass', 'penghuni')";
        return mysqli_query($this->koneksi, $query);
    }

    function logout() {
        session_start();
        session_destroy();
    }

    function get_user($id_user) {
        $query = mysqli_query($this->koneksi, "SELECT * FROM tb_users WHERE id_user='$id_user'");
        return mysqli_fetch_array($query);
    }

    // ==============================================================
    // B. FITUR DASHBOARD OWNER
    // ==============================================================

    function hitung_kamar() {
        $query = mysqli_query($this->koneksi, "SELECT count(*) as total FROM tb_kamar");
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }

    function hitung_kamar_terisi() {
        $query = mysqli_query($this->koneksi, "SELECT count(*) as total FROM tb_kamar WHERE status='isi'");
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }

    function hitung_pending_bayar() {
        $query = mysqli_query($this->koneksi, "SELECT count(*) as total FROM tb_tagihan WHERE status_bayar='menunggu_verifikasi'");
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }

    // ==============================================================
    // C. FITUR CRUD KAMAR (OWNER)
    // ==============================================================
    
    function tampil_kamar() {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_kamar ORDER BY id_kamar ASC");
        $hasil = [];
        if (mysqli_num_rows($data) > 0) {
            while ($d = mysqli_fetch_array($data)) {
                $hasil[] = $d;
            }
        }
        return $hasil;
    }

    function tambah_kamar($nomor, $tipe, $luas, $lantai, $fasilitas, $harga, $foto) {
        $nama_baru = "";
        if($foto['name'] != "") {
            $nama_baru = date('dmYHis') . "_" . $foto['name'];
            move_uploaded_file($foto['tmp_name'], "gambar/kamar/" . $nama_baru);
        }

        $query = "INSERT INTO tb_kamar (nomor_kamar, tipe_kamar, luas_kamar, lantai, fasilitas, harga_bulanan, status, foto_kamar) 
                  VALUES ('$nomor', '$tipe', '$luas', '$lantai', '$fasilitas', '$harga', 'kosong', '$nama_baru')";
        mysqli_query($this->koneksi, $query);
    }

    function hapus_kamar($id) {
        $data = $this->ambil_data_kamar_by_id($id);
        if ($data['foto_kamar'] != "" && file_exists("gambar/kamar/" . $data['foto_kamar'])) {
            unlink("gambar/kamar/" . $data['foto_kamar']);
        }
        mysqli_query($this->koneksi, "DELETE FROM tb_kamar WHERE id_kamar='$id'");
    }

    function edit_kamar($id, $nomor, $tipe, $luas, $lantai, $fasilitas, $harga, $foto) {
        $query_foto = "";
        if($foto['name'] != "") {
            $data_lama = $this->ambil_data_kamar_by_id($id);
            if ($data_lama['foto_kamar'] != "" && file_exists("gambar/kamar/" . $data_lama['foto_kamar'])) {
                unlink("gambar/kamar/" . $data_lama['foto_kamar']);
            }
            $nama_baru = date('dmYHis') . "_" . $foto['name'];
            move_uploaded_file($foto['tmp_name'], "gambar/kamar/" . $nama_baru);
            $query_foto = ", foto_kamar='$nama_baru'";
        }

        $query = "UPDATE tb_kamar SET 
                  nomor_kamar='$nomor', 
                  tipe_kamar='$tipe', 
                  luas_kamar='$luas', 
                  lantai='$lantai', 
                  fasilitas='$fasilitas', 
                  harga_bulanan='$harga' 
                  $query_foto
                  WHERE id_kamar='$id'";
        mysqli_query($this->koneksi, $query);
    }

    function ambil_data_kamar_by_id($id) {
        $query = mysqli_query($this->koneksi, "SELECT * FROM tb_kamar WHERE id_kamar='$id'");
        return mysqli_fetch_array($query);
    }

    // ==============================================================
    // D. FITUR DASHBOARD PENGHUNI
    // ==============================================================

    function get_kamar_penghuni($id_user) {
        $query = "SELECT k.*, t.tanggal_transaksi, t.durasi_bulan 
                  FROM tb_transaksi t 
                  JOIN tb_kamar k ON t.id_kamar = k.id_kamar 
                  WHERE t.id_user = '$id_user' AND t.status_bayar = 'lunas' 
                  ORDER BY t.id_transaksi DESC LIMIT 1";
        
        $result = mysqli_query($this->koneksi, $query);
        return mysqli_fetch_array($result);
    }

    function get_tagihan_user($id_user) {
    // Hapus tanda kutip tunggal di sekitar nama tabel/kolom jika tidak perlu
    $query = "SELECT * FROM tb_tagihan WHERE id_user = '$id_user' ORDER BY id_tagihan DESC";
    $result = mysqli_query($this->koneksi, $query);
    $hasil = [];
    // Cek jika ada hasil
    if (mysqli_num_rows($result) > 0) {
        while ($d = mysqli_fetch_array($result)) {
            $hasil[] = $d;
        }
    }
    return $hasil;
}

    function hitung_tagihan_pending($id_user) {
    // Perhatikan tanda kutipnya
    $query = "SELECT SUM(jumlah_tagihan) as total FROM tb_tagihan WHERE id_user='$id_user' AND status_bayar='belum_bayar'";
    $result = mysqli_query($this->koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    
    // Cek jika null (user baru belum ada tagihan)
    return $data['total'] ? $data['total'] : 0;
}

    // ==============================================================
    // E. FITUR TRANSAKSI (BOOKING)
    // ==============================================================

    function ajukan_sewa($id_user, $id_kamar, $harga) {
        $tgl = date('Y-m-d');
        $query_transaksi = "INSERT INTO tb_transaksi (id_user, id_kamar, tanggal_transaksi, durasi_bulan, total_bayar, status_bayar) 
                            VALUES ('$id_user', '$id_kamar', '$tgl', 1, '$harga', 'pending')";
        mysqli_query($this->koneksi, $query_transaksi);

        $bulan = date('F Y'); 
        $query_tagihan = "INSERT INTO tb_tagihan (id_user, id_kamar, periode_bulan, jumlah_tagihan, status_bayar) 
                          VALUES ('$id_user', '$id_kamar', '$bulan', '$harga', 'belum_bayar')";
        mysqli_query($this->koneksi, $query_tagihan);

        mysqli_query($this->koneksi, "UPDATE tb_kamar SET status='isi' WHERE id_kamar='$id_kamar'");
    }

    // --- F. FITUR KELOLA SEWA (OWNER) - BARU ---
    
    // Ambil semua data transaksi yang statusnya 'pending'
    function get_sewa_pending() {
        $query = "SELECT t.*, u.nama_lengkap, u.no_hp, k.nomor_kamar 
                  FROM tb_transaksi t 
                  JOIN tb_users u ON t.id_user = u.id_user 
                  JOIN tb_kamar k ON t.id_kamar = k.id_kamar 
                  WHERE t.status_bayar = 'pending'
                  ORDER BY t.tanggal_transaksi DESC";
        
        $result = mysqli_query($this->koneksi, $query);
        $hasil = [];
        while ($d = mysqli_fetch_array($result)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    // Konfirmasi sewa (Ubah status jadi lunas)
    function konfirmasi_sewa($id_transaksi) {
        // Update Transaksi
        mysqli_query($this->koneksi, "UPDATE tb_transaksi SET status_bayar='lunas' WHERE id_transaksi='$id_transaksi'");
        
        // Update Tagihan juga jadi lunas
        // Note: Ini asumsi id_tagihan dibuat bersamaan. Idealnya relasi lebih kompleks, tapi untuk tugas ini cukup.
        // Kita cari tagihan terkait user dan kamar ini yang belum bayar
        $data_trx = mysqli_fetch_assoc(mysqli_query($this->koneksi, "SELECT * FROM tb_transaksi WHERE id_transaksi='$id_transaksi'"));
        $id_user = $data_trx['id_user'];
        $id_kamar = $data_trx['id_kamar'];

        mysqli_query($this->koneksi, "UPDATE tb_tagihan SET status_bayar='lunas' WHERE id_user='$id_user' AND id_kamar='$id_kamar' AND status_bayar='belum_bayar' LIMIT 1");
    }

    // Tolak sewa
    function tolak_sewa($id_transaksi) {
        // Ambil info kamar dulu
        $data_trx = mysqli_fetch_assoc(mysqli_query($this->koneksi, "SELECT * FROM tb_transaksi WHERE id_transaksi='$id_transaksi'"));
        $id_kamar = $data_trx['id_kamar'];

        // Update Transaksi jadi ditolak
        mysqli_query($this->koneksi, "UPDATE tb_transaksi SET status_bayar='ditolak' WHERE id_transaksi='$id_transaksi'");

        // Kembalikan Status Kamar jadi 'kosong'
        mysqli_query($this->koneksi, "UPDATE tb_kamar SET status='kosong' WHERE id_kamar='$id_kamar'");
    }
}
?>