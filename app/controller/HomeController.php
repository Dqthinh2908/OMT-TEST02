<?php
namespace app\controller;

use app\controller\BaseController as Controller;
use app\model\news;
use app\model\authors;
use app\libs\UploadFile as FILE;


class HomeController extends Controller{
    private $newsModel;
    private $dataAuthor;

    public function __construct()
    {
        $this->newsModel = new news;
        $this->dataAuthor = new authors;
    }
    public function index()
    {
        $getDataNews = $this->newsModel->getDataNews();
        
        // echo "<pre>";
        // print_r($getDataNews);
        // load header
        if(!empty($getDataNews))
        {
            $state = trim($_GET['state'] ?? '');
            $messageSuccess = null;
            $messageError = null;
            if($state === 'success')
            {
                $messageSuccess = 'Đã xóa thành công dữ liệu';
            }else if($state === 'deleteError')
            {
                $messageError = 'Xóa dữ liệu thất bại, vui lòng thử lại';
            }
            $this->loadHeader([
                'title'=>'Home Page'
            ]);
    
            $this->loadView('home/index_view',[
                'dataNews'=>$getDataNews,
                'messageSuccess'=>$messageSuccess,
                'messageError'=>$messageError                    
            ]);
            $this->loadFooter(
    
            );
        }
        
    }  
    public function addNews()
    {
        $getDataAuthors = $this->dataAuthor->getDataAuthors();
        $this->loadHeader([
            'title'=>'Add News'
        ]);
        $this->loadView('home/add_view',[
            'dataAuthor'=> $getDataAuthors

        ]);
        $this->loadFooter();
    }
    public function edit()
    {
        $id = $_GET['id'] ?? '';
        $getDataAuthors = $this->dataAuthor->getDataAuthors();
        $getDataById = $this->newsModel->getDataPostById($id);
        // echo "<pre>";
        // print_r($getDataById);
        // die();
        if(!empty($getDataById)){
            $this->loadHeader();
            $this->loadView('home/edit_view',[
                'info'=>$getDataById,
                'dataAuthor'=> $getDataAuthors
                
            ]);
            $this->loadFooter();
        }else
        {
            $this->loadHeader();
            $this->loadView('error/error_404'
                
            );
            $this->loadFooter();
        }
        
    }

    public function handleAdd()
    {
        if(isset($_POST['btnAddNews']))
        {
            $titleNews = $_POST['titleNews'] ?? '';
            $titleNews = strip_tags($titleNews); // xoa cac tags html
                // slug - xu ly nho common helper
            // $slug = slugtify($nameBrand);
            $contentNews = $_POST['contentNews'] ?? ''; 
            $user_id = $_POST['selectAuthor'];
                // tien hanh upload logo
            $nameImageNews = null; // ten anh - luu trong db
            if(!empty($_FILES['imageNews']['name'])){
                    // nguoi dung thuc su co upload logo
            $nameImageNews = File::uploadFileToServer($_FILES['imageNews'],PATH_UPLOAD_IMAGE_NEWS);
            }
            $insertNews = $this->newsModel->addNews($user_id,$titleNews,$nameImageNews,$contentNews);
            if($insertNews)
            {
                header('Location:index.php?c=home');
            }else{
                header('Location:index.php?c=home&m=addNews&state=fail');
            }          
        }
    }
    public function handleEdit()
    {
        if(isset($_POST['btnEditNews']))
        {  
            $id = $_GET['id'] ?? ''; 
            $dataNews = $this->newsModel->getDataPostById($id);
            
            // echo "<pre>";
            // print_r($dataNews);
            // die();
            if(!empty($dataNews))
            {
                // $nameImage = strip_tags($nameImage);

                $contentNews = $_POST['contentNews'] ?? '';
                $titleNews = $_POST['titleNews'] ?? '';
                $selectAuthor = $_POST['selectAuthor'] ?? '';
                $oldImage = $dataNews['image'];
                $checkUpload = null;    
                if(!empty($_FILES['imageNews']['name']))
                {
                    // nguoi dung thuc su muon thay doi image
                    $newImage = File::uploadFileToServer($_FILES['imageNews'],PATH_UPLOAD_IMAGE_NEWS);
                    if($newImage !== false)
                    {
                        $checkUpload = true; //thuc su upload anh moi
                    }
                }else
                {
                    $newImage = $oldImage;
                }
                $validation = validationNewsData($contentNews,$newImage);
                $flagcheck = true;
                foreach($validation as $val)
                {
                    if(!empty($val))
                    {
                        $flagcheck = false;
                        break;
                    }
                
                }
                if($flagcheck)
                {
                    //khong co loi nhap du lieu tu nguoi dùng
                    if(isset($_SESSION['editNews']))
                    {
                        unset($_SESSION['editNews']);
                    }
                    $update = $this->newsModel->updateDataNews($titleNews,$contentNews,$newImage,$selectAuthor,$id);
                    if($update)
                    {
                        //thanh cong
                        header("Location:index.php?c=home");
                    }else
                    {
                        header("Location:index.php?c=home&m=edit&state=fail");
                    }
                    
                }else
                {
                    //có lỗi nhập dữ liệu từ người dùng
                    $_SESSION['editNews'] = $validation;
                    //xoa anh upload neu co
                    if($checkUpload)
                    {
                        FILE::deleteFileServer($newImage, PATH_UPLOAD_IMAGE_NEWS);
                    }
                    header("Location:index.php?c=home&m=edit&id={$id}&state=error");

                }
                
            }else{
                header("Location:index.php?c=home&m=edit&id={$id}&state=empty");
            }

        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? '';
        $delete = $this->newsModel->deleteDataNews($id);
        if($delete)
        {
            header("Location:index.php?c=home&m=index&state=success");
        }else
        {
            header("Location:index.php?c=home&m=index&state=deleteError");
        }
    }
}
?>