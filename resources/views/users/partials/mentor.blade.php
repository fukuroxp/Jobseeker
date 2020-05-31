<table class="table table-striped datatable">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $value)
            <tr>
                <td>{{ $value->nomor_induk ?? '-' }}</td>
                <td>{{ $value->name ?? '' }}</td>
                <td>{{ $value->email ?? '' }}</td>
                <td>
                    <div class="chip chip-primary">
                        <div class="chip-body">
                            <div class="chip-text">{{ $value->jabatan ?? '' }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $value->address ?? '' }}</td>
                <td>
                    @if (auth()->user()->id != $value->id)
                        <span class="btn-modal" style="cursor: pointer;" data-href="{{ route('users.edit', [$value->id]) }}"><i class="feather icon-edit" title="Edit"></i></span>
                        <span class="action-delete" style="cursor: pointer;" data-href="{{ route('users.destroy', [$value->id]) }}"><i class="feather icon-trash" title="Delete"></i></span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>