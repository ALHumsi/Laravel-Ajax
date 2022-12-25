<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/assets')}}/fonts/all.css">
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <title> Home Page </title>
</head>
<body>
<h1 class="p-3">All Clients! <i class="fas fa-ad"></i></h1>


<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Add New Client</button>
            <hr>
        </div>
        <div class="col-sm-12">
            <h3 class="col alert alert-info text-center"> All Clients</h3>
            <table class="table">
                <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Position</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="cont-data">
                @foreach($data as $row)
                    <tr id="{{ $row->id }}" class="text-center">
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->position }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->mobile }}</td>
                        <td>
                            <button class="btn btn-info edit" data-route="{{ url('/edit-client/'.$row->id) }}"
                                    data-toggle="modal" data-target="#exampleModal2">Edit <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger delete" data-route="{{ url('/delete-client/'.$row->id) }}">
                                Delete <i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addClient">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="error" class="list-unstyled"></ul>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>


                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" name="position" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="number" name="mobile" class="form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save changes" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Update-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateClient">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="errorUpdate" class="list-unstyled"></ul>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <input type="hidden" id="id" name="id">
                    </div>


                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" id="position" name="position" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" id="mobile" name="mobile" class="form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save changes" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('/assets')}}/js/jquery-3.4.1.js"></script>
<script src="{{asset('/assets')}}/js/popper.min.js"></script>
<script src="{{asset('/assets')}}/js/bootstrap.min.js"></script>


<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#addClient").submit(function (e) {
        e.preventDefault();
        var formData = $("#addClient").serialize();
        $.ajax({
            url: "{{ url('/store') }}",
            type: "POST",
            data: formData,
            success: function (dataBack) {
                $("#error").html("<li class='alert alert-danger p-1'>Added Success</li>");
                $(".cont-data").prepend(dataBack)
                $("#exampleModal").modal('hide');
            }, error: function (xhr, status, error) {
                $("#error").html('');
                $.each(xhr.responseJSON.errors, function (key, item) {
                    $("#error").append("<li class='alert alert-danger text-center p-1'>" + item + "</li>");
                })
            }
        });
    });


    $(".edit").click(function () {
        var route = $(this).attr("data-route");

        $.ajax({
            url: route,
            type: "GET",
            dataType: 'JSON',
            success: function (dataBack) {
                $("#name").val(dataBack.name);
                $("#email").val(dataBack.email);
                $("#position").val(dataBack.position);
                $("#mobile").val(dataBack.mobile);
                $("#id").val(dataBack.id);
            }
        });
    })

    $("#updateClient").submit(function (e) {
        e.preventDefault();
        var formData = $("#updateClient").serialize();
        var rowId = $("#id").val();
        $.ajax({
            url: "{{ url('/update') }}",
            type: "POST",
            data: formData,
            success: function (dataBack) {
                $("#error").html("<li class='alert alert-success p-1'>Added Success</li>");
                $("#" + rowId).html(dataBack);
                $("#exampleModal2").modal('hide');
            }, error: function (xhr, status, error) {
                $("#error").html('');
                $.each(xhr.responseJSON.errors, function (key, item) {
                    $("#error").append("<li class='alert alert-danger text-center p-1'>" + item + "</li>");
                })
            }
        });
    });

    $(document).on('click', 'delete', function () {
        var route = $(this).attr("data-route");

        $.ajax({
            url: route,
            type: "GET",
            success: function (data) {
                alert(data.success);
                $("#" + data.id).remove();
            }
        })
    })

</script>


</body>
</html>
