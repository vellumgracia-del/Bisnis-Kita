<?php
// Blok PHP untuk memproses formulir
$status_message = ''; // Variabel untuk menyimpan pesan status

// Cek apakah formulir sudah di-submit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // GANTI DENGAN ALAMAT EMAIL ANDA
    $penerima = "vellumgracia@gmail.com";

    // Ambil dan bersihkan data dari form
    $nama = strip_tags(trim($_POST["nama"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $pesan = trim($_POST["pesan"]);

    // Validasi sederhana
    if (empty($nama) || empty($pesan) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Jika ada data yang tidak valid, set pesan error
        $status_message = '<div class="status-error">Harap lengkapi semua kolom dengan benar.</div>';
    } else {
        // Susun subjek dan isi email
        $subjek = "Pesan Baru dari Website Bisnis Kita dari $nama";
        $konten_email = "Nama: $nama\n";
        $konten_email .= "Email: $email\n\n";
        $konten_email .= "Pesan:\n$pesan\n";

        // Buat header email
        $headers = "From: $nama <$email>";

        // Kirim email menggunakan fungsi mail() PHP
        if (mail($penerima, $subjek, $konten_email, $headers)) {
            // Jika berhasil, set pesan sukses
            $status_message = '<div class="status-sukses">Terima kasih! Pesan Anda telah berhasil dikirim.</div>';
        } else {
            // Jika gagal, set pesan error
            $status_message = '<div class="status-error">Oops! Terjadi kesalahan. Pesan Anda tidak dapat dikirim.</div>';
        }
    }
}
?>


      <?php echo $status_message; ?>

      <form class="contact-form" action="" method="post">
        <input type="text" id="nama" name="nama" placeholder="Nama Anda" required aria-label="Nama Anda">
        <input type="email" id="email" name="email" placeholder="Email Anda" required aria-label="Email Anda">
        <textarea id="pesan" name="pesan" rows="5" placeholder="Tulis pesan Anda di sini..." required aria-label="Pesan Anda"></textarea>
        <button type="submit">Kirim Pesan</button>
      </form>
    </section>

   

  
