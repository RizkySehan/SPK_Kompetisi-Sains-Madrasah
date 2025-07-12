<div class="modal fade" id="editCriteriaModal{{ $criteria->id }}" tabindex="-1" aria-labelledby="editCriteriaModalLabel{{ $criteria->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editCriteriaModalLabel{{ $criteria->id }}">Edit Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="{{ route('administration.criterias.update', $criteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3 text-start">
                        <!-- Code -->
                        <div class="col-md-6">
                            <label class="form-label">Criteria Code</label>
                            <input type="text" name="code" class="form-control" value="{{ $criteria->code }}" required>
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label">Criteria Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $criteria->name }}" required>
                        </div>

                        <!-- bobot -->
                        <div class="col-md-6">
                            <label class="form-label">Weight (%)</label>
                            <input type="number" name="bobot" class="form-control" value="{{ $criteria->bobot }}" min="1" max="100" required>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6">
                            <label class="form-label">Weight Type</label>
                            <select name="type" class="form-select" required>
                                <option value="benefit" {{ $criteria->type === 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost" {{ $criteria->type === 'cost' ? 'selected' : '' }}>Cost</option>
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
