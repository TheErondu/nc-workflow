<?php

namespace App\Exports\Issues;

use App\Models\IpAddress;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IpAddressesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return IpAddress::orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return ['Device Name', 'IP Address', 'Status', 'Created At'];
    }

    public function map($ip): array
    {
        return [
            $ip->device_name,
            $ip->address,
            $ip->in_use ? 'Assigned' : 'Unassigned',
            $ip->created_at ? $ip->created_at->format('d-M-Y') : '',
        ];
    }
}
