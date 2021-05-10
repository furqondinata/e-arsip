<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>

            </div><!-- /.box-header -->
            <div class="box-body">

                <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <h5>Ada Kesalahan</h5>
                        <ul>
                            <?php foreach ($errors as $key => $value) { ?>
                                <li> <?= esc($value) ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php    } ?>
                <?php echo form_open_multipart('user/update/' . $user['id_user']); ?>
                <div class="form-group">
                    <label>Nama User</label>
                    <input name="nama_user" value="<?= $user['nama_user'] ?>" class="form-control" placeholder="Nama User">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input name="email" value="<?= $user['email'] ?>" class="form-control" placeholder="Email" readonly>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input name="password" value="<?= $user['password'] ?>" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control">
                        <option value="<?= $user['level'] ?>"><?php if ($user['level'] == 1) {
                                                                    echo 'Admin';
                                                                } else {
                                                                    echo 'User';
                                                                } ?></option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Departemen</label>
                    <select name="id_dep" class="form-control">
                        <option value="<?= $user['id_dep'] ?>"><?= $user['nama_dep'] ?></option>
                        <?php foreach ($dep as $key => $value) { ?>
                            <option value="<?= $value['id_dep'] ?>"><?= $value['nama_dep'] ?></option>
                        <?php    } ?>

                    </select>
                </div>



                <div class="row">
                    <div class="col-sm-4">

                        <label>Foto User</label>

                        <img src="<?= base_url('foto/' . $user['foto']) ?>" width="100px">
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Ganti Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                    <a href="<?= base_url('user') ?>" class="btn btn-success ">Kembali</a>
                </div>


                <?php echo form_close() ?>


            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
    <div class="col-md-3">
    </div>
</div>