// Fungsi untuk menampilkan alert
function showLoginAlert(status, message) {
    Swal.fire({
        icon: status === 'success' ? 'success' : 'error',
        title: status === 'success' ? 'Success!' : 'Failed!',
        text: message
    });
}

// Inisialisasi saat DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Cek data alert dari meta tags
    const alertStatus = document.querySelector('meta[name="alert-status"]')?.content;
    const alertMessage = document.querySelector('meta[name="alert-message"]')?.content;
    
    if (alertStatus && alertMessage) {
        showLoginAlert(alertStatus, alertMessage);
    }
});
