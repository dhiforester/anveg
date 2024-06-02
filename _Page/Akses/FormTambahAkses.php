<div class="row">
    <div class="col-md-12 mb-3">
        <label for="nama"><b>Nama Lengkap</b></label>
        <input type="text" name="nama" id="nama" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="kontak"><b>Nomor Kontak</b></label>
        <input type="text" name="kontak" id="kontak" class="form-control" placeholder="+62">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="email"><b>Email</b></label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="password1"><b>Password</b></label>
        <input type="password" name="password1" id="password1" class="form-control">
        <small class="credit">Password hanya boleh terdiri dari 6-20 karakter angka dan huruf</small>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="password2"><b>Ulangi Password</b></label>
        <input type="password" name="password2" id="password2" class="form-control">
        <small class="credit">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPassword" name="TampilkanPassword">
                <label class="form-check-label" for="TampilkanPassword">
                    Tampilkan Password
                </label>
            </div>
        </small>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="image_akses"><b>Photo Profile</b></label>
        <input type="file" name="image_akses" id="image_akses" class="form-control">
        <small class="credit">Maximum File 2 Mb (PNG, JPG, JPEG, GIF)</small>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="akses"><b>Akses</b></label>
        <select name="akses" id="akses" class="form-control">
            <option value="">Pilih</option>
            <option value="Admin">Admin</option>
            <option value="Customer">Customer</option>
        </select>
    </div>
</div>
