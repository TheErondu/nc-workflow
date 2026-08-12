<?php

namespace App\Exports\Store;

use App\Models\BatchStoreRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BatchStoreRequestsExport implements FromCollection, WithHeadings, WithMapping
{
    protected string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function collection()
    {
        return BatchStoreRequest::with('user')
            ->where('status', $this->status)
            ->orderByDesc('created_at')
            ->get();
    }

    public function headings(): array
    {
        return ['Date', 'Batch ID', 'Item Count', 'Requestor', 'Return Date', 'Status'];
    }

    public function map($batch): array
    {
        $itemCount = 0;
        if ($batch->items) {
            $decoded = json_decode($batch->items);
            $itemCount = is_array($decoded) ? count($decoded) : 0;
        }

        return [
            $batch->created_at ? $batch->created_at->format('d-M-Y') : '',
            $batch->batch_id,
            $itemCount,
            $batch->user->name ?? 'N/A',
            $batch->return_date ? \Carbon\Carbon::parse($batch->return_date)->format('d-M-Y') : '',
            $batch->status,
        ];
    }
}
