<x-studentlayout>
<div class="container">
    <h1 class="my-4">Complaint Details</h1>

    <div class="card {{ $complain->status == 'pending' ? 'border-warning' : 'border-success' }} shadow-sm">
        <div class="card-body">
            <p><strong>Time and Date:</strong> {{ $complain->time_date }}</p>
            <p><strong>Statement:</strong> {{ $complain->statement }}</p>

            <!-- Status with Conditional Styling -->
            <p><strong>Status:</strong>
                <span class="badge {{ $complain->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                    {{ ucfirst($complain->status) }}
                </span>
            </p>

            <!-- Reply Section -->
            @if($complain->reply)
                <div class="mt-4 p-3 border rounded bg-light">
                    <h5 class="mb-3">Manager's Reply</h5>
                    <p>{{ $complain->reply }}</p>
                </div>
            @else
                <p class="mt-4 text-muted">No reply from the manager yet.</p>
            @endif
        </div>
    </div>

    <!-- Back to List Button with Hover Effect -->
    <a href="{{ route('complain.index') }}" class="btn btn-secondary mt-3" style="transition: background-color 0.3s ease;">
        Back to List
    </a>
</div>

<style>
    /* app.scss or a separate CSS file */
.btn-secondary {
    transition: background-color 0.3s ease;
}

.btn-secondary:hover {
    background-color: #6c757d; /* Adjust color as needed */
}
</style>
</x-studentlayout>