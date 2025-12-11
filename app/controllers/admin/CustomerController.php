<?php
require_once __DIR__ . '/AdminController.php';

class CustomerController extends AdminController
{
    private $customerModel;

    public function index()
    {
        $this->customerModel = $this->loadModel('CustomerModel');
        $data['content'] = "components/admin/customers/customers";
        $data['subcontent']['page'] = 'customers';
        $data['subcontent']['customers'] = $this->getAllCustomers();
        $this->render('layouts/AdminLayout', $data);
        
    }

    public function getAllCustomers()
    {
        $this->customerModel = $this->loadModel('CustomerModel');
        return $this->customerModel->getAllCustomers();
    }

    public function addCustomer()
    {
        $this->customerModel = $this->loadModel('CustomerModel');

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $username = trim($_POST['username']);
            $name     = trim($_POST['name']);
            $email    = trim($_POST['email']);
            $phone    = trim($_POST['numberPhone']); 
            $password = trim($_POST['password']);

            $result = $this->customerModel->createCustomer($username, $name, $email, $phone, $password);

            if ($result) {
                 $this->render('components/status/addsuccess');
                echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
            } else {
                echo "Lỗi: Username hoặc Email đã tồn tại.";
                echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
            }
        }
    }

    public function edit($id)
    {
        $this->customerModel = $this->loadModel('CustomerModel');
        $data['content'] = "components/admin/customers/edit";
        $data['subcontent']['page'] = 'customers';
        $data['subcontent']['customer'] = $this->customerModel->getCustomerById($id);
        $this->render('layouts/AdminLayout', $data);
    }
    public function update($id)
    {
        $this->customerModel = $this->loadModel('CustomerModel');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
            $data = [
                'username'    => $_POST['username'],
                'name'        => $_POST['name'],
                'email'       => $_POST['email'],
                'numberPhone' => $_POST['numberPhone']
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = md5($_POST['password']);
            }

            $result = $this->customerModel->update($id, $data);

            if ($result) {
                $this->render('components/status/editsuccess');
                 echo '<meta http-equiv="refresh" content="2;url=' . $_SERVER['HTTP_REFERER'] . '">';
            } else {
                echo "Có lỗi xảy ra khi cập nhật.";
                echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
            }
        }
    }

  public function delete($id)
    {
        $this->customerModel = $this->loadModel('CustomerModel');
   $result =      $this->customerModel->deleteCustomer($id);
   print_r($result); 
      $this->render('components/status/deletesuccess');
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
    }


    
}