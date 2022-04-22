<?php if(!defined('ROOT_PATH')) exit('Can not access'); ?>
<!-- khong duoc phep truy cap truc tiep vao file view -->

<div class="container-fuild">
    <div class="row ml-4">
        <div class="col">
            <p>This is add author</p>
            <a  class="btn btn-primary" href="index.php?c=author">List authors</a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <form action="index.php?c=author&m=handleAddAuthor" method="post" class="border p-3" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="" class="form-label">Tên tác giả(*)</label>
                    <input type="text" name="nameAuthor" class="form-control" id="nameAuthor">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email(*)</label>
                    <input rows="8" type="text" name="emailAuthor" class="form-control" id="emailAuthor" ></input>
                </div>
                
                <div class="mb-3">
                    <label for="" class="form-label">Số điện thoại</label>
                    <input type="text" name="phoneAuthor" class="form-control"  id="phoneAuthor" >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Địa chỉ</label>
                    <input type="text" name="addressAuthor" class="form-control"  id="addressAuthor" >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Giới tính</label>
                    <select class="form-control" name="genderAuthor">
                        <option value="0">Nữ</option>
                        <option value="1">Nam</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Ngày sinh</label>
                    <input type="date" name="birthdayAuthor" class="form-control" >
                </div>
               

                <button type="submit" class="btn btn-primary" name="btnAddAuthor">Submit</button>
            </form>
        </div>

    </div>
</div>