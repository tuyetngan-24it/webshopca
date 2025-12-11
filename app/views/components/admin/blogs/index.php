<style>
    :root {
        --primary: #3699ff;
        --bg-body: #151521;
        --bg-card: #1e1e2d;
        --text-main: #ffffff;
        --text-muted: #b5b5c3;
        --border-color: #323248;
        --danger: #f64e60;
        --warning: #ffa800;
        --success: #1bc5bd;
    }

    .content-wrapper { background-color: var(--bg-body); padding: 20px; min-height: 100vh; font-family: 'Poppins', sans-serif; }
    
    /* Card Style */
    .card-custom {
        background: var(--bg-card);
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        border: none;
        overflow: hidden; /* Bo góc cho table */
    }

    /* Input Search */
    .search-input {
        background: #151521;
        border: 1px solid #3a3a50;
        color: #fff;
        border-radius: 20px;
        padding: 10px 15px 10px 20px;
        width: 100%;
        outline: none;
        transition: 0.3s;
    }
    .search-input:focus { border-color: var(--primary); }

    /* Button Add */
    .btn-add {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        box-shadow: 0 4px 10px rgba(54, 153, 255, 0.3);
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
        white-space: nowrap; /* Giữ chữ trên 1 dòng */
        text-align: center;
    }
    .btn-add:hover { background: #0073e9; transform: translateY(-2px); color: #fff; }

    /* Table Style */
    .table-custom { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0; 
        min-width: 800px; /* UPDATE: Đảm bảo bảng không bị bóp méo trên mobile */
    }
    
    /* Container cho bảng có thể cuộn ngang */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-custom th {
        background-color: transparent;
        color: var(--text-muted);
        font-weight: 600;
        padding: 15px 20px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        white-space: nowrap; /* Tiêu đề 1 dòng */
    }
    .table-custom td {
        padding: 15px 20px;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
        font-size: 14px;
    }
    .table-custom tr:last-child td { border-bottom: none; }
    
    .blog-thumb {
        width: 60px; height: 60px; object-fit: cover; border-radius: 6px;
        border: 1px solid var(--border-color);
    }
    
    .badge-cat {
        background: rgba(54, 153, 255, 0.1);
        color: var(--primary);
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
    }
    
    .action-btn { font-size: 16px; margin: 0 5px; transition: 0.2s; }
    .action-btn:hover { opacity: 0.8; }

    /* Header Layout Classes (Thay thế inline styles) */
    .page-header {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 25px;
    }
    .header-actions {
        display: flex; 
        align-items: center; 
        gap: 15px;
    }
    .search-wrapper {
        position: relative; 
        width: 300px;
    }

    /* --- RESPONSIVE MEDIA QUERIES --- */
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px 10px; /* Giảm padding màn hình nhỏ */
        }
        
        .page-header {
            flex-direction: column; /* Xếp dọc header */
            align-items: stretch;
            gap: 15px;
        }

        .header-title {
            text-align: center;
            font-size: 24px !important;
        }

        .header-actions {
            flex-direction: column; /* Xếp dọc thanh tìm kiếm và nút */
            width: 100%;
        }

        .search-wrapper {
            width: 100%; /* Tìm kiếm full chiều rộng */
        }

        .btn-add {
            width: 100%; /* Nút full chiều rộng */
        }
        
        /* Căn chỉnh lại padding của table header cho cân đối trên mobile */
        .table-custom th:first-child, 
        .table-custom td:first-child {
            padding-left: 15px !important;
        }
    }
</style>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="header-title" style="margin: 0; color: #fff; font-weight: 600; font-size: 30px;">QUẢN LÝ BLOG</h3>
        
        <div class="header-actions">
            <div class="search-wrapper">
                <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm bài viết..." onkeyup="searchTable()">
                <i class="fa-solid fa-search" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
            </div>
            
            <a href="<?php echo ROOTLINK; ?>/admin/blogs/create" class="btn-add">
                <i class="fa-solid fa-plus"></i> Thêm mới
            </a>
        </div>
    </div>

    <div class="card-custom">
        <div class="table-responsive">
            <table class="table-custom" id="blogTable">
                <thead>
                    <tr>
                        <th style="padding-left: 30px;">ID</th>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Ngày tạo</th>
                        <th style="text-align: center; padding-right: 30px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($blogs)): ?>
                        <?php foreach($blogs as $item): ?>
                        <tr>
                            <td style="padding-left: 30px; color: var(--text-muted);">#<?php echo $item['id']; ?></td>
                            <td>
                                <?php if($item['image']): ?>
                                    <img src="<?php echo $item['image']; ?>" class="blog-thumb">
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="font-weight: 600; font-size: 15px; margin-bottom: 3px;"><?php echo $item['title']; ?></div>
                                <div style="color: var(--text-muted); font-size: 12px;"><?php echo substr($item['description'], 0, 60) . '...'; ?></div>
                            </td>
                            <td><span class="badge-cat"><?php echo $item['cat_name']; ?></span></td>
                            <td style="color: var(--text-muted);"><?php echo date('d/m/Y', strtotime($item['created_at'])); ?></td>
                            <td style="text-align: center; padding-right: 30px;">
                                <a href="<?php echo ROOTLINK; ?>/admin/blogs/delete/<?php echo $item['id']; ?>" 
                                   class="action-btn" 
                                   style="color: var(--danger);"
                                   onclick="return confirm('Bạn có chắc muốn xóa bài này?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted);">Chưa có bài viết nào!</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function searchTable() {
        var input = document.getElementById("searchInput");
        var filter = input.value.toLowerCase();
        var table = document.getElementById("blogTable");
        var tr = table.getElementsByTagName("tr");

        for (var i = 1; i < tr.length; i++) {
            var tdTitle = tr[i].getElementsByTagName("td")[2];
            if (tdTitle) {
                var txtValue = tdTitle.textContent || tdTitle.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>