new DataTable('#example');


$(document).ready(function () {
    $('.status-dropdown').change(function () {
        var uid = $(this).data('uid');
        var status = $(this).val();

        // ใช้ Ajax ส่งข้อมูลไปยังไฟล์ update_data.php
        $.ajax({
            url: 'update_data.php',
            method: 'POST',
            data: { uid: uid, status: status },
            success: function (response) {
                // ปรับปรุง UI หรือทำอย่างอื่นตามต้องการ
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var recid = this.getAttribute('data-recid');
            var userUid = this.getAttribute('data-user-uid');

            Swal.fire({
                title: 'แน่ใจหรอ?',
                text: 'ต้องการลบจริงๆหรอออ!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete.php with recid and user_uid parameters after confirmation
                    window.location.href = 'delete.php?recid=' + recid + '&user_uid=' + userUid;
                }
            });
        });
    });
});
function changeColor(elementId) {
    var element = document.getElementById(elementId);

    // Check if the button is already green
    var isGreen = element.style.color === "green";

    // Toggle the color between green and black
    element.style.color = isGreen ? "black" : "green";

    // Get the clicked buttons array from Local Storage
    var clickedButtons = JSON.parse(localStorage.getItem("clickedButtons")) || [];

    // Add or remove the current button ID from the array based on the current color
    if (isGreen) {
        var index = clickedButtons.indexOf(elementId);
        if (index !== -1) {
            clickedButtons.splice(index, 1);
        }
    } else {
        clickedButtons.push(elementId);
    }

    // Save the updated array back to Local Storage
    localStorage.setItem("clickedButtons", JSON.stringify(clickedButtons));
}

// Apply the green color to all buttons that were previously clicked
var clickedButtons = JSON.parse(localStorage.getItem("clickedButtons")) || [];
for (var i = 0; i < clickedButtons.length; i++) {
    var clickedElement = document.getElementById(clickedButtons[i]);
    if (clickedElement) {
        clickedElement.style.color = "green";
    }
}


document.addEventListener('DOMContentLoaded', function () {
    // Get references to the loan_amount and interest_rate input fields
    var loanAmountInput = document.querySelector('input[name="loan_amount"]');
    var interestRateInput = document.querySelector('input[name="interest_rate"]');

    // Add an event listener to the loan_amount input field
    loanAmountInput.addEventListener('input', function () {
        // Get the value of the loan_amount input field
        var loanAmountValue = parseFloat(loanAmountInput.value);

        // Check if the entered value is a valid number
        if (!isNaN(loanAmountValue)) {
            // Calculate 20% of the loan amount
            var interestRateValue = (loanAmountValue * 0.2).toFixed(2);

            // Update the interest_rate input field with the calculated value
            interestRateInput.value = interestRateValue;
        } else {
            // Clear the interest_rate input field if the entered value is not a valid number
            interestRateInput.value = '';
        }
    });
});


function deleteCard(inid) {
    if (confirm("คุณแน่ใจหรือไม่ที่จะลบ card นี้?")) {
        // ทำการลบข้อมูลจากฐานข้อมูล ในที่นี้คือการเรียกไปยังไฟล์ PHP ที่ทำหน้าที่ลบข้อมูล
        // ส่งไปยังไฟล์ PHP ที่จะทำการลบข้อมูลตาม inid
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // หลังจากที่ได้รับการตอบกลับจากไฟล์ PHP (ถ้ามี)
                // คุณสามารถทำอะไรก็ตามที่คุณต้องการหลังจากการลบข้อมูล
                // เช่น รีเฟรชหน้าเว็บหรือทำอื่น ๆ
                location.reload(); // ตัวอย่างการรีเฟรชหน้าเว็บ
            }
        };
        xhr.open("GET", "delete_card.php?inid=" + inid, true);
        xhr.send();
    }
}


function openEditModal() {
    // Fetch user data via AJAX and populate the form
    $.get('get_user_data.php', function (data) {
        // Assume data is a JSON object with user details
        var user = JSON.parse(data);
        $('#pid').val(user.pid);
        $('#fname').val(user.fname);
        $('#cardid').val(user.cardid);
        $('#address_line1').val(user.address_line1);
        $('#address_line2').val(user.address_line2);
        $('#city').val(user.city);
        $('#province').val(user.province);
        $('#postal_code').val(user.postal_code);

        $('#editModal').show();
    });
}

function closeEditModal() {
    $('#editModal').hide();
}

function saveUserData() {
    var formData = $('#editForm').serialize();

    // Send data to the server for processing
    $.post('save_user_data.php', formData, function (response) {
        // Handle response (success or error)
        console.log(response);
        // You can update the table or show a message to the user
        closeEditModal();
    });
}


$(document).ready(function () {
    $('.add-days-btn').on('click', function () {
        var recid = $(this).data('recid');

        // Send AJAX request to update recovery_date
        $.ajax({
            type: 'POST',
            url: 'update_recovery_date.php',
            data: { recid: recid }, // Use recid instead of userUid
            success: function (response) {
                if (response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'เพิ่มวันให้แล้วน้าาาา!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Updating Recovery Date',
                        text: 'An error occurred while updating the recovery date.',
                    });
                }
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.',
                });
            }
        });
    });
});
$(document).ready(function () {
    $('.save-btn').click(function () {
        // ดึงค่า uid จากปุ่มที่ถูกคลิก
        var recid = $(this).data('recid');

        // ส่งข้อมูลไปบันทึกผ่าน Ajax
        $.ajax({
            url: 'save_recovery_date.php', // แก้ไขตามชื่อไฟล์ที่จะสร้างไว้เพื่อจัดการการบันทึก
            method: 'POST',
            data: { recid: recid },
            success: function (response) {
                // หากบันทึกสำเร็จ ทำการอัพเดทตารางหรือแจ้งเตือนตามต้องการ
                Swal.fire({
                    icon: 'success',
                    title: 'ขอบคุณที่จ่ายครบ!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    location.reload(); // อัพเดทหน้า
                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error saving data',
                    showConfirmButton: true
                });
            }
        });
    });
});
$(document).ready(function () {
    $('.savein-btn').click(function () {
        // ดึงค่า uid จากปุ่มที่ถูกคลิก
        var inid = $(this).data('inid');

        // ส่งข้อมูลไปบันทึกผ่าน Ajax
        $.ajax({
            url: 'save_in_date.php', // แก้ไขตามชื่อไฟล์ที่จะสร้างไว้เพื่อจัดการการบันทึก
            method: 'POST',
            data: { inid: inid },
            success: function (response) {
                // หากบันทึกสำเร็จ ทำการอัพเดทตารางหรือแจ้งเตือนตามต้องการ
                Swal.fire({
                    icon: 'success',
                    title: 'ขอบคุณที่จ่ายครบ!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    location.reload(); // อัพเดทหน้า
                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error saving data',
                    showConfirmButton: true
                });
            }
        });
    });
});
$(document).ready(function () {
    $('.savemount-btn').click(function () {
        // ดึงค่า uid จากปุ่มที่ถูกคลิก
        var inid = $(this).data('inid');

        // ส่งข้อมูลไปบันทึกผ่าน Ajax
        $.ajax({
            url: 'save_in_mount.php', // แก้ไขตามชื่อไฟล์ที่จะสร้างไว้เพื่อจัดการการบันทึก
            method: 'POST',
            data: { inid: inid },
            success: function (response) {
                // หากบันทึกสำเร็จ ทำการอัพเดทตารางหรือแจ้งเตือนตามต้องการ
                Swal.fire({
                    icon: 'success',
                    title: 'ขอบคุณที่จ่ายครบ!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    location.reload(); // อัพเดทหน้า
                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error saving data',
                    showConfirmButton: true
                });
            }
        });
    });
});



function openEditPage(recid, userUid) {
    // สร้าง URL ที่ต้องการเปิด
    var editPageUrl = 'get_re.php?recid=' + recid + '&user_uid=' + userUid;

    // นำทางไปยังหน้าแก้ไข
    window.location.href = editPageUrl;
}
function redirectToHistory(uid) {
    window.location.href = 'historyre.php?uid=' + uid;
}