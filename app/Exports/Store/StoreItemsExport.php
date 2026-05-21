<?php

namespace App\Exports\Store;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StoreItemsExport implements FromCollection, WithHeadings, WithMapping
{
    protected ?string $department;

    public function __construct(?string $department = null)
    {
        $this->department = $department;
    }

    public function collection()
    {
        $query = Store::query();
        if ($this->department) {
            $query->where('assigned_department', $this->department);
        }
        return $query->get();
    }

    public function headings(): array
    {
        return ['Item Name', 'Serial No', 'State', 'Created At', 'Updated At', 'Assigned Department'];
    }

    public function map($item): array
    {
        return [
            $item->item_name,
            $item->serial_no,
            $item->state,
            $item->created_at ? $item->created_at->format('d-M-Y') : '',
            $item->updated_at ? $item->updated_at->format('d-M-Y') : '',
            $item->assigned_department,
        ];
    }
}
