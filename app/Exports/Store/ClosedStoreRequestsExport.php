<?php

namespace App\Exports\Store;

use App\Models\StoreRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClosedStoreRequestsExport implements FromCollection, WithHeadings, WithMapping
{
    protected int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        return StoreRequest::where('status', '!=', 'Pending')
            ->where('user_id', $this->userId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function headings(): array
    {
        return ['Status', 'Due Date', 'Requested Date', 'Requested Item'];
    }

    public function map($request): array
    {
        return [
            $request->status,
            $request->return_date ? \Carbon\Carbon::parse($request->return_date)->format('d-M-Y') : '',
            $request->created_at ? $request->created_at->format('d-M-Y') : '',
            $request->item,
        ];
    }
}
