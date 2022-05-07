<!DOCTYPE html>
<html lang="en">
  <head>
      <style>
          label{
              display: inline-block;
              width: 200px;
          }
      </style>
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->

      @include('admin.sidebar')

      <!-- partial -->

      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->

        @include('admin.navbar')

        <!-- partial -->

        <!--main panel starts -->

        <div class="container-fluid page-body-wrapper">

            <div class="container justify-content-center mt-5 mb-5 pt-10">
                <form action="" method="POST">
                    <div class="pt-2 pb-2 mt-2">
                        <label for="name">Doctor Name</label>
                        <input type="text" style="color:black" name="name" placeholder="Enter Name" required>
                    </div>


                    <div class="pt-2 pb-2 mt-2">
                        <label for="phone">Phone</label>
                        <input type="number" style="color:black" name="phone" placeholder="Enter Phone" required>
                    </div>


                    <div class="pt-2 pb-2 mt-2">
                        <label for="speciality">Doctor Speciality</label>

                        <select style="color: black; width:200px;" name="speciality">
                            <option>---Select---</option>
                            <option value="skin">Skin</option>
                            <option value="heart">Heart</option>
                            <option value="eye">Eye</option>
                            <option value="skin">Skin</option>
                        </select>
                    </div>


                    <div class="pt-2 pb-2 mt-2">
                        <label for="room">Room</label>
                        <input type="text" style="color:black" name="room" placeholder="Enter Room Number" required>
                    </div>

                    <div class="pt-2 pb-2 mt-2">
                        <label for="image">Doctor Image</label>
                        <input type="file" name="image">
                    </div>

                    <div class="pt-2 pb-2 mt-2">
                        <input type="submit" class="btn btn-success">
                    </div>

                 </form>
            </div>


        </div>


        <!-- main-panel ends -->
      </div>

      <!-- page-body-wrapper ends -->
    </div>

    @include('admin.script')

  </body>
</html>















