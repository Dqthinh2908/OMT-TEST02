<?php if(!defined('ROOT_PATH')) exit('Can not access'); ?>
<!-- khong duoc phep truy cap truc tiep vao file view -->

<div class="container-fuild">
    <div class="row">
        <div class="col">
            <p>This is authors page!</p>
            <a href="index.php?c=author&m=addAuthor" class="ml-4 btn btn-primary">Thêm mới tác giả</a>
        </div>
    </div>
    <?php if(!empty($deleteSuccess)): ?>
        <h6 class="alert alert-success" role="alert"><?= $deleteSuccess ?></h6>
    <?php endif; ?>
    <?php if(!empty($deleteError)): ?>
        <h6 class="alert alert-danger" role="alert"><?= $deleteError ?></h6>
    <?php endif; ?>
    <div class="row mt-4">
        <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên tác giả</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th colspan="2" width="5%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($getDataAuthor as $key => $item): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $item['name'];?></td>
                            <td><?= $item['email'];?></td>
                            <td><?= $item['phone'];?></td>
                            <td><?= $item['address'];?></td>
                            <td><?= $item['gender'] == 0 ? "Nữ" : "Nam";?></td>
                            <td><?= $item['birthday'];?></td>
                            <td>
                                <a class="btn btn-info" href="index.php?c=author&m=edit&id=<?= $item['id'];?>" >Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="return confirm('Xác nhận xóa tác giả này ?')" href="index.php?c=author&m=deleteAuthor&id=<?= $item['id'];?>" >Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>