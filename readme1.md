## router -> app -> controller 

## controller -> model -> lấy dữ liệu;  
## controller -> view ->> render; 



  //  $.ajax({
        url: `http://localhost/dacs2/product/search/name/${keyword}/${limit}`,
        type: "GET", == METHOD --> GET hoặc POST 
        dataType: "json",
        success: function (response) {
        }
 //     }



 ## ajax --> load dữ liệu nhưng không load lại trang; 

 ## load dữ liệu mà load lại trang

 ## SPA (state) 
 ## ajax -> gọi link (API) -> lấy dữ liệu và trả về reponse


##  ## 1 user --> 2 địa chỉ đặt hàng

## đặt 1 đơn cho 1 địa chỉ ---> 1 đơn cho 2 địa chỉ :) 


## lúc admin --> xóa tài khoản khách hàng
## user vẫn truy cập được cho tới khi nó logout