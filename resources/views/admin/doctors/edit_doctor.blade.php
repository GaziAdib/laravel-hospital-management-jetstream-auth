@extends('admin.home')

@section('content')
<style>
    label{
        display: inline-block;
        width: 200px;
    }
</style>

    <div class="container justify-content-center mt-5 mb-5 pt-10">
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <h2>---Update Doctor---</h2>
        <hr>

        <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="pt-2 pb-2 mt-2">
                <label for="name">Doctor Name</label>
                <input type="text" style="color:black" name="name" value="{{ $doctor->name }}" placeholder="Enter Name" required>
            </div>


            <div class="pt-2 pb-2 mt-2">
                <label for="phone">Phone</label>
                <input type="number" style="color:black" name="phone" value="{{ $doctor->phone }}" placeholder="Enter Phone" required>
            </div>


            <div class="pt-2 pb-2 mt-2">
                <label for="speciality">Doctor Speciality</label>
                <select style="color: black; width:200px;" name="speciality">
                    @php
                        $alldoctors = DB::table('doctors')->get();
                    @endphp
                    @foreach ($alldoctors as $row)
                        <option value="{{ $row->speciality }}" @if($doctor->id==$row->id) selected @endif>{{ $row->speciality }}</option>
                    @endforeach
                </select>
            </div>


            <div class="pt-2 pb-2 mt-2">
                <label for="room">Room</label>
                <input type="text" style="color:black" name="room" value="{{ $doctor->room }}" placeholder="Enter Room Number" required>
            </div>

            <div class="pt-2 pb-2 mt-2">
                <label for="image">Old Image--></label>
                <img src="{{ asset($doctor->image) }}" height="200px" width="225px" alt="{{ $doctor->name }}">
            </div>

            <div class="pt-2 pb-2 mt-2">
                <label for="image">Change Image</label>
                <input type="file" name="image">
            </div>

            <div class="pt-2 pb-2 mt-2">
                <input type="submit" class="btn btn-success">
            </div>

         </form>
    </div>


@endsection






