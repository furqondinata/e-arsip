<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Arsip</h3>
                <div class="box-tools pull-right">
                    <a href="<?= base_url('arsip/add') ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>Add</a>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">

                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>
                <table id="example1" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Arsip</th>
                            <th>Nama Arsip</th>
                            <th>Kategori</th>
                            <th>Upload</th>
                            <th>Update</th>
                            <th>User</th>
                            <th>Departemen</th>
                            <th>File</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($arsip as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['no_arsip'] ?></td>
                                <td><?= $value['nama_arsip'] ?></td>
                                <td><?= $value['nama_kategori'] ?></td>
                                <td><?= $value['tgl_upload'] ?></td>
                                <td><?= $value['tgl_update'] ?></td>
                                <td><?= $value['nama_user'] ?></td>
                                <td><?= $value['nama_dep'] ?></td>
                                <td class="text-center"> <a href="<?= base_url('arsip/viewpdf/' . $value['id_arsip']) ?>">
                                        <i class="fa fa-file-pdf-o fa-2x label-danger"></i></a><br>
                                    <?= number_format($value['ukuran_file'], 0) ?> Byte
                                </td>

                                <td class="text-center">

                                    <a href="<?= base_url('arsip/edit/' . $value['id_arsip']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <button button class=" btn btn-sm btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_arsip']; ?>">Delete</button>
                                </td>
                            </tr>
                        <?php   } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>

<!-- /.modal  delete kategori-->
<?php foreach ($arsip as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_arsip'] ?>">
        <div class="modal-dialog modal-danger modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hapus User</h4>
                </div>
                <div class="modal-body">
                    apakah anda Yakin Ingin Menghapus <b> <?= $value['nama_arsip'] ?> .. </b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('arsip/delete/' . $value['id_arsip']) ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div><!-- /.example-modal -->
<?php } ?>
<!-- / end.modal delete kategori--