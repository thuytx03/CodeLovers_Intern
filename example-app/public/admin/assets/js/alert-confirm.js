
function showDeleteConfirm(itemId,path) {
    //xoá mềm 1
    Swal.fire({
        title: 'Xác nhận xoá',
        text: 'Bạn có chắc chắn muốn xoá?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xoá',
        cancelButtonText: 'Hủy',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = path + itemId;
        }
    });
}

function showDeleteConfirmPermanently(itemId,path) {
    //xoá vĩnh viễn
    Swal.fire({
        title: 'Xác nhận xoá',
        text: 'Bạn có chắc chắn muốn xoá vĩnh viễn?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xoá',
        cancelButtonText: 'Hủy',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = path + itemId;
        }
    });
}


function confirmDelete() {
    Swal.fire({
        title: 'Xác nhận',
        text: 'Bạn có chắc chắn muốn xóa các mục đã chọn?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form
            document.getElementById('delete-form').submit();
        }
    });
}
function confirmRestore() {
    Swal.fire({
        title: 'Xác nhận',
        text: 'Bạn có chắc chắn muốn khôi phục các mục đã chọn?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Đống ý',
        cancelButtonText: 'Hủy',
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form
            document.getElementById('restore-form').submit();
        }
    });
}


