<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="{{ route('administration.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3 text-start">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password <small class="text-muted">(Empty if not replaced)</small></label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select">
                                    <option value="administration" {{ $user->role === 'administration' ? 'selected' : '' }}>Administration</option>
                                    <option value="homeroom-teacher" {{ $user->role === 'homeroom-teacher' ? 'selected' : '' }}>Homeroom Teacher</option>
                                    <option value="headmaster" {{ $user->role === 'headmaster' ? 'selected' : '' }}>Headmaster</option>
                                    <option value="ksm-teacher" {{ $user->role === 'ksm-teacher' ? 'selected' : '' }}>KSM Teacher</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>