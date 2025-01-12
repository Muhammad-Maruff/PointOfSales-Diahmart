document.addEventListener('DOMContentLoaded', function() {
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
                    showConfirmButton: false,
                    timer: 1500
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
                    document.getElementById('edit-form').setAttribute('action', `/users/${id}`);
                    document.getElementById('edit-name').value = data.nama;
                    document.getElementById('edit-email').value = data.email;
                    document.getElementById('edit-username').value = data.username;
                    document.getElementById('edit-role').value = data.role_id;
                    document.getElementById('edit-status').checked = data.isactive;
                } else {
                    throw new Error('Failed to fetch user data');
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.message
                });
            }
        },

        deleteUser: function(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/users/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        const data = await response.json();

                        if (response.ok) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Failed to delete user');
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.message
                        });
                    }
                }
            });
        }
    };

    // Make UserManager available globally
    window.UserManager = UserManager;
});
