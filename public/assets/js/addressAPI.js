let ProvincesForm = $('select.form-control.provinces');
let WardForm = $('select.form-control.wards');

// Input ẩn
let ProvinceNameHidden = $('#province_name_hidden');
let WardNameHidden = $('#ward_name_hidden');

$.ajax({
    url: `https://provinces.open-api.vn/api/v2/`,
    type: "GET",
    dataType: "json",
    success: function (data) {
        data.forEach(province => {
            // TRICK: Lưu thêm thuộc tính data-name vào thẻ option
            let provincesData = `
                <option value="${province.code}" data-name="${province.name}">
                    -- ${province.name} --
                </option>`;
            ProvincesForm.append(provincesData);
        });

        // Sự kiện khi chọn Tỉnh
        ProvincesForm.on('change', function () {
            let provinceCode = $(this).val();

            // 1. Lấy tên tỉnh từ attribute data-name của option đang chọn
            let selectedOption = $(this).find('option:selected');
            let provinceName = selectedOption.data('name');

            // 2. Gán vào input ẩn
            ProvinceNameHidden.val(provinceName);

            // Reset Ward
            WardForm.html('<option value="">-- Chọn Xã / Phường --</option>');
            WardNameHidden.val(''); // Reset tên xã luôn

            if (provinceCode) {
                $.ajax({
                    url: `https://provinces.open-api.vn/api/v2/w?province=${provinceCode}`,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        data.forEach(ward => {
                            let wardData = `
                                <option value="${ward.code}" data-name="${ward.name}">
                                    -- ${ward.name} --
                                </option>`;
                            WardForm.append(wardData);
                        });
                    }
                });
            }
        });

        // Sự kiện khi chọn Xã (Thêm đoạn này)
        WardForm.on('change', function () {
            let selectedOption = $(this).find('option:selected');
            let wardName = selectedOption.data('name');

            // Gán vào input ẩn xã
            WardNameHidden.val(wardName);
        });
    }
});