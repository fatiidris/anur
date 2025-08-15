@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
            Collect Fees 
            <span style="color: blue;">({{ $getStudent->name }} {{ $getStudent->last_name }})</span>
          </h1>
        </div>
        <div class="col-sm-6 text-right">
          <button type="button" class="btn btn-primary" id="AddFees">Add Fees</button>
        </div>
      </div>
    </div>
  </section>

  @include('_message')

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Payment Details</h3>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Class Name</th>
            <th>Total Amount</th>
            <th>Paid Amount</th>
            <th>Remaining Amount</th>
            <th>Payment Type</th>
            <th>Remark</th>
            <th>Created By</th>
            <th>Created Date</th>
          </tr>
        </thead>
        <tbody>
          @forelse($getFees as $value)
            <tr>
              <td>{{ $value->class_name }}</td>
              <td>₦{{ number_format($value->total_amount, 2) }}</td>
              <td>₦{{ number_format($value->paid_amount, 2) }}</td>
              <td>₦{{ number_format($value->remaining_amount, 2) }}</td>
              <td>{{ ucfirst($value->payment_type) }}</td>
              <td>{{ $value->remark }}</td>
              <td>{{ $value->created_name }}</td>
              <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="100%">Record not Found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Fees Modal -->
<div class="modal fade" id="AddFeesModal" tabindex="-1" role="dialog" aria-labelledby="AddFeesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ url('admin/fees_collection/add_collect_fees/' . $getStudent->id) }}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddFeesModalLabel">Add Fees</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>Class Name: {{ $getStudent->class_name }}</label>
          </div>
          <div class="form-group">
            <label>Total Amount: ₦{{ number_format($getStudent->amount, 2) }}</label>
          </div>
          <div class="form-group">
            <label>Paid Amount: ₦{{ number_format($paid_amount, 2) }}</label>
          </div>
          @php
            $RemainingAmount = $getStudent->amount - $paid_amount;
          @endphp
          <div class="form-group">
            <label>Remaining Amount: ₦{{ number_format($RemainingAmount, 2) }}</label>
          </div>

          <div class="form-group">
            <label>Amount <span class="text-danger">*</span></label>
            <input type="number" name="amount" class="form-control" min="1" required>
          </div>

          <div class="form-group">
            <label>Payment Type <span class="text-danger">*</span></label>
            <select class="form-control" name="payment_type" required>
              <option value="">Select</option>
              <option value="cash">Cash</option>
              <option value="cheque">Cheque</option>
            </select>
          </div>

          <div class="form-group">
            <label>Remark</label>
            <textarea name="remark" class="form-control" rows="2"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $('#AddFees').click(function () {
    $('#AddFeesModal').modal('show');
  });
</script>
@endsection
