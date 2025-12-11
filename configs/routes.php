<?php
$routes['admin/dashboard/revenue'] = 'admin/DashboardController/index'; 
$routes['admin'] = 'admin/DashboardController/index';

$routes['defaultController'] = "homeController";

// --- SỬA CÁC ROUTE NÀY ĐỂ NHẬN CẢ .HTML ---

// Trang danh mục sản phẩm (Chấp nhận: categories HOẶC categories.html)
$routes['categories(\.html)?'] = 'CategoriesController';

// Trang đăng nhập (login HOẶC login.html)
$routes['login(\.html)?'] = 'loginController/index';

// Trang giới thiệu (about HOẶC about.html)
$routes['about(\.html)?'] = 'aboutController/index';

// Trang tin tức/kiến thức (knowledge HOẶC knowledge.html)
$routes['knowledge(\.html)?'] = 'KnowledgeController/index';
$routes['knowledge/search'] = 'KnowledgeController/search';

// Trang liên hệ (contact HOẶC contact.html)
$routes['contact(\.html)?'] = 'ContactController/index';
$routes['contact/send'] = 'ContactController/send';

// Giỏ hàng (cart HOẶC cart.html)
$routes['cart(\.html)?'] = 'CartController/index';

// Tài khoản (profile HOẶC profile.html)
$routes['profile(\.html)?'] = 'ProfileController/index';

// Đơn hàng của tôi (myorder HOẶC myorder.html)
$routes['myorder(\.html)?'] = 'MyOrderController/index';

// ---------------------------------------------

// Các route xử lý Form (Không cần .html vì người dùng không gõ link này)
$routes['signup'] = 'registerController/handleRegister';
$routes['handlesignup'] = 'registerController/createUser';
$routes['handleLogin'] = 'loginController/handleLogin';
$routes['logout'] = 'loginController/logout';

// Product API & Logic
$routes['products/get'] = 'ProductController/getProducPerPage'; 
$routes['products/totalPage'] = 'ProductController/getTotalPage';
$routes['productDetail'] = 'ProductDetailController/index'; // Link cũ (ít dùng nếu đã có link SEO ở dưới)

// Cart Actions
$routes['cart/add'] = 'CartController/add';
$routes['cart/remove'] = 'CartController/remove';
$routes['cart/update'] = 'CartController/update';

// Profile Actions
$routes['profile/addAddress'] = "ProfileController/addAddress";
$routes['profile/update'] = "ProfileController/update";
$routes['profile/deleteAddress'] = "ProfileController/deleteAddress";

// Order Actions
$routes['order'] = 'OrderController/index';
$routes['order/create'] = 'OrderController/create';
$routes['order/success'] = 'OrderController/success';
$routes['order/momo_return'] = 'OrderController/momo_return';
$routes['order/momo_ipn'] = 'OrderController/momo_ipn';

$routes['myorder/add'] = 'MyorderController/add';
$routes['myorderdetail'] = 'MyOrderDetailController/index';

// Search
$routes['product/search'] = 'ProductController/getProductPerPageById';
$routes['product/search/name'] = 'ProductController/getProductNameByName'; 

// Review
$routes['review'] = 'ReviewController/index';
$routes['review/add'] = 'ReviewController/add'; 
$routes['review/submit'] = 'ReviewController/submit'; 

// --- ROUTE SEO CHO SẢN PHẨM (Giữ nguyên cái này rất tốt) ---
// Ví dụ: iphone-13-123.html -> Vào ProductDetailController
$routes['.*-(\d+)\.html'] = 'ProductDetailController/index/$1'; 

// --- ROUTE ADMIN ---
$routes['admin/categories'] = 'admin/CategoriesController/index';
$routes['admin/categories/(.+)'] = 'admin/CategoriesController/$1';

$routes['admin/products'] = 'admin/ProductsController/index';
$routes['admin/products/(.+)'] = 'admin/ProductsController/$1';

$routes['admin/orders'] = 'admin/OrdersController/index';
$routes['admin/orders/(.+)'] = 'admin/OrdersController/$1';

$routes['admin/customers'] = 'admin/CustomerController/index';
$routes['admin/customers/(.+)'] = 'admin/CustomerController/$1';

$routes['admin/blogs'] = 'admin/AdminBlogController/index';
$routes['admin/blogs/(.+)'] = 'admin/AdminBlogController/$1';

// Chat AI
$routes['chat/ask'] = 'ChatController/ask';

// Blog Detail (Thêm .html vào đây luôn)
$routes['blogdetail(\.html)?'] = 'KnowledgeController/show';