@props(['nama', 'batch', 'tanggalKadaluarsa', 'sisaHari', 'stok', 'status'])

<tr class="table-row-hover">
    <td width="20%" style="padding: 12px; text-align: left; font-size: 15px; vertical-align: middle;">{{ $nama }}</td>
    <td width="15%" style="padding: 12px; text-align: center; font-size: 15px; vertical-align: middle;">{{ $batch }}</td>
    <td width="20%" style="padding: 12px; text-align: center; font-size: 15px; vertical-align: middle;">{{ $tanggalKadaluarsa }}</td>
    <td width="15%" style="padding: 12px; text-align: center; font-size: 15px; vertical-align: middle;">
        @if ($sisaHari < 0)
            <span style="color: var(--danger);">{{ $sisaHari }} hari</span>
            @elseif ($sisaHari <= 90)
                <span style="color: var(--warning);">{{ $sisaHari }} hari</span>
                @else
                {{ $sisaHari }} hari
                @endif
    </td>
    <td width="10%" style="padding: 12px; text-align: center; font-size: 15px; vertical-align: middle;">{{ $stok }}</td>
    <td width="20%" style="padding: 12px; text-align: center; font-size: 15px; vertical-align: middle;">
        @if ($status == 'Kadaluarsa')
        <div style="background-color: rgba(237, 30, 40, 0.1); border-radius: 20px; padding: 6px 12px; width: 160px; display: inline-block;">
            <span style="color: var(--danger); font-weight: normal; font-size: 14px;">Kadaluarsa</span>
        </div>
        @elseif ($status == 'Akan Kadaluarsa')
        <div style="background-color: rgba(255, 189, 7, 0.1); border-radius: 20px; padding: 6px 12px; width: 160px; display: inline-block;">
            <span style="color: var(--warning); font-weight: normal; font-size: 14px;">Akan Kadaluarsa</span>
        </div>
        @else
        <div style="background-color: rgba(10, 194, 117, 0.1); border-radius: 20px; padding: 6px 12px; width: 160px; display: inline-block;">
            <span style="color: var(--success); font-weight: normal; font-size: 14px;">Tersedia</span>
        </div>
        @endif
    </td>
</tr>