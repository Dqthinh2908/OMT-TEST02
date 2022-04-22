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
            <form class="border p-3" method="post" action="index.php?c=home&m=handleAdd" enctype="multipart/form-data">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    abascdasd
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Chọn tác giả(*)</label>
                    <select name="selectAuthor" id="" class="form-control">
                        <?php foreach($dataAuthor as $key => $value): ?>
                            <option value="<?=$value['id'] ?>"><?=$value['name'] ?></option>
                        <?php endforeach; ?>
                    </select>           
                </div>
                <button type="submit" class="btn btn-primary" name="btnAddNews">Submit</button>
            </form>
        </div>

    </div>
</div>