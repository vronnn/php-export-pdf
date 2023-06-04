<html>

<head>
	<title>Aplikasi CRUD Plus Upload Gambar dengan PHP</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

		* {
			margin: 0;
			padding: 0;
			font-family: 'Inter', sans-serif;
		}

		body {
			height: 100vh;
			max-height: 100vh;
			width: 100%;
			background-color: #18181b;
			color: white;
			padding-top: 4rem;
		}

		h1 {
			text-align: center;
			margin-bottom: 1rem;
			font-size: 2.15rem;
		}

		section {
			min-width: 76rem;
			max-width: 76rem;
			margin: 0 auto;
		}

		table {
			margin-top: 1rem;
			border: 1px solid #3f3f45;
		}

		table td,
		table th {
			vertical-align: middle;
			text-align: center;
		}

		table th {
			padding: 12px 0;
			background-color: #1a2c32;
		}

		table td {
			border-top: 1px solid #3f3f45;
			padding: 10px 0;
		}

		a {
			text-decoration: none;
		}

		.tambah {
			padding: .6rem 1rem .6rem .75rem;
			border-radius: 6px;
			border: 1px solid #92cace;
			color: #92cace;
		}

		.tambah>*+* {
			margin-left: 8px;
		}

		.tambah:hover {
			background-color: #1a2c32;
			color: #92cace;
		}

		.ubah {
			display: flex;
			justify-content: end;
			align-items: center;
			padding-right: 6px;
		}

		.hapus {
			display: flex;
			justify-content: start;
			align-items: center;
			padding-left: 6px;
		}

		.delete {
			background-color: #dc2626;
			color: white;
			padding: 10px;
			border-radius: 6px;
		}

		.delete:hover {
			background-color: #b91c1c;
		}

		.edit {
			background-color: #5faab1;
			color: #1a2c32;
			padding: 10px;
			border-radius: 6px;
		}

		.edit:hover {
			background-color: #438e96;
		}

		.image {
			border-radius: 6px;
		}

		tr:nth-child(odd) td {
			background-color: rgba(26, 44, 50, .3);

			/* Apply the desired background color to the even rows */
			/* Add any additional styles as needed */
		}

		.meta {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		input {
			appearance: none;
			border: 1px solid #3b757f;
			outline: none;
			padding: .6rem 1rem;
			box-sizing: border-box;
			font-size: 1rem;
			border-radius: 6px;
			background-color: transparent;
			color: white;
			width: 20rem;
		}

		input:focus {
			outline: 1px solid #92cace;
		}

		.inp {
			position: relative;
		}

		button {
			position: absolute;
			right: 0;
			top: 50%;
			transform: translateY(-50%);
			color: #3b757f;
			padding: .7rem 1rem;
			border-radius: 6px;
			background: transparent;
			outline: none;
			border: none;
		}

		button:focus {
			outline: 2px solid #92cace;
		}
	</style>
</head>

<body>
	<h1>Data Siswa</h1>
	<section>
		<div class="meta">			
			<a class="tambah" target="_blank" href="export.php"><i class="fa-regular fa-file-pdf"></i><span>Export PDF</span></a>
			<a class="tambah" href="form_simpan.php"><i class="fa-solid fa-plus"></i><span>Tambah Data</span></a>
		</div>
		<table cellspacing="0" cellpading="0" width="100%">
			<tr>
				<th>Foto</th>
				<th>NIS</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Telepon</th>
				<th>Alamat</th>
				<th colspan="2">Aksi</th>
			</tr>
			<?php
			// Load file koneksi.php
			include "koneksi.php";

			// Buat query untuk menampilkan semua data siswa
			$sql = $pdo->prepare("SELECT * FROM siswa");
			$sql->execute(); // Eksekusi querynya

			while ($data = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql
				echo "<tr>";
				echo "<td><img class='image' src='images/" . $data['foto'] . "' width='100' height='100'></td>";
				echo "<td>" . $data['nis'] . "</td>";
				echo "<td>" . $data['nama'] . "</td>";
				echo "<td>" . $data['jenis_kelamin'] . "</td>";
				echo "<td>" . $data['telp'] . "</td>";
				echo "<td>" . $data['alamat'] . "</td>";
				echo "<td><div class='ubah'><a class='edit' href='form_ubah.php?id=" . $data['id'] . "'><i class='fa-solid fa-pen'></i></a></div></td>";
				echo "<td><div class='hapus'><a class='delete' href='proses_hapus.php?id=" . $data['id'] . "'><i class='fa-regular fa-trash-can'></i></a></div></td>";
				echo "</tr>";
			}
			?>
		</table>
	</section>
</body>

</html>