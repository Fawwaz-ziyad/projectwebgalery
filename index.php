<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="template/assets/images/raples.jpg" type="image/ico" />
    <title>SMK Raflesia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #eee;
            padding: 20px;
        }

        .header-content {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .header-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header-text h1 {
            margin: 0;
        }

        .tagline {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        .section {
            display: flex;
            gap: 0;
            /* Hilangkan jarak antar box */
        }

        .section h3 {
            white-space: nowrap;
            /* Mencegah teks wrap/turun baris */
            display: inline-block;
            /* Biar ngikut lebar konten */
        }


        .agenda,
        .info {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        /* styling background dan warna tetap sama */
        .agenda {
            background: #c0392b;
            color: white;
            font-size: 20px;
            /* memperbesar semua teks di dalam agenda */
            line-height: 1.5;
        }

        .info {
            background: #ecf0f1;
            color: #333;
            overflow-y: auto;
            font-size: 20px;
            /* memperbesar semua teks di dalam agenda */
            line-height: 1.5;
        }

        .clear {
            clear: both;
        }

        .peta-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .peta-deskripsi {
            flex: 1;
            min-width: 300px;
        }

        .peta-gambar {
            flex: 1;
            min-width: 300px;
            text-align: center;
        }

        .peta-gambar img {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
        }

        .galeri-slider {
            width: 100%;
            max-width: 600px;
            margin: 30px auto 40px auto;
            position: relative;
            overflow: hidden;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .galeri-slider .slide {
            width: 100%;
            display: none;
            text-align: center;
        }

        .galeri-slider .slide.active {
            display: block;
        }

        .galeri-slider img {
            width: 100%;
            max-width: 600px;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }

        .galeri-section {
            background-color: #f5f5f5;
            padding: 40px 20px;
        }

        .galeri-card {
            display: flex;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            min-height: 300px;
            max-height: 400px;
        }

        .galeri-card img {
            width: 50%;
            height: auto;
            max-height: 100%;
            object-fit: cover;
            background-color: #ddd;
            display: block;
        }

        .galeri-content {
            width: 50%;
            padding: 20px;
            background-color: #d2e8c4;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            overflow: auto;
        }

        .galeri-label {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #5580a0;
            color: white;
            font-size: 12px;
            padding: 4px 10px;
            border-bottom-left-radius: 5px;
        }

        .galeri-content h3 {
            margin-top: 25px;
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .galeri-content p {
            font-size: 14px;
            color: #333;
            margin: 0;
            line-height: 1.6;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            margin: 5% auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
            border-radius: 10px;
        }

        .modal-caption {
            text-align: center;
            color: #ccc;
            padding: 10px 0;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-content">
            <img src="template/assets/images/raples.jpg" alt="Logo SMK Raflesia" class="logo">
            <div class="header-text">
                <h1>SMK Raflesia</h1>
                <p class="tagline">Maju seiring perkembangan digital</p>
            </div>
        </div>
    </div>



    <div class="galeri-slider">
        <?php
        $slider = mysqli_query($koneksi, "
            SELECT 
                (SELECT file FROM foto WHERE galery_id = g.id ORDER BY id ASC LIMIT 1) AS file,
                p.judul
            FROM galery g
            JOIN posts p ON g.post_id = p.id
            WHERE p.kategori_id = 6 AND g.status = 1 AND p.status = 'publish'
            ORDER BY g.position ASC LIMIT 5
        ");
        while ($s = mysqli_fetch_assoc($slider)) {
            echo '<div class="slide"><img src="uploads/' . htmlspecialchars($s['file']) . '" alt="' . htmlspecialchars($s['judul']) . '"></div>';
        }
        ?>
    </div>

    <div class="galeri-section">
        <?php
        $galeri = mysqli_query($koneksi, "
            SELECT 
                (SELECT file FROM foto WHERE galery_id = g.id ORDER BY id ASC LIMIT 1) AS file, 
                p.judul, 
                p.isi 
            FROM galery g
            JOIN posts p ON g.post_id = p.id
            WHERE p.kategori_id = 6 AND g.status = 1 AND p.status = 'publish'
            ORDER BY g.position ASC LIMIT 6
        ");
        while ($row = mysqli_fetch_assoc($galeri)) {
            echo '<div class="galeri-card">';
            echo '<img src="uploads/' . htmlspecialchars($row['file']) . '" alt="Galeri Kegiatan">';
            echo '<div class="galeri-content">';
            echo '<div class="galeri-label">GALERY KEGIATAN SEKOLAH</div>';
            echo '<h3>' . htmlspecialchars($row['judul']) . '</h3>';
            echo '<p>' . nl2br(htmlspecialchars($row['isi'])) . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <div class="section">
        <div class="agenda" style="background: #c0392b; color: white;">
            <h3>Agenda Sekolah</h3>
            <ul>
                <?php
                $agenda = mysqli_query($koneksi, "
                    SELECT * FROM posts 
                    WHERE kategori_id = 7 AND posts.status = 'publish' 
                    ORDER BY created_at DESC LIMIT 10
                ");
                while ($a = mysqli_fetch_assoc($agenda)) {
                    echo "<li>{$a['judul']}</li>";
                }
                ?>
            </ul>
        </div>

        <div class="info" style="background: #ecf0f1;">
            <h3>Informasi Terkini</h3>
            <?php
            $info = mysqli_query($koneksi, "
                SELECT * FROM posts 
                WHERE kategori_id = 1 AND posts.status = 'publish' 
                ORDER BY created_at DESC LIMIT 1
            ");
            $i = mysqli_fetch_assoc($info);

            if ($i) {
                echo "<h4 style='text-align: center;'>{$i['judul']}</h4>";

                $fotoInformasi = mysqli_query($koneksi, "
                    SELECT f.file 
                    FROM galery g 
                    JOIN foto f ON g.id = f.galery_id 
                    WHERE g.post_id = {$i['id']} AND g.status = 1
                    ORDER BY g.id DESC LIMIT 1
                ");
                $fp = mysqli_fetch_assoc($fotoInformasi);

                if ($fp && $fp['file']) {
                    echo "<img src='uploads/" . htmlspecialchars($fp['file']) . "' style='width:100%; max-width:600px; border-radius:10px; display:block; margin: 10px auto;' alt='" . htmlspecialchars($i['judul']) . "'>";
                } else {
                    echo "<p style='color: gray;'>Foto tidak ditemukan.</p>";
                }
                echo "<p>" . nl2br(htmlspecialchars($i['isi'])) . "</p>";
            } else {
                echo "<p>Tidak ada informasi terkini.</p>";
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="section" style="background: #bdc3c7;">
        <h3>Peta Sekolah</h3>
        <div class="peta-container">
            <div class="peta-deskripsi">
                <?php
                $peta = mysqli_query($koneksi, "SELECT * FROM profile WHERE judul LIKE '%peta%' LIMIT 1");
                if ($peta) {
                    $p = mysqli_fetch_assoc($peta);
                    if ($p) {
                        echo "<h4>{$p['judul']}</h4>";
                        echo "<p>" . nl2br(htmlspecialchars($p['isi'])) . "</p>";
                    } else {
                        echo "<p>Peta sekolah tidak ditemukan.</p>";
                    }
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
                ?>
            </div>
            <div class="peta-gambar">
                <?php
                $fotoPeta = mysqli_query($koneksi, "
                    SELECT f.file 
                    FROM galery g 
                    JOIN foto f ON g.id = f.galery_id 
                    WHERE g.position = 999 AND g.status = 1
                    ORDER BY g.id DESC LIMIT 1
                ");
                $fp = mysqli_fetch_assoc($fotoPeta);
                if ($fp && $fp['file']) {
                    echo "<img src='uploads/" . htmlspecialchars($fp['file']) . "' alt='Peta Sekolah'>";
                } else {
                    echo "<p>Foto peta tidak ditemukan.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <div id="modal" class="modal" onclick="closeModal()">
        <span class="modal-close">&times;</span>
        <img class="modal-content" id="modalImg">
        <div id="modalCaption" class="modal-caption"></div>
    </div>

    <script>
        // Slider
        let slides = document.querySelectorAll('.galeri-slider .slide');
        let currentSlide = 0;

        function showSlide(n) {
            slides.forEach(slide => slide.style.display = 'none');
            slides[n].style.display = 'block';
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        if (slides.length > 0) {
            showSlide(currentSlide);
            setInterval(nextSlide, 3000);
        }

        // Modal
        const modal = document.getElementById('modal');
        const modalImg = document.getElementById('modalImg');
        const modalCaption = document.getElementById('modalCaption');

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        // Attach click event to all images inside galeri-card and galeri-slider
        document.querySelectorAll('.galeri-card img, .galeri-slider img').forEach(img => {
            img.onclick = function() {
                modalImg.src = this.src;
                modalCaption.innerText = this.alt;
                openModal();
            }
        });
    </script>
</body>

</html>