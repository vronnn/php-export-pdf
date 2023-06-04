<html>

<head>
	<title>Aplikasi CRUD dengan PHP</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

		* {
			margin: 0;
			padding: 0;
			font-family: 'Inter', sans-serif;
		}

		body {
			min-height: 100vh;
			width: 100%;
			background-color: #18181b;
			color: white;
			padding: 4rem 0;
			display: flex;
			justify-content: center;
		}

		h1 {
			font-size: 2.15rem;
		}

		section>*+* {
			margin-top: 1.5rem;
		}

		.title>*+* {
			margin-top: 8px;
		}

		.title p {
			color: #71717a;
		}

		form {
			border: 1px solid #3f3f45;
			height: fit-content;
			width: 33rem;
			padding: 1.5rem;
		}

		form>*+* {
			margin-top: 1.2rem;
		}

		.inp {
			display: flex;
			flex-direction: column;
			row-gap: 8px;
		}

		label {
			font-size: 1rem;
			opacity: 0.8;
			font-weight: 600;
		}

		.name {
			font-size: 1rem;
		}

		.text {
			appearance: none;
			border: 1px solid #3b757f;
			outline: none;
			padding: .75rem 1rem;
			box-sizing: border-box;
			font-size: 1rem;
			border-radius: 6px;
			background-color: transparent;
			color: white;
			width: 100%;
		}

		.text:focus {
			outline: 1px solid #92cace;
		}

		button {
			padding: .5rem 1rem;
			background-color: #5faab1;
			border: 2px solid #5faab1;
			border-radius: 6px;
			outline: none;
			font-size: 1rem;
			font-weight: 600;
			color: #1a2c32;
		}

		button:hover {
			background-color: #438e96;
			border: 2px solid #438e96;
		}

		.gender {
			display: flex;
			flex-direction: column;
			row-gap: 6px;
		}

		.gender-opt {
			display: flex;
			column-gap: 10px;
		}

		.radio-inp {
			background-color: transparent;
			border: 1px solid #3b757f;
			outline: none;
			padding: 1.1rem 1rem;
			border-radius: 6px;
			color: white;
			width: 100%;
			display: flex;
			align-items: center;
			column-gap: 12px;
		}

		.radio-inp.checked {
			background-color: #1a2c32;
			border: 1px solid #3b757f;
		}

		.radio:checked+.radio-inp {
			outline: 1px solid #92cace;
		}

		.phone-inp {
			position: relative;
		}

		.prefix {
			position: absolute;
			top: 50%;
			transform: translateY(-50%);
			left: 1;
			background-color: #1a2c32;
			padding: .7rem;
			font-size: 1rem;
			border-start-start-radius: 0.375rem;
			border-end-start-radius: 0.375rem;
			border-right: 1px solid #3b757f;
		}

		.phone {
			padding-left: 4.2rem;
		}

		textarea {
			background-color: transparent;
			border: 1px solid #3b757f;
			border-radius: 6px;
			padding: .7rem 1rem;
			outline: none;
			color: white;
			font-size: 1rem;
		}

		textarea:focus {
			outline: 1px solid #92cace;
		}

		.dropzone {
			position: relative;
			border: 2px dashed #3b757f;
			padding: 1rem;
			text-align: center;
			cursor: pointer;
			border-radius: 6px;
			transition: padding 0.3s ease-in-out;
			font-size: 1rem;
			z-index: 12;
		}

		.dropzone.highlight {
			border-color: #5faab1;
		}

		.file-inp {
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0;
			left: 0;
			opacity: 0;
			cursor: pointer;
		}

		.file-name {
			color: white;
			font-weight: bold;
			text-align: start;
		}

		.drag-text {
			line-height: 1.6rem;
			max-width: 18rem;
			margin: 0 auto;
		}

		.delete-button {
			padding: .5rem .65rem;
			background-color: #5faab1;
			border: 2px solid #5faab1;
			border-radius: 6px;
			outline: none;
			font-size: 1rem;
			font-weight: 600;
			color: #1a2c32;
			position: absolute;
			z-index: 10;
			right: 8;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
		}

		.klik {
			color: #3b757f;
			text-decoration: underline;
		}

		.last {
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		a {
			text-decoration: none;
			color: #92cace;
			border: 2px solid #92cace;
			border-radius: 6px;
			padding: .5rem 1rem;
			font-weight: 600;
		}

		a:hover {
			background-color: #1a2c32;
		}

		.warn {
			color: #71717a;
			font-size: .9rem;
		}

		.warn>*+* {
			margin-left: .2rem;
		}

		.submission>*+* {
			margin-left: .5rem;
		}
	</style>
</head>

<body>

	<?php
	// Load file koneksi.php
	include "koneksi.php";

	// Ambil data NIS yang dikirim oleh index.php melalui URL
	$id = $_GET['id'];

	// Query untuk menampilkan data siswa berdasarkan ID yang dikirim
	$sql = $pdo->prepare("SELECT * FROM siswa WHERE id=:id");
	$sql->bindParam(':id', $id);
	$sql->execute(); // Eksekusi query insert
	$data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
	?>
	<section>
		<div class="title">
			<h1>Ubah Data Siswa</h1>
			<p>Silahkan masukkan detail data diri siswa yang ingin diubah</p>
		</div>
		<form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
			<div class="inp">
				<label for="nama">Nama</label>
				<input class="text" type="text" name="nama" placeholder="Masukkan nama" value="<?php echo $data['nama']; ?>">
			</div>
			<div class="inp">
				<label for="nama">NIS</label>
				<input class="text" type="text" name="nis" placeholder="Masukkan NIS" value="<?php echo $data['nis']; ?>">
			</div>
			<div class="gender">
				<label for="gender">Gender</label>
				<div class="gender-opt">
					<?php
					if ($data['jenis_kelamin'] == "Laki-laki") {
						echo "<div id='m' class='radio-inp'>
							<input class='radio' type='radio' name='jenis_kelamin' value='Laki-laki' checked='checked'>
							<label for='nama'>Laki-laki</label>
						</div>";
						echo "<div id='f' class='radio-inp'>
							<input class='radio' type='radio' name='jenis_kelamin' value='Perempuan'>
							<label for='nama'>Perempuan</label>
						</div>";
					} else {
						echo "<div id='m' class='radio-inp'>
							<input class='radio' type='radio' name='jenis_kelamin' value='Laki-laki'>
							<label for='nama'>Laki-laki</label>
						</div>";
						echo "<div id='f' class='radio-inp'>
							<input class='radio' type='radio' name='jenis_kelamin' value='Perempuan' checked='checked'>
							<label for='nama'>Perempuan</label>
						</div>";
					}
					?>
				</div>
			</div>
			<div class="inp">
				<label for="nama">Nomor Telepon</label>
				<div class="phone-inp">
					<div class="prefix">+62</div>
					<input class="text phone" type="text" name="telp" placeholder="Masukkan nomor telepon" value="<?php echo $data['telp']; ?>">
				</div>
			</div>
			<div class="inp">
				<label for="nama">Alamat</label>
				<textarea name="alamat" id="alamat" cols="10" rows="3" placeholder="Masukkan alamat"><?php echo $data['alamat']; ?></textarea>
			</div>
			<div id="dropzone" class="dropzone">
					<input class="file-inp" type="file" id="fileInput" name="foto" multiple>
					<p id="dragText" class="drag-text"><span class="klik">Klik untuk upload</span> atau drag and drop
						<span class="format">JPG, JPEG, atau PNG</span>
					</p>
					<p id="fileName" class="file-name"></p>
					<button type="button" id="deleteButton" class="delete-button" style="display: none"><i class="fa-solid fa-trash-can"></i></button>
				</div>

			<div class="last">
				<div class="warn">
					<i class="fa-solid fa-circle-exclamation"></i>
					<span>Semua isian wajib diisi</span>
				</div>
				<div class="submission">
					<a href="index.php">Batal</a>
					<button type="submit">Ubah</button>
				</div>
			</div>
		</form>
	</section>

	<!-- <form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
		<table cellpadding="8">
			<tr>
				<td>NIS</td>
				<td><input type="text" name="nis" value="<?php echo $data['nis']; ?>"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" name="nama" value="<?php echo $data['nama']; ?>"></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>
					<?php
					if ($data['jenis_kelamin'] == "Laki-laki") {
						echo "<input type='radio' name='jenis_kelamin' value='laki-laki' checked='checked'> Laki-laki";
						echo "<input type='radio' name='jenis_kelamin' value='perempuan'> Perempuan";
					} else {
						echo "<input type='radio' name='jenis_kelamin' value='laki-laki'> Laki-laki";
						echo "<input type='radio' name='jenis_kelamin' value='perempuan' checked='checked'> Perempuan";
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Telepon</td>
				<td><input type="text" name="telp" value="<?php echo $data['telp']; ?>"></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><textarea name="alamat"><?php echo $data['alamat']; ?></textarea></td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>
					<input type="file" name="foto">
				</td>
			</tr>
		</table>

		<hr>
		<input type="submit" value="Ubah">
		<a href="index.php"><input type="button" value="Batal"></a>
	</form> -->

	<script>
		const dropzone = document.getElementById('dropzone');
		const fileInput = document.getElementById('fileInput');
		const fileNameDisplay = document.getElementById('fileName');
		const dragText = document.getElementById('dragText');
		const deleteButton = document.getElementById('deleteButton');

		dropzone.addEventListener('dragenter', (event) => {
			event.preventDefault();
			dropzone.classList.add('highlight');
		});

		dropzone.addEventListener('dragover', (event) => {
			event.preventDefault();
		});

		dropzone.addEventListener('dragleave', () => {
			dropzone.classList.remove('highlight');
		});

		dropzone.addEventListener('drop', (event) => {
			event.preventDefault();
			dropzone.classList.remove('highlight');
			handleFiles(event.dataTransfer.files);
		});

		fileInput.addEventListener('change', (event) => {
			handleFiles(event.target.files);
		});

		deleteButton.addEventListener('click', () => {
			fileInput.value = ''; // Clear the input value
			fileNameDisplay.textContent = '';
			fileInput.style.display = 'block';
			deleteButton.style.display = 'none';
			dropzone.style.borderStyle = 'dashed';
			dragText.style.display = 'block';
		});

		function handleFiles(files) {
			if (files.length > 0) {
				const fileName = files[0].name;
				fileNameDisplay.textContent = fileName;
				fileInput.style.display = 'none';
				deleteButton.style.display = 'block';
				dropzone.style.borderStyle = 'solid';
				dropzone.style.cursor = 'default'
				dragText.style.display = 'none';
			} else {
				fileNameDisplay.textContent = '';
				fileInput.style.display = 'block';
				deleteButton.style.display = 'none';
				dropzone.style.borderStyle = 'dashed';
				dropzone.style.cursor = 'pointer'
				dragText.style.display = 'block';
			}
			// Perform operations on the files here
			console.log(files);
		}
		const radioInputs = document.querySelectorAll('.radio');

		radioInputs.forEach((input) => {
			input.addEventListener('change', (event) => {
				radioInputs.forEach((input) => {
					input.parentElement.classList.remove('checked');
				});
				event.target.parentElement.classList.add('checked');
			});

			// Add initial check for pre-selected radio button
			if (input.checked) {
				input.parentElement.classList.add('checked');
			}
		});
	</script>
</body>

</html>