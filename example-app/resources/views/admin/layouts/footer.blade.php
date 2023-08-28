<!-- Footer -->
<footer class="content-footer footer bg-footer-theme mt-5">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            , made with ❤️ by
            <a href="#" target="_blank" class="footer-link fw-bolder">Trinh Xuan Thuy</a>
        </div>
        <div>
            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank"
                class="footer-link me-4">Documentation</a>

            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                class="footer-link me-4">Support</a>
        </div>
    </div>
</footer>
<!-- / Footer -->
<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->



<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('admin/assets/js/main.js') }}"></script>
<script src="{{ asset('admin/assets/js/alert-confirm.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('admin/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('admin/assets/js/extended-ui-perfect-scrollbar.js') }}"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace('description');
</script>
<script>
    $(document).ready(function() {
        $('#cover_image').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#images').change(function() {
            $('.image-preview').remove();
            var files = $('#images')[0].files;
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imagePreview = $('<img style="max-width: 200px; border-radius:5px; height:150px; margin:10px">').attr('src', e.target.result).addClass(
                        'image-preview');
                    $('.image-container').append(imagePreview);
                }
                reader.readAsDataURL(files[i]);
            }
        });
    });
</script>




<script>
    // Lấy thẻ input có id "select_all_ids"
    const selectAllIds = document.getElementById('select_all_ids');

    // Lấy danh sách tất cả các input checkbox cần chọn
    const checkboxes = document.querySelectorAll('input[name^="ids"]');

    // Thêm sự kiện "click" vào input checkbox có id "select_all_ids"
    selectAllIds.addEventListener('click', function() {
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllIds.checked;
        });

        // Kiểm tra nếu có ít nhất một checkbox được chọn
        if (document.querySelector('input[name^="ids"]:checked')) {
            // Bỏ khóa nút "Xoá các mục chọn"
            document.querySelector('input[type="submit"]').disabled = false;
        } else {
            // Khóa nút "Xoá các mục chọn"
            document.querySelector('input[type="submit"]').disabled = true;
        }
    });

    // Thêm sự kiện "click" vào tất cả các input checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function() {
            // Kiểm tra nếu có ít nhất một checkbox được chọn
            if (document.querySelector('input[name^="ids"]:checked')) {
                // Bỏ khóa nút "Xoá các mục chọn"
                document.querySelector('input[type="submit"]').disabled = false;
            } else {
                // Khóa nút "Xoá các mục chọn"
                document.querySelector('input[type="submit"]').disabled = true;
            }
        });
    });
</script>
{{-- <script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace('content');
</script> --}}

<script>
    var editor = CKEDITOR.replace('content');
    CKFinder.setupCKEditor(editor);
</script>

<script>
    $(document).ready(function() {
        $('#image').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>
