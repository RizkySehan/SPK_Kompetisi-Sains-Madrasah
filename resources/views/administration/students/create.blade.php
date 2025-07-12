<!-- Modal Tambah Student -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('administration.students.store') }}" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="addStudentLabel">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3 text-start">
            <!-- Name -->
            <div class="col-md-6">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <!-- NISN -->
            <div class="col-md-6">
              <label for="nisn" class="form-label">NISN</label>
              <input type="text" class="form-control" id="nisn" name="nisn" required>
            </div>

            <!-- Tanggal Lahir -->
            <div class="col-md-6">
              <label for="tgl_lahir" class="form-label">Date of Birth</label>
              <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
            </div>

            <!-- Telepon -->
            <div class="col-md-6">
              <label for="tlp" class="form-label">Phone</label>
              <input type="text" class="form-control" id="tlp" name="tlp" required value="62">
            </div>

            <!-- Jenis Kelamin -->
            <div class="col-md-6">
              <label for="jk" class="form-label">Gender</label>
              <select class="form-select" id="jk" name="jk" required>
                <option value="">-- Select --</option>
                <option value="L">Man</option>
                <option value="P">Women</option>
              </select>
            </div>

            <!-- Kelas -->
            <div class="col-md-6">
              <label for="class" class="form-label">Class</label>
              <input type="text" class="form-control" id="class" name="class" required value="11">
            </div>

            <!-- Alamat -->
            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address')}}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
