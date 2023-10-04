<!DOCTYPE html>
<html>
<head>
  <title>Survey Kepuasan</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('survei/style.css') }}">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- PWA  -->
  <meta name="theme-color" content="#6777ef"/>
  <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
  <link rel="manifest" href="{{ asset('/manifest.json') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
  @media (max-width: 2088px) {
    body {
      font-size: 1em; /* Contoh ukuran font yang lebih besar */
    }

    .konten {
      max-width: 100%; /* Contoh lebar maksimum untuk konten */
    }

    img {
        max-width: 200%;
        height: auto;
      }
  }
  
  .center {
  display: flex;
  flex-direction: column;
  justify-content: flex-start; /* Mengubah properti ini */
  align-items: center;
  height: 100vh;
  margin: 0;
}
  body {
  background-image : url("{{ asset('survei/bg.png') }}") ,linear-gradient(120deg, #2980b9, #6dd5fa);
  background-size: 100%;
  font-size: 10em; /* Ukuran font responsif */
  height: 100vh; /* Untuk mengisi seluruh tinggi viewport */
  margin: 0; /* Menghilangkan margin bawaan dari <body> */
  overflow: hidden; /* Menghilangkan kemungkinan penggeseran */
}
img {
        max-width: 500%;
        height: auto;
      }
</style>
<body>
  <div class="konten center">
    <h1  style="margin-bottom:-50">Survei Kepuasan</h1>
    <p>Pilih emoji yang sesuai dengan pelayanan yang anda terima:</p>
    <div class="emoji-container">
        <a href="{{route('survei.update', 4)}}" class="emoji" data-emoji="bahagia">
          <img src="{{ asset('survei/emoji_bahagia.png') }}" alt="Emoji Bahagia">
          <p>Sangat Puas</p>
        </a>
        <a href="{{route('survei.update', 3)}}" class="emoji" data-emoji="senang">
          <img src="{{ asset('survei/emoji_senang.png') }}" alt="Emoji Senang">
          <p>Puas</p>
        </a>
        <a href="{{route('survei.update', 2)}}" class="emoji" data-emoji="biasa">
          <img src="{{ asset('survei/emoji_biasa.png') }}" alt="Emoji Kurang">
          <p>Kurang Puas</p>
        </a>
        <a href="{{route('survei.update', 1)}}" class="emoji" data-emoji="sedih">
          <img src="{{ asset('survei/emoji_sedih.png') }}" alt="Emoji Sedih">
          <p>Tidak Puas</p>
        </a>
      </div>
  </div>
  <script src="{{ asset('/sw.js') }}"></script>
  <script>
      if (!navigator.serviceWorker.controller) {
          navigator.serviceWorker.register("/sw.js").then(function (reg) {
              console.log("Service worker has been registered for scope: " + reg.scope);
          });
      }
  </script>
  <script>
    // Fungsi penanganan klik pada emoji
    function handleEmojiClick(event) {
      event.preventDefault();

      // Ambil URL tautan emoji yang diklik
      var emojiUrl = event.currentTarget.getAttribute('href');

      // Lakukan permintaan HTTP ke URL emoji
      fetch(emojiUrl, {
        method: 'GET', // Gantilah metode ini sesuai dengan yang digunakan dalam aplikasi Anda
        headers: {
          'Content-Type': 'application/json', // Gantilah ini sesuai kebutuhan Anda
        },
      })
        .then(function(response) {
          if (response.ok) {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Data berhasil disimpan, Terima kasih masukannya', // Pesan yang ingin Anda tampilkan
            });
            disableEmojiLinks();
            setTimeout(enableEmojiLinks, 10000);
          } else {
            // Handle kesalahan jika ada
            console.error('Terjadi kesalahan saat mengirim permintaan ke server');
          }
        })
        .catch(function(error) {
          console.error('Terjadi kesalahan saat mengirim permintaan ke server:', error);
        });
    }

    // Fungsi untuk menonaktifkan semua tautan emoji
    function disableEmojiLinks() {
      var emojiLinks = document.querySelectorAll('.emoji');
      emojiLinks.forEach(function(link) {
        link.removeEventListener('click', handleEmojiClick);
        link.style.pointerEvents = 'none'; // Menonaktifkan tindakan klik
      });
    }

     // Fungsi untuk mengaktifkan kembali semua tautan emoji
    function enableEmojiLinks() {
      var emojiLinks = document.querySelectorAll('.emoji');
      emojiLinks.forEach(function(link) {
        link.addEventListener('click', handleEmojiClick);
        link.style.pointerEvents = 'auto'; // Mengaktifkan tindakan klik
      });
    }

    // Menambahkan event listener ke semua tautan emoji
    var emojiLinks = document.querySelectorAll('.emoji');
    emojiLinks.forEach(function(link) {
      link.addEventListener('click', handleEmojiClick);
    });
  </script>
</body>
</html>
