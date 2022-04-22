<?php if(!defined('ROOT_PATH')) exit('Can not access'); ?>
<!-- khong duoc phep truy cap truc tiep vao file view -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <p> Danh sách bài viết</p>
            <a class="btn btn-primary" href="index.php?c=home&m=addNews"> Thêm bài viết mới</a>
        </div>
    </div>
    <div class="row mt-5">  
        <div class="col">
            <?php if(!empty($messageSuccess)):?>
                <h6 class="alert alert-success" role="alert"><?= $messageSuccess ?></h6>
            <?php endif; ?>
            <?php if(!empty($messageError)):?>
                <h6 class="alert alert-danger" role="alert"><?= $messageError?></h6>
            <?php endif; ?>
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Người viết bài</th>
                        <th>Tiêu đề</th>
                        <th>Ảnh</th>
                        <th>Nội dung</th>
                        <th colspan="2" width="5%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                    <?php foreach ($dataNews as $key => $item):?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $item['name']; ?></td>
                            <td>
                                <?= $item['title'] ?>
                            </td>
                            <td>
                                <img src="<?= PATH_UPLOAD_IMAGE_NEWS.$item['image'] ?>" width="20%" alt="">
                            </td>
                            <td><?= $item['content']; ?></td>
                            <td>
                                <a class="btn btn-info" href="index.php?c=home&m=edit&id=<?= $item['id']; ?>">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="return confirm('Xác nhận xóa bài viết này ?')" id="delete" href="index.php?c=home&m=delete&id=<?= $item['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


</body>
</html>
