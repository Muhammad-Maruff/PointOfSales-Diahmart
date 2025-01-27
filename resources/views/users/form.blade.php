<!-- Add User Modal -->
<div class="modal modal-blur fade" id="modal-add-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <form id="form-user">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close" autocomplete="off" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="mb-3">
                        <label class="form-label required">Nama</label>
                        <input type="text" class="form-control" autocomplete="off" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Username</label>
                        <input type="text" class="form-control" autocomplete="off" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <input type="email" class="form-control" autocomplete="off" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Role</label>
                        <select class="form-select select2" name="role_id" required>
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Nomor Telepon</label>
                        <input type="number" class="form-control" autocomplete="off" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Alamat</label>
                        <textarea class="form-control" name="address" rows="3" required></textarea>
                    </div>                    
                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="isactive" checked>
                            <span class="form-check-label">Active</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer d-flex gap-3">
                    <button type="submit" class="btn btn-save" id="btn-save">
                        <i class="ti ti-device-floppy"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit User Modal -->
<div class="modal modal-blur fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="mb-3">
                        <label class="form-label required">Nama</label>
                        <input type="text" class="form-control" name="name" id="edit-name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Username</label>
                        <input type="text" class="form-control" name="username" id="edit-username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <input type="email" class="form-control" name="email" id="edit-email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Role</label>
                        <select class="form-select select2" name="role_id" id="edit-role" required>
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Nomor Telepon</label>
                        <input type="number" class="form-control" name="phone_number" id="edit-phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Alamat</label>
                        <textarea class="form-control" name="address" id="edit-address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="isactive" id="edit-status" checked>
                            <span class="form-check-label">Active</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer d-flex gap-3">
                    <button type="submit" class="btn btn-save">
                        <i class="ti ti-device-floppy"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
