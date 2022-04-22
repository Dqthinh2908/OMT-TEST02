<?php if(!defined('ROOT_PATH')) exit('Can not access'); ?>
<!-- khong duoc phep truy cap truc tiep vao file view -->

<div class="container-fuild">
    <div class="row ml-4">
        <div class="col">
            <p>This is add news</p>
            <a  class="btn btn-primary" href="index.php?c=home">List news</a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <form class="border p-3" method="post" action="index.php?c=home&m=handleEdit&id=<?= $info['id']; ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titleNews" class="form-label">Tiêu đề(*)</label>
                    <input type="text" name="titleNews" class="form-control" id="titleNews" value="<?= $info['title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="imageNews" class="form-label">Ảnh(*)</label>
                    <input type="file" name="imageNews" class="form-control" id="imageNews">
                    <img width="10%" class="mt-4" src="<?=PATH_UPLOAD_IMAGE_NEWS.$info['image'];?>" alt="">
                </div>
                <div class="mb-3">
                    <label for="contentNews" class="form-label">Nội dung(*)</label>
                    <textarea rows="8" type="text" name="contentNews" class="form-control" id="contentNews" ><?= $info['content'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Chọn tác giả(*)</label>
                    <select name="selectAuthor" id="" class="form-control">
                        <?php foreach($dataAuthor as $key => $value): ?>
                            <option value="<?= $value['id'] ?> " ><?=$value['name']?></option>
                        <?php endforeach; ?>
                    </select>           
                </div>
                <button type="submit" class="btn btn-primary" name="btnEditNews">Submit</button>
            </form>
        </div>

    </div>
</div>