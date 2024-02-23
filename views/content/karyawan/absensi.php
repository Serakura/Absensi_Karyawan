<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<div class="table-responsive border px-2 py-4">
    <div class="container d-flex justify-content-center">
        <div>
            <video id="preview" width="100%"></video>
            <h3 class="text-center text-normal">Scan Absensi</h3>
        </div>

        <form action="./content/karyawan/function/buatabsensi.php" method="post" id="formqr" hidden>
            <input type="text" name="textqr" id="textqr" readonyy="" placeholder="scan qrcode" class="form-control">
            <input type="text" name="nip" id="nip" value="<?= $nip_karyawan ?>">
            <input type="submit" value="Submit" />
        </form>
    </div>

</div>