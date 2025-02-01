document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2
    document.querySelectorAll('.select2').forEach(select => {
        new TomSelect(select, {
            placeholder: "Pilih Role",
            allowClear: true,
            plugins: ['clear_button'],
            maxItems: 1
        });
    });

    // Modal instance
    const userModal = new bootstrap.Modal(document.getElementById('modal-add-user'));

    // Initialize search functionality
    const searchInput = document.querySelector('[data-search-user]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const userCards = document.querySelectorAll('.card');
            
            userCards.forEach(card => {
                const userName = card.querySelector('h3').textContent.toLowerCase();
                const userRole = card.querySelector('.text-muted').textContent.toLowerCase();
                
                if (userName.includes(searchTerm) || userRole.includes(searchTerm)) {
                    card.closest('.col-md-6').style.display = '';
                } else {
                    card.closest('.col-md-6').style.display = 'none';
                }
            });
        });
    }

    // Open modal on New User button click
    document.getElementById('btn-new-user').addEventListener('click', function() {
        document.getElementById('form-user').reset();
        $('.select2').val('').trigger('change'); // Reset Select2
        userModal.show();
    });

    // Handle form submission
    document.getElementById('form-user').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        try {
            const formData = new FormData(this);
            formData.set('isactive', document.querySelector('input[name="isactive"]').checked ? 1 : 0);
            
            const response = await fetch('/users', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    showConfirmButton: true,
                }).then(() => {
                    userModal.hide();
                    window.location.reload();
                });
            } else {
                if (data.errors) {
                    let errorMessage = '<ul class="list-unstyled">';
                    Object.values(data.errors).forEach(error => {
                        errorMessage += `<li>${error}</li>`;
                    });
                    errorMessage += '</ul>';

                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                        html: errorMessage
                    });
                } else {
                    throw new Error(data.message);
                }
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.message
            });
        }
    });

    // Edit user
    const UserManager = {
        editUser: async function(id) {
            try {
                const response = await fetch(`/users/${id}/edit`);
                const data = await response.json();
                
                if (response.ok) {
                    const editModal = document.getElementById('modal-edit-user');
                    editModal.addEventListener('hidden.bs.modal', function() {
                        cleanupModal();
                        const editForm = document.getElementById('edit-form');
                        editForm.reset();
                    });
                    const modalInstance = new bootstrap.Modal(editModal);
                    
                    // Set form action
                    const editForm = document.getElementById('edit-form');
                    editForm.setAttribute('action', `/users/${id}`);
                    
                    // Set existing values
                    document.getElementById('edit-name').value = data.name;
                    document.getElementById('edit-email').value = data.email;
                    document.getElementById('edit-username').value = data.username;
                    
                    const roleSelect = document.getElementById('edit-role');
                    if (roleSelect.tomselect) {
                        roleSelect.tomselect.setValue(data.role_id);
                    }
                    
                    document.getElementById('edit-phone').value = data.phone_number;
                    document.getElementById('edit-address').value = data.address;
                    document.getElementById('edit-status').checked = data.isactive == 1;
        
                    // Tampilkan current image jika ada
                    const currentImageDiv = document.getElementById('current-image');
                    if (data.image) {
                        currentImageDiv.innerHTML = `<img src="/storage/${data.image}" alt="Current Image" style="max-width: 100px;">`;
                    } else {
                        currentImageDiv.innerHTML = '';
                    }
        
                    // Form submission handler
                    editForm.onsubmit = async function(e) {
                        e.preventDefault();
                        
                        const formData = new FormData(this);
                        formData.set('isactive', document.getElementById('edit-status').checked ? 1 : 0);
        
                        const response = await fetch(this.getAttribute('action'), {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });
        
                        const result = await response.json();
        
                        if (result.status) {
                            modalInstance.hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: result.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: result.message,
                                confirmButtonText: 'Tutup'
                            });
                        }
                    };
        
                    modalInstance.show();
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message,
                    confirmButtonText: 'Tutup'
                });
            }
        },
        
        deleteUser: function(id) {
            Swal.fire({
                title: 'Hapus User?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/users/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });
        
                        const data = await response.json();
        
                        if (response.ok) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Gagal menghapus user');
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: error.message
                        });
                    }
                }
            });
        }
        
        
    };

function cleanupModal() {
    document.body.classList.remove('modal-open');
    const modalBackdrop = document.querySelector('.modal-backdrop');
    if (modalBackdrop) {
        modalBackdrop.remove();
    }
}

    // Make UserManager available globally
    window.UserManager = UserManager;
});
