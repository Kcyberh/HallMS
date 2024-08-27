<x-adminlayout>
<div>
    <h2>Complaints</h2>
    @if($complaints->isEmpty())
        <p>No complaints yet.</p>
    @else
    <div class="table-responsive">
        <table id="myTable" class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                <th>Name</th>
                    <th>Time and Date</th>
                    <th>Statement</th>
                    <th>Reply</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                    <tr>
                    <td>{{ $complaint->user->name ?? 'N/A' }}</td> 
                        <td>{{ \Carbon\Carbon::parse($complaint->time_date)->format('Y-m-d H:i') }}</td>
                        <td>{{ $complaint->statement }}</td>
                        <td>
                            @if($complaint->reply)
                                {{ $complaint->reply }}
                            @else
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal" data-id="{{ $complaint->id }}">Reply</button>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $complaint->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                {{ ucfirst($complaint->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Show</a>
                            <form action="{{ route('complain.destroy', $complaint->id) }}" method="POST" style="display:inline;">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="replyForm" action="{{ route('complain.update', 'complain_id') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply to Complaint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="complain_id" id="complain_id">
                    <div class="mb-3">
                        <label for="reply" class="form-label">Reply</label>
                        <textarea name="reply" id="reply" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fill the modal with complaint data when the reply button is clicked
    var replyModal = document.getElementById('replyModal')
    replyModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var complainId = button.getAttribute('data-id')

        var modalBodyInput = replyModal.querySelector('.modal-body #reply')
        var modalForm = replyModal.querySelector('form')
        modalForm.action = modalForm.action.replace('complain_id', complainId)
        document.getElementById('complain_id').value = complainId
    })
</script>
</x-adminlayout>