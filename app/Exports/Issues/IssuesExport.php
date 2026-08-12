<?php

namespace App\Exports\Issues;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IssuesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $issues;

    public function __construct($issues)
    {
        $this->issues = $issues;
    }

    public function collection()
    {
        return $this->issues;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Date',
            'Location',
            'Raised By',
            'Department',
            'Status',
            'Fixed By',
            'Action Taken',
            'Cause of Breakdown',
            'Engineer Comment',
            'Resolved Date',
        ];
    }

    public function map($issue): array
    {
        return [
            $issue->item_name,
            $issue->description,
            $issue->date,
            $issue->location,
            $issue->raised_by,
            $issue->department,
            $issue->status,
            $issue->fixed_by,
            $issue->action_taken,
            $issue->cause_of_breakdown,
            $issue->engineers_comment,
            $issue->resolved_date,
        ];
    }
}
