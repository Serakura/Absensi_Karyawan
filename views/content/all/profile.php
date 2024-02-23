<?php
$role = $_SESSION['role'];
if ($role == "karyawan") {
    $nip = $_SESSION['username'];
    $query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE username='$nip'");
}
while ($row = mysqli_fetch_array($query)) {
?>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="./content/all/function/updatedatadiri.php" method="POST">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama_karyawan']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nip" class="col-form-label">NIP:</label>
                            <input type="text" class="form-control" id="" name="" value="<?php if ($role == "karyawan") {
                                                                                                echo $row['nip'];
                                                                                            } ?>" disabled>
                            <input type="hidden" class="form-control" id="" name="<?php if ($role == "karyawan") {
                                                                                        echo "nip";
                                                                                    }  ?>" value="<?php if ($role == "karyawan") {
                                                                                                        echo $row['nip'];
                                                                                                    }  ?>">
                            <input type="hidden" id="role" class="form-control" name="role" value="<?php echo $role; ?>">
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin" class="col-form-label">Jenis Kelamin:</label>
                            <input type="text" id="jeniskelamin" class="form-control" name="jeniskelamin" value="<?php echo $row['jenis_kelamin']; ?>" disabled>

                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-form-label">Telepon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon" value="<?php echo $row['telp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required><?php echo $row['alamat']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui Data Diri</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php } ?>