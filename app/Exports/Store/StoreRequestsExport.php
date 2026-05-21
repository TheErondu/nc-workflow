<?php

namespace App\Exports\Store;

use App\Models\StoreRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StoreRequestsExport implements FromCollection, WithHeadings, WithMapping
{
    protected string $status;
    protected ?int $userId;

    public function __construct(string $status, ?int $userId = null)
    {
        $this->status = $status;
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = StoreRequest::with(['user', 'store'])->where('status', $this->status);
        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }
        return $query->orderByDesc('created_at')->get();
    }

    public function headings(): array
    {
        return ['Date', 'Return By', 'Borrower', 'Item', 'Serial No', 'Status'];
    }

    public function map($request): array
    {
        return [
            $request->created_at ? $request->created_at->format('d-M-Y') : '',
            $request->return_date ? \Carbon\Carbon::parse($request->return_date)->format('d-M-Y') : '',
            $request->user->name ?? 'N/A',
            $request->item,
            $request->store->serial_no ?? 'N/A',
            $request->status,
        ];
    }
}
