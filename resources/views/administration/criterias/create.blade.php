<!-- Modal Tambah Kriteria -->
<div class="modal fade" id="addCriteriaModal" tabindex="-1" aria-labelledby="addCriteriaLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('administration.criterias.store') }}" method="POST" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="addCriteriaLabel">Add Criteria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3 text-start">

            <!-- Kode Kriteria -->
            <div class="col-md-6">
              <label for="code" class="form-label">Criteria Code (C1, C2, ...)</label>
              <input type="text" class="form-control" id="code" name="code" required>
            </div>

            <!-- Nama Kriteria -->
            <div class="col-md-6">
              <label for="name" class="form-label">Criteria Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <!-- Bobot -->
            <div class="col-md-6">
              <label for="bobot" class="form-label">Weight (%)</label>
              <input type="number" class="form-control" id="bobot" name="bobot" min="0" max="100" step="0.01" required>
            </div>

            <!-- Tipe Bobot -->
            <div class="col-md-6">
              <label for="type" class="form-label">Weight Type</label>
              <select class="form-select" id="type" name="type" required>
                <option value="">-- Select --</option>
                <option value="benefit">Benefit</option>
                <option value="cost">Cost</option>
              </select>
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
