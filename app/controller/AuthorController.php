<?php
namespace app\controller;
use app\controller\BaseController as Model;
use app\model\authors;
class AuthorController extends Model
{
    private $data;
    public function __construct()
    {
        $this->data = new authors;

    }
    public function index()
    {
        $getDataAuthor = $this->data->getDataAuthors();
        if(!empty($getDataAuthor))
        {
            $state = trim($_GET['state'] ?? '');
            $deleteSuccess = null;
            $deleteError = null;
            if($state === 'deleteSuccess')
            {
                $deleteSuccess = 'Đã xóa dữ liệu thành công';
            }else if($state === 'deleteError')
            {
                $deleteError = 'Xóa dữ liệu thất bại, vui lòng thử lại';
            }
            
            
            $this->loadHeader(['title'=>'Author Page']);
            $this->loadView('author/index_view',[
                'getDataAuthor'=>$getDataAuthor,
                'deleteSuccess'=>$deleteSuccess,
                'deleteError'=>$deleteError
    
            ]);
            $this->loadFooter();

        }

    }
    public function addAuthor()
    {
        $this->loadHeader();
        $this->loadView('author/addAuthor_view');
        $this->loadFooter();
    }
    public function handleAddAuthor()
    {
        if(isset($_POST['btnAddAuthor']))
        {
            // echo "<pre>";
            // print_r($_POST);
            // die;
            $nameAuthor = $_POST['nameAuthor'] ?? '';
            $nameAuthor = strip_tags($nameAuthor);

            $emailAuthor = $_POST['emailAuthor'] ?? '';
            $emailAUthor = strip_tags($emailAuthor);

            $phoneAuthor = $_POST['phoneAuthor'] ?? '';
            $phoneAuthor = strip_tags($phoneAuthor);

            $addressAuthor = $_POST['addressAuthor'] ?? '';

            $genderAuthor = $_POST['genderAuthor'] ?? '';

            $birthdayAuthor = $_POST['birthdayAuthor'] ?? '';

            $insertAuthor = $this->data->addAuthor($nameAuthor,$emailAuthor,$phoneAuthor,$addressAuthor,$birthdayAuthor,$genderAuthor);
            if($insertAuthor)
            {
                header('Location:index.php?c=author&m=index&state=success');
            }else{

                header('Location:index.php?c=author&m=index&state=fail');
            }
        }
    }
    public function edit()
    {
        $id = $_GET['id'];
        $getDataAuthorById = $this->data->getDataAuthorById($id);
        if(!empty($getDataAuthorById))
        {
            $this->loadHeader();
            $this->loadView('author/edit_view',[
                'getDataAuthor'=>$getDataAuthorById
            ]); 
            $this->loadFooter();
        }
    }
    public function handleEdit()
    {
        if(isset($_POST['btnEditAuthor']))
        {
            $id = $_GET['id'] ?? '';
            $getDataAuthor = $this->data->getDataAuthorById($id);
            // echo "<pre>";
            // print_r($getDataAuthor);
            if(!empty($getDataAuthor))
            {
                $nameAuthor = $_POST['nameAuthor'] ?? '';
                $nameAuthor = strip_tags($nameAuthor);

                $emailAuthor = $_POST['emailAuthor'] ?? '';
                $emailAuthor = strip_tags($emailAuthor);
                
                $phoneAuthor = $_POST['phoneAuthor'] ?? '';
                $phoneAuthor = strip_tags($phoneAuthor);

                $addressAuthor = $_POST['addressAuthor'] ?? '';
                $addressAuthor = strip_tags($addressAuthor);


                $birthdayAuthor = $_POST['birthdayAuthor'] ?? '';
                $birthdayAuthor = strip_tags($birthdayAuthor);
                
                $genderAuthor = $_POST['genderAuthor'] ?? '';

                $validation = validationAuthorData($nameAuthor,$emailAuthor);
                
                $flagcheck = true;
                foreach($validation as $value)
                {
                    if(!empty($value)){
                        $flagcheck = false;
                        break;
                    }
                }

                if($flagcheck)
                {
                    //khong co loi tu nguoi nhap tien hanh update
                    if(isset($_SESSION['editAuthor']))
                    {
                        unset($_SESSION['editAuthor']);
                    }
                    $update = $this->data->updateAuthorDataById($nameAuthor,$emailAuthor,$phoneAuthor,$addressAuthor,$birthdayAuthor, $genderAuthor,$id);
                    if($update)
                    {
                        header('Location:index.php?c=author&m=index&state=success');
                    }else
                    {
                        header('Location:index.php?c=author&m=edit&state=error');
                    }
                }else
                {
                    
                    //co loi den tu nguoi nhap du lieu
                    $_SESSION['editAuthor'] = $validation;
                    header("Location:index.php?c=author&m=edit&id={$id}&state=fail");
                }
            }

        }
    }
    public function deleteAuthor()
    {
        $id = $_GET['id'] ?? '';
        $delete = $this->data->deleteAuthor($id);
        if($delete)
        {
            header('Location:index.php?c=author&state=deleteSuccess');
        }else
        {
            header('Location:index.php?c=author&m=index&state=deleteError');
        }
    }

}