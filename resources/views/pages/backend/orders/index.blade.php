@extends('layouts.backend.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header">
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
    </div>
  </div>
  <div class="card mt-2">
    <h5 class="card-header">Table Orders</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Car</th>
            <th class="text-white">Order Date</th>
            <th class="text-white">Pickup Date</th>
            <th class="text-white">Dropoff Date</th>
            <th class="text-white">Pickup Location</th>
            <th class="text-white">Dropoff Location</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $order->car->name }}</td>
            <td>{{ $order->order_date }}</td>
            <td>{{ Carbon\Carbon::parse($order->pickup_date)->format('d-F-Y') }}</td>
            <td>{{ Carbon\Carbon::parse($order->dropoff_date)->format('d-F-Y') }}</td>
            <td>{{ $order->pickup_location }}</td>
            <td>{{ $order->dropoff_location }}</td>
            <td>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $order->id }}">Edit</button>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Car</label>
            <select class="form-control" name="car_id" required>
              @foreach ($cars as $car)
              <option value="{{ $car->id }}">{{ $car->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Order Date</label>
            <input type="date" class="form-control" name="order_date" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Pickup Date</label>
            <input type="date" class="form-control" name="pickup_date" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Dropoff Date</label>
            <input type="date" class="form-control" name="dropoff_date" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Pickup Location</label>
            <input type="text" class="form-control" name="pickup_location" required value="Padang">
          </div>
          <div class="mb-3">
            <label class="form-label">Dropoff Location</label>
            <input type="text" class="form-control" name="dropoff_location" required value="Padang">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
@foreach($orders as $order)
<div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Car</label>
            <select class="form-control" name="car_id" required>
              @foreach ($cars as $car)
              <option value="{{ $car->id }}">{{ $car->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Order Date</label>
            <input type="date" class="form-control" name="order_date" value="{{ $order->order_date }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Pickup Date</label>
            <input type="date" class="form-control" name="pickup_date" value="{{ $order->pickup_date }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Dropoff Date</label>
            <input type="date" class="form-control" name="dropoff_date" value="{{ $order->dropoff_date }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Pickup Location</label>
            <input type="text" class="form-control" name="pickup_location" value="{{ $order->pickup_location }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Dropoff Location</label>
            <input type="text" class="form-control" name="dropoff_location" value="{{ $order->dropoff_location }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endsection