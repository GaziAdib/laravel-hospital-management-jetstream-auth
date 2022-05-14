@extends('admin.home')

@section('content')


    <div class="container justify-content-center mt-5 mb-5 pt-10">

        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif



        <h2 class="text-center mt-4 mb-4 pd-4">Show Appointments</h2>
        <hr>

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
                  <th style="color: white; font-size: 18px;">Customer Name</th>
                  <th style="color: white; font-size: 18px;">Email</th>
                  <th style="color: white; font-size: 18px;">Phone</th>
                  <th style="color: white; font-size: 18px;">Doctor</th>
                  <th style="color: white; font-size: 18px;">Date</th>
                  <th style="color: white; font-size: 18px;">Message</th>
                  <th style="color: white; font-size: 18px;">-Status-</th>
                  <th style="color: white; font-size: 18px;">Approved</th>
                  <th style="color: white; font-size: 18px;">Cancelled</th>
                  <th style="color: white; font-size: 18px;">Send Mail</th>
                </tr>
              </thead>
              <tbody id="table-body" class="mainbody">
                @foreach ($appointments as $appoint)
                  <tr>
                      <td>{{ $appoint->id }}</td>
                      <td>{{ $appoint->name }}</td>
                      <td>{{ $appoint->email }}</td>
                      <td>{{ $appoint->phone }}</td>
                      <td>{{ $appoint->doctor }}</td>
                      <td>{{ $appoint->date }}</td>
                      <td>{{ substr($appoint->message, 0, 20) }}...</td>
                      <td class="text-primary text-bold"><b>{{ $appoint->status }}</b></td>
                      <td>
                           <a class="btn btn-success" href="{{ route('appoint.approve', $appoint->id) }}">Approved</a>
                      </td>
                      <td>
                        <a class="btn btn-danger" href="{{ route('appoint.cancel', $appoint->id) }}">Canceled</a>
                     </td>

                     <td>
                        <a class="btn btn-primary" href="{{ route('email.view', $appoint->id) }}">Send Mail</a>
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
                url: "/search-appointment",
                data: {'search':value},
                success: function (data) {
                    $('.mainbody').html(data);
                }
            });

        });
    });

</script>



@endsection




