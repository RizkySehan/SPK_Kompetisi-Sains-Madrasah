<!-- Modal Input Nilai -->
<div class="modal fade" id="inputScoreModal{{ $student->id }}" tabindex="-1" aria-labelledby="inputScoreModalLabel{{ $student->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('homeroom-teacher.scores.store') }}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student->id }}">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="inputScoreModalLabel{{ $student->id }}">
                    Input Score – {{ $student->name }} ({{ $student->nisn }})
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    @foreach ($criterias as $criteria)
                        <div class="mb-3 col-md-6 text-start">
                            <label class="form-label fw-semibold">{{ $criteria->name }}</label>

                            @if ($criteria->code === 'C5')
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label">Alpha</label>
                                        <input type="number" name="attendance[alpha]" class="form-control" min="0" value="0">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Izin</label>
                                        <input type="number" name="attendance[izin]" class="form-control" min="0" value="0">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Sakit</label>
                                        <input type="number" name="attendance[sakit]" class="form-control" min="0" value="0">
                                    </div>
                                </div>
                                <small class="text-muted d-block mt-1">Values are calculated automatically (max 30): Alpha×3 + Izin×2 + Sakit×1</small>
                                {{-- Tidak perlu input value langsung, karena akan dihitung di controller --}}
                            @elseif (in_array($criteria->code, ['C3', 'C4']))
                                <input type="number" min="1" max="4" step="1"
                                    name="scores[{{ $criteria->id }}]" class="form-control" required>
                                <small class="text-muted">Scale value between 1 and 4</small>
                            @else
                                <input type="number" step="0.01" min="0" max="100"
                                    name="scores[{{ $criteria->id }}]" class="form-control" required>
                            @endif

                            @error("scores.{$criteria->id}")
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i>Save</button>
            </div>
        </form>
    </div>
</div>
