<div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editStudentModalLabel{{ $student->id }}">Edit Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <form action="{{ route('administration.students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3 text-start">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NISN</label>
                            <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $student->nisn) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $student->tgl_lahir) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="tlp" class="form-control" value="{{ old('tlp', $student->tlp) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="jk" class="form-select" required>
                                <option value="L" {{ $student->jk === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $student->jk === 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Class</label>
                            <input type="text" name="class" class="form-control" value="{{ old('class', $student->class) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3" required>{{ old('address', $student->address) }}</textarea>
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
