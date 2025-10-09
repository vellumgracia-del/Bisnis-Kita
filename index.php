<?php
// Blok PHP untuk memproses formulir
$status_message = ''; // Variabel untuk menyimpan pesan status

// Cek apakah formulir sudah di-submit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // GANTI DENGAN ALAMAT EMAIL ANDA
    $penerima = "admin@bisniskita.com";

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
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bisnis Kita | Solusi Digital Profesional</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  
  <style>
    /* ... (Semua kode CSS Anda tetap sama seperti sebelumnya) ... */
    
    /* Tambahan CSS untuk pesan status */
    .status-sukses {
        padding: 1rem;
        margin-bottom: 1.5rem;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        text-align: center;
    }
    .status-error {
        padding: 1rem;
        margin-bottom: 1.5rem;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        text-align: center;
    }

    /* --- General Styling --- */
    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #F0F4F8; /* Latar belakang biru muda */
      color: #333;
    }
    
    /* ... (Sisa kode CSS Anda yang lain) ... */
    header {
      background-color: #0D2A4C;
      color: white;
      text-align: center;
      padding: 1rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    nav {
      background-color: #1A4A8D;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 1.5rem;
      padding: 0.75rem;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    nav a:hover {
      color: #6699CC;
    }

    main {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    section {
      padding: 3rem 1.5rem;
      max-width: 900px;
      width: 100%;
      box-sizing: border-box;
    }
    
    h2 {
      text-align: center;
      margin-bottom: 2rem;
      color: #0D2A4C; /* Biru Tua */
      font-size: 2.2rem;
    }

    .contact-form input, .contact-form textarea {
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    
    .contact-form input:focus, .contact-form textarea:focus {
        outline: none;
        border-color: #1A4A8D;
        box-shadow: 0 0 5px rgba(26, 74, 141, 0.5);
    }
    
    button {
      background-color: #1A4A8D; /* Biru Sedang */
      color: white;
      border: none;
      padding: 0.8rem 1.8rem;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 500;
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #0D2A4C; /* Biru Tua */
      transform: scale(1.05);
    }

    footer {
      text-align: center;
      background-color: #0D2A4C; /* Biru Tua */
      color: white;
      padding: 1.5rem;
      margin-top: 2rem;
    }
  </style>
</head>
<body>
  <header>
      <h1>Bisnis Kita</h1>
    </header>
    
    <nav>
      <a href="#about">Tentang</a>
      <a href="#services">Layanan</a>
      <a href="#testimoni">Testimoni</a>
      <a href="#team">Tim</a>
      <a href="#contact">Kontak</a>
      <a href="#faq">FAQ</a>
    </nav>

    <main>

    <section id="contact">
      <h2>Hubungi Kami</h2>
      <p>Isi formulir di bawah ini dan tim kami akan segera menghubungi Anda.</p>

      <?php echo $status_message; ?>

      <form class="contact-form" action="" method="post">
        <input type="text" id="nama" name="nama" placeholder="Nama Anda" required aria-label="Nama Anda">
        <input type="email" id="email" name="email" placeholder="Email Anda" required aria-label="Email Anda">
        <textarea id="pesan" name="pesan" rows="5" placeholder="Tulis pesan Anda di sini..." required aria-label="Pesan Anda"></textarea>
        <button type="submit">Kirim Pesan</button>
      </form>
    </section>

    </main>

  <footer>
    <p>© 2025 Bisnis Kita. Semua Hak Cipta Dilindungi.</p>
    <p id="waktu"></p>
  </footer>

  <script>
    // ... (Kode JavaScript untuk FAQ dan Jam Dinamis tetap sama) ...
    
    // FUNGSI kirimPesan() DIHAPUS karena proses pengiriman kini ditangani oleh PHP.

    function toggleFAQ(element) {
      // ... (kode ini tetap sama)
    }

    function updateTime() {
      // ... (kode ini tetap sama)
    }

    updateTime();  
    setInterval(updateTime, 1000);
  </script>
</body>
</html>
