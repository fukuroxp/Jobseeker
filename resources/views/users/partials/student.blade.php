<table class="table table-striped datatable">
    <thead>
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Email</th>
            <th>HP</th>
            <th>Kelas</th>
            <th>TTL</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $value)
            <tr>
                <td>{{ $value->nomor_induk ?? '-' }}</td>
                <td>{{ $value->name ?? '' }}</td>
                <td>{{ $value->email ?? '' }}</td>
                <td>{{ $value->phone ?? '' }}</td>
                <td>
                    <div class="chip chip-success">
                        <div class="chip-body">
                            <div class="chip-text">{{ $value->kelas->name ?? '' }}</div>
                        </div>
                    </div>
                    <div class="chip chip-success">
                        <div class="chip-body">
                            <div class="chip-text">{{ $value->kelas->jurusan ?? '' }}</div>
                        </div>
                    </div>
                </td>
                <td>{{ $value->ttl ?? '' }}</td>
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