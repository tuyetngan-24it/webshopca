<style>
    .ck-editor__editable_inline {
        min-height: 200px;
        color: #000 !important;
        background-color: #fff !important;
    }

    /* Tận dụng style của modal-content nhưng dùng cho trang edit dạng card */
    .edit-container {
        background-color: #fff; /* Hoặc màu nền theo theme của bạn */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        max-width: 800px;
        margin: 20px auto; /* Căn giữa */
        color: #333;
    }

    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
    .form-group input, .form-group select {
        width: 100%; padding: 10px;
        border: 1px solid #ccc; border-radius: 5px;
    }
    
    /* Style cho ảnh preview */
    .current-img-preview {
        margin-top: 10px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 5px;
        width: 100px; 
        height: 100px; 
        object-fit: cover;
    }
</style>

<div class="content-header">
    <h1>Chỉnh sửa sản phẩm: <?php echo $product['name'] ?? 'Sản phẩm' ?></h1>
    <a href="<?php echo ROOTLINK ?>/admin/products" class="btn-secondary" style="text-decoration: none; display: inline-block; padding: 10px 20px; background: #666; color: white; border-radius: 5px;">
        <i class="fa-solid fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="edit-container">
    <form action="<?php echo ROOTLINK ?>/admin/products/update/<?php echo $product['id'] ?>" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
        
        <input type="hidden" name="old_img" value="<?php echo $product['img'] ?>">

        <div class="form-group">
            <label>Tên sản phẩm (name)</label>
            <input type="text" name="name" required 
                   value="<?php echo $product['name'] ?>" 
                   placeholder="Nhập tên sản phẩm...">
        </div>

        <div class="form-group">
            <label>Danh mục</label>
            <select name="categoryId" required>
                <option value="">-- Chọn danh mục --</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id'] ?>" 
                            <?php echo ($cat['id'] == $product['categoryId']) ? 'selected' : '' ?>>
                            <?php echo $cat['name'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-row" style="display: flex; gap: 15px;">
            <div class="form-group" style="flex: 1;">
                <label>Giá (price)</label>
                <input type="number" name="price" required 
                       value="<?php echo $product['price'] ?>">
            </div>
            <div class="form-group" style="flex: 1;">
                <label>Số lượng (quantity)</label>
                <input type="number" name="quantity" required 
                       value="<?php echo $product['quantity'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Hình ảnh (img)</label>
            <div style="margin-bottom: 10px;">
                <p style="font-size: 12px; color: #666;">Ảnh hiện tại:</p>
                <img src="<?php echo $product['img'] ?>" class="current-img-preview" alt="Current Product Image">
            </div>
            <input type="file" name="img" accept="image/*">
            <small style="color: #888;">(Để trống nếu không muốn thay đổi ảnh)</small>
        </div>

        <div class="form-group">
            <label>Mô tả (description)</label>
            <textarea name="description" id="editor" rows="4"><?php echo $product['description'] ?></textarea>
        </div>

        <div class="form-footer" style="text-align: right; margin-top: 20px;">
            <button type="submit" class="btn-primary" style="padding: 10px 25px; font-size: 16px;">
                <i class="fa-solid fa-floppy-disk"></i> Cập nhật
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>