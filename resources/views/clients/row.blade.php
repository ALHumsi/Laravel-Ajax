<tr id="{{ $row->id }}" class="text-center">
    <td>{{ $row->name }}</td>
    <td>{{ $row->position }}</td>
    <td>{{ $row->email }}</td>
    <td>{{ $row->mobile }}</td>
    <td>
        <button class="btn btn-info edit" data-route="" data-toggle="modal" data-target="#exampleModal2">Edit <i class="fa fa-edit"></i> </button>
        <button class="btn btn-danger delete" data-route="" >Delete <i class="fa fa-times"></i> </button>
    </td>
</tr>
