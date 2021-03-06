@extends('admin.home')

@section('content')

    <div class="container justify-content-center mt-5 mb-5 pt-10">
        <h2 class="text-center mt-3 mb-2 pd-3">--SHOW DOCTORS--</h2>
        <hr>
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="mt-2 mb-2 pd-3">
            <div class="input-group mt-2 mb-2 pd-2">
                <input type="search" id="search" name="search" class="form-control rounded" placeholder="Search" style="color: white;" />
                <button type="button" class="btn btn-outline-primary">search</button>
            </div>
        </div>

        <table class="table table-dark" style="color: rgb(142, 217, 255);">
            <thead>
              <tr style="background-color: skyblue">
                <th style="color: white; font-size: 18px;">Id</th>
                <th style="color: white; font-size: 18px;">Doctor Name</th>
                <th style="color: white; font-size: 18px;">Phone</th>
                <th style="color: white; font-size: 18px;">Speciality</th>
                <th style="color: white; font-size: 18px;">Room</th>
                <th style="color: white; font-size: 18px;">Image</th>
                <th style="color: white; font-size: 18px;">Edit</th>
                <th style="color: white; font-size: 18px;">Delete</th>

              </tr>
            </thead>
            <tbody id="table-body" class="mainbody">
              @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->id }}</td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>{{ $doctor->speciality }}</td>
                    <td>{{ $doctor->room }}</td>
                    <td>
                        <img src="{{ asset($doctor->image) }}" height="200px;" width="200px;" alt="">
                    </td>
                    <td>
                         <a class="btn btn-success" href="{{ route('doctor.edit', $doctor->id) }}">Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Are You Sure Want to Delete This Doctor ?')" href="{{ route('doctor.delete', $doctor->id) }}">Delete</a>
                   </td>

                </tr>
              @endforeach
            </tbody>
          </table>

    </div>


    {{-- Live Search Features Added With Ajax --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>


<script>

    $(document).ready(function () {
        $('#search').on('keyup', function(){
            var value = $(this).val();
            $.ajax({
                type: "get",
                url: "/search-doctor",
                data: {'search':value},
                success: function (data) {
                    $('.mainbody').html(data);
                }
            });

        });
    });

</script>



@endsection







