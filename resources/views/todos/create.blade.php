@guest

<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header text-center ">
                    <h5 class="font-weight-bolder">Welcome to To Do Smart</h5>
                </div>
                <div class="text-lg-center m-5">
                    <b>Please register or login to create new Notes!</b>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-10">
            <div class="card ">
                <div class="card-header text-center">
                    <b>Create a note</b>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="store-data" method="post" class="p-4">
                    @csrf
                    <div class="form-group m-3">
                        <label for="title">Todo Name</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group m-3">
                        <label for="date">Todo Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="container">
                        <label for="name">Note Color</label>
                        <div id="cp2" class="input-group colorpicker colorpicker-component">

                            <input type="text" value="#00AABB" class="form-control"  name="color"/>

                            <span class="input-group-addon"><i style="padding: 18.5px; margin-top:-1.7px;"></i></span>

                        </div>
                    </div>
                    <div class="form-group m-3">
                        <label for="content">Todo Description</label>
                        <textarea class="form-control" name="content" rows="3" required></textarea>
                    </div>
                    <div class="form-group m-3 text-center">
                        <input type="submit" class="btn btn-primary float-end" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.colorpicker').colorpicker();
</script>
@endguest
