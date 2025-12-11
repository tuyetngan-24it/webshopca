<?php
class AddressModel extends Model
{
   
    // lấy id của 
    public function AddProvince($provinceName)
    {
        $this->table = 'provinces';
        $provinceId  = 0;
        $sql = "SELECT * FROM provinces WHERE name = '$provinceName'";
        $result = $this->query($sql);
        if ($result->num_rows != 0) {
            $row = $result->fetch_assoc();
            $provinceId = $row['id'];
        } else {
            $result = $this->create(['name' => $provinceName]);
            $provinceId = $result;
        }
        return $provinceId;
    }



        public function Addward($wardName)
    {
        $this->table = 'wards';
        $wardId  = 0;
        $sql = "SELECT * FROM wards WHERE name = '$wardName'";
        $result = $this->query($sql);
        if ($result->num_rows != 0) {
            $row = $result->fetch_assoc();
            $wardId = $row['id'];
        } else {
            $result = $this->create(['name' => $wardName]);
            $wardId = $result;
        }
        return $wardId;
    }


    public function addAddress($data) {
        $this->table = 'address';
       return  $this->create($data);
    }


    public function getAllAdressById($userId) {
        $sql = "SELECT provinces.name as province,
        address.id as addressid,
        users.name as receiverName,
        users.numberPhone as phone,
        wards.name as ward,
        address.streetDetail as street FROM address 
        JOIN provinces ON provinces.id = address.proviceId 
        JOIN wards ON wards.id = address.wardId
        JOIN users ON users.id = address.userId
        WHERE users.id = $userId";

       return $this->query($sql); 
    }

    public function deleteAddress($id)
    {
        $sql = "DELETE FROM `address` WHERE id = $id"; 
        $result = $this->query($sql); 
        return $result;

    }



}
