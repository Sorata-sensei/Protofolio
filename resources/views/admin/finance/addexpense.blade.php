@extends('admin.template.index')

@push('css')
    <style>
        /* Custom styles for select box */
        .custom-select {
            appearance: none;
            /* Remove default browser styles */
            -webkit-appearance: none;
            -moz-appearance: none;

            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            /* Matching Bootstrap border-radius */
            padding: 0.5rem 1rem;
            font-size: 1rem;
            color: #495057;
            cursor: pointer;

            /* Add down arrow icon */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='none' stroke='%23495057' stroke-width='.75' d='M0 0l2 2 2-2'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 8px 10px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        /* Focus state */
        .custom-select:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0.25);
        }

        /* Disabled state */
        .custom-select:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
            opacity: 1;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card p-4 shadow-sm">


            <form action="{{ route('admin.finance.addExpense') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12 col-md-6">
                    <label for="amount" class="form-label">Add Expense (Rupiah)</label>
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="example 1.000.000"
                        oninput="formatRupiah(this)" value="" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-select custom-select" required>
                        <option value="">-- Select Category --</option>
                        <option value="food">Food & Dining</option>
                        <option value="transportation">Transportation</option>
                        <option value="housing">Housing</option>
                        <option value="utilities">Utilities</option>
                        <option value="healthcare">Healthcare</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="education">Education</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-12 mt-1">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="e.g. buy some food"></textarea>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Add Expense</button>
                </div>
            </form>
        </div>
        <div class="card p-5 mt-3">
            <h2 class="mb-4">Funds List</h2>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Amount (Rupiah)</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($funds as $fund)
                        <tr>
                            <td>{{ $fund->id }}</td>
                            <td>{{ number_format($fund->amount, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($fund->category) }}</td>
                            <td>{{ $fund->description }}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-warning btn-sm edit-fund-btn"
                                    data-id="{{ $fund->id }}"
                                    data-amount="{{ number_format($fund->amount, 0, ',', '.') }}"
                                    data-category="{{ $fund->category }}"
                                    data-description="{{ $fund->description }}">Edit</a>
                                <a href="{{ url('/admin/finance/delete-finance/' . $fund->id) }}"
                                    class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Edit Expense Modal -->
        <div class="modal fade" id="editFundModal" tabindex="-1" aria-labelledby="editFundModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editFundForm" method="POST" action="{{ route('admin.finance.editExpense') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editFundModalLabel">Edit Expense</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="fund_id" id="editFundId" />
                            <div class="mb-3">
                                <label for="editAmount" class="form-label">Add Expense (Rupiah)</label>
                                <input type="text" class="form-control" id="editAmount" name="amount"
                                    placeholder="example 1.000.000" oninput="formatRupiah(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="editCategory" class="form-label">Category</label>
                                <select name="category" id="editCategory" class="form-select custom-select" required>
                                    <option value="">-- Select Category --</option>
                                    <option value="food">Food & Dining</option>
                                    <option value="transportation">Transportation</option>
                                    <option value="housing">Housing</option>
                                    <option value="utilities">Utilities</option>
                                    <option value="healthcare">Healthcare</option>
                                    <option value="entertainment">Entertainment</option>
                                    <option value="education">Education</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="editDescription" name="description" rows="3"
                                    placeholder="e.g. Salary from May"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            function formatRupiah(input) {
                let value = input.value.replace(/\D/g, '');
                let formatted = '';
                if (value.length > 0) {
                    formatted = new Intl.NumberFormat('id-ID').format(value);
                }
                input.value = formatted;
            }

            document.addEventListener('DOMContentLoaded', function() {
                var editFundModal = new bootstrap.Modal(document.getElementById('editFundModal'));

                document.querySelectorAll('.edit-fund-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        // Set hidden fund id input
                        document.getElementById('editFundId').value = this.dataset.id;

                        // Set amount (formatted)
                        document.getElementById('editAmount').value = this.dataset.amount;

                        // Set category select
                        document.getElementById('editCategory').value = this.dataset.category;

                        // Set description textarea
                        document.getElementById('editDescription').value = this.dataset.description;

                        // Show the modal
                        editFundModal.show();
                    });
                });
            });
        </script>
    @endpush
