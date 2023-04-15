{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.app')

@section('page-title', __('Sub Locations') )



@section('content')
    <div class="row">
        <div class="d-flex justify-content-center">
            <div class="card p-4 w-50">
                <form method="post">
                    @csrf
                    <label>Enter new Sub location in {{$location->name}}</label>
                    <input type="text" class="form-control" name="name">
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-primary btn-sm">Add Sub location</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card p-3">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sub Location</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subLocations as $key=>$location)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td class="editable-cell">{{$location->name}}</td>
                        <td hidden class="editable-key">{{$location->id}}</td>
                        <td>
                            <div class="action-btn btn-danger ms-2">
                                <a href="{{route('delete.sublocation',$location->id)}}"   class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-bs-toggle="tooltip"  data-title="Delete"   title="Delete"><i class="ti ti-trash text-white"></i></a>
                            </div>
                            <div class="action-btn btn-warning ms-2">
                                <button href="#"  class="mx-3 btn btn-sm d-inline-flex align-items-center edit-btn"  data-bs-toggle="tooltip"  data-title="Edit"   title="Edit"><i class="ti ti-pencil text-white"></i></button>
                            </div>

                        </td>

                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function() {
            // Find the edit button and attach a click event listener to it
            $('.edit-btn').click(function() {
                // Find the table row that contains the edit button
                var row = $(this).closest('tr');


                // Find the cell that needs to be edited and replace it with an input box
                var cell = row.find('.editable-cell');
                var id = row.find('.editable-key').text();
                var currentValue = cell.text();
                cell.html('<input type="text"  value="' + currentValue + '">');
                // Add an update button in front of the input box
                var updateBtn = $('<button type="button" class="btn btn-primary btn-sm update-btn">Update</button>');
                cell.prepend(updateBtn);
                // Attach a click event listener to the update button
                updateBtn.click(function() {
                    // Get the new value from the input box and update the cell
                    var newValue = cell.find('input').val();
                    cell.text(newValue);
                    // console.log(id);

                    // Remove the update button
                    updateBtn.remove();

                    $.ajax({
                        url: 'update-sublocation/'+id,
                        method: 'POST',
                        data: { name: newValue, id: id },
                        success: function(response) {
                            // Handle success response
                        },
                        error: function(xhr) {
                            // Handle error response
                        }
                    });
                });
            });
        });
    </script>

@endpush

