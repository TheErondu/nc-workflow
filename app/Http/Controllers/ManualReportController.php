<?php

namespace App\Http\Controllers;

use App\Models\ManualReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;

class ManualReportController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.reports.manual.index');
    }

    public function create()
    {
        $reportTypes = ManualReport::REPORT_TYPES;
        return view('dashboard.reports.manual.create', compact('reportTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'report_type' => 'required|in:' . implode(',', array_keys(ManualReport::REPORT_TYPES)),
            'content' => 'required|string',
            'report_date' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();

        ManualReport::create($validated);

        return redirect()->route('manual-reports.index')
            ->with('message', 'Report created successfully.');
    }

    public function show(ManualReport $manualReport)
    {
        return view('dashboard.reports.manual.show', compact('manualReport'));
    }

    public function edit(ManualReport $manualReport)
    {
        $reportTypes = ManualReport::REPORT_TYPES;
        return view('dashboard.reports.manual.edit', compact('manualReport', 'reportTypes'));
    }

    public function update(Request $request, ManualReport $manualReport)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'report_type' => 'required|in:' . implode(',', array_keys(ManualReport::REPORT_TYPES)),
            'content' => 'required|string',
            'report_date' => 'required|date',
        ]);

        $manualReport->update($validated);

        return redirect()->route('manual-reports.index')
            ->with('message', 'Report updated successfully.');
    }

    public function destroy(ManualReport $manualReport)
    {
        $manualReport->delete();

        return redirect()->route('manual-reports.index')
            ->with('message', 'Report deleted successfully.');
    }

    public function importFromWord(Request $request)
    {
        $request->validate([
            'word_file' => 'required|file|mimes:docx|max:5120',
        ]);

        $file = $request->file('word_file');
        $phpWord = IOFactory::load($file->getPathname());

        $content = '';
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                $content .= $this->extractTextFromElement($element);
            }
        }

        return response()->json([
            'success' => true,
            'content' => trim($content),
        ]);
    }

    private function extractTextFromElement($element): string
    {
        $text = '';

        // Handle Title elements
        if ($element instanceof \PhpOffice\PhpWord\Element\Title) {
            $textElement = $element->getText();
            if (is_string($textElement)) {
                $text .= $textElement . "\n\n";
            } elseif ($textElement instanceof \PhpOffice\PhpWord\Element\TextRun) {
                foreach ($textElement->getElements() as $child) {
                    if (method_exists($child, 'getText')) {
                        $text .= $child->getText();
                    }
                }
                $text .= "\n\n";
            }
        }
        // Handle TextRun elements
        elseif ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
            foreach ($element->getElements() as $child) {
                if (method_exists($child, 'getText')) {
                    $text .= $child->getText();
                }
            }
            $text .= "\n";
        }
        // Handle Text elements
        elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
            $text .= $element->getText() . "\n";
        }
        // Handle Table elements
        elseif ($element instanceof \PhpOffice\PhpWord\Element\Table) {
            foreach ($element->getRows() as $row) {
                $cells = [];
                foreach ($row->getCells() as $cell) {
                    $cellText = '';
                    foreach ($cell->getElements() as $cellElement) {
                        $cellText .= trim($this->extractTextFromElement($cellElement));
                    }
                    $cells[] = $cellText;
                }
                $text .= implode(' | ', $cells) . "\n";
            }
            $text .= "\n";
        }
        // Handle TextBreak elements
        elseif ($element instanceof \PhpOffice\PhpWord\Element\TextBreak) {
            $text .= "\n";
        }

        return $text;
    }

    public function downloadTemplate(Request $request)
    {
        $type = $request->get('type', 'director');
        $phpWord = new PhpWord();

        // Define styles
        $phpWord->addTitleStyle(1, ['bold' => true, 'size' => 18], ['spaceAfter' => 240]);
        $phpWord->addTitleStyle(2, ['bold' => true, 'size' => 14], ['spaceAfter' => 120]);

        $tableStyle = [
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80
        ];
        $phpWord->addTableStyle('ReportTable', $tableStyle);

        $headerStyle = ['bold' => true, 'bgColor' => 'CCCCCC'];
        $boldStyle = ['bold' => true];

        // Generate template based on type
        switch ($type) {
            case 'vision_mixer':
                $this->generateVisionMixerTemplate($phpWord, $headerStyle, $boldStyle);
                break;
            case 'graphics':
                $this->generateGraphicsTemplate($phpWord, $headerStyle, $boldStyle);
                break;
            case 'sto':
                $this->generateSTOTemplate($phpWord, $headerStyle, $boldStyle);
                break;
            case 'audio':
                $this->generateAudioTemplate($phpWord, $headerStyle, $boldStyle);
                break;
            default:
                $this->generateDirectorTemplate($phpWord, $headerStyle, $boldStyle);
                break;
        }

        $filename = str_replace(' ', '_', ManualReport::REPORT_TYPES[$type] ?? 'Manual_Report') . '_Template.docx';

        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend(true);
    }

    private function generateDirectorTemplate(PhpWord $phpWord, array $headerStyle, array $boldStyle): void
    {
        $section = $phpWord->addSection();

        $section->addTitle("Director's Log Report", 1);

        // Production Details
        $section->addTitle('Production Details', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Date', $boldStyle);
        $table->addCell(6000)->addText('[YYYY-MM-DD]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Producer', $boldStyle);
        $table->addCell(6000)->addText('[Enter Producer Name]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Anchor', $boldStyle);
        $table->addCell(6000)->addText('[Enter Anchor Name]');

        $section->addTextBreak();

        // Crew Assignment
        $section->addTitle('Crew Assignment', 2);
        $table = $section->addTable('ReportTable');

        $crew = [
            'Director' => '[Enter Name]',
            'Vision Mixer' => '[Enter Name]',
            'Engineer' => '[Enter Name]',
            'Sound Technician' => '[Enter Name]',
            'Camera Operator' => '[Enter Name]',
            'Camera Operator 2' => '[Enter Name]',
            'AutoCUE' => '[Enter Name]',
            'Graphics' => '[Enter Name]',
            'TX' => '[Enter Name]',
        ];

        foreach ($crew as $role => $value) {
            $table->addRow();
            $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText($role, $boldStyle);
            $table->addCell(6000)->addText($value);
        }

        $section->addTextBreak();

        // Bulletin Section
        $section->addTitle('Bulletin 1', 2);
        $section->addText('Bulletin Name: [Enter Bulletin Name]', $boldStyle);
        $section->addTextBreak();

        // Timing Table
        $section->addText('Timing Details', $boldStyle);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Timing', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('DTS', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Actual', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Variance', $boldStyle);

        $table->addRow();
        $table->addCell(2250)->addText('In Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $table->addRow();
        $table->addCell(2250)->addText('Out Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $section->addTextBreak();
        $section->addText('Comment:', $boldStyle);
        $section->addText('[Enter any comments or observations about this bulletin]');

        $section->addTextBreak(2);
        $section->addText('Report submitted by: [Your Name]');
    }

    private function generateVisionMixerTemplate(PhpWord $phpWord, array $headerStyle, array $boldStyle): void
    {
        $section = $phpWord->addSection();

        $section->addTitle('Vision Mixer Log Report', 1);

        // Production Details
        $section->addTitle('Production Details', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Date', $boldStyle);
        $table->addCell(6000)->addText('[YYYY-MM-DD]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Show/Program', $boldStyle);
        $table->addCell(6000)->addText('[Enter Show Name]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Vision Mixer', $boldStyle);
        $table->addCell(6000)->addText('[Enter Your Name]');

        $section->addTextBreak();

        // Equipment Status
        $section->addTitle('Equipment Status', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText('Equipment', $boldStyle);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText('Status', $boldStyle);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText('Notes', $boldStyle);

        $equipment = ['Switcher', 'Monitors', 'DVE'];
        foreach ($equipment as $item) {
            $table->addRow();
            $table->addCell(3000)->addText($item);
            $table->addCell(3000)->addText('OK / Issue');
            $table->addCell(3000)->addText('[Notes]');
        }

        $section->addTextBreak();

        // Segment Details
        $section->addTitle('Segment 1', 2);

        $table = $section->addTable('ReportTable');
        $table->addRow();
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Timing', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('DTS', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Actual', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Variance', $boldStyle);

        $table->addRow();
        $table->addCell(2250)->addText('In Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $table->addRow();
        $table->addCell(2250)->addText('Out Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $section->addTextBreak();
        $section->addText('Transitions Used: [Cut/Dissolve/Wipe/etc.]', $boldStyle);
        $section->addTextBreak();
        $section->addText('Comment:', $boldStyle);
        $section->addText('[Enter any comments about this segment]');

        $section->addTextBreak(2);
        $section->addText('Report submitted by: [Your Name]');
    }

    private function generateGraphicsTemplate(PhpWord $phpWord, array $headerStyle, array $boldStyle): void
    {
        $section = $phpWord->addSection();

        $section->addTitle('Graphics Log Report', 1);

        // Production Details
        $section->addTitle('Production Details', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Date', $boldStyle);
        $table->addCell(6000)->addText('[YYYY-MM-DD]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Show/Program', $boldStyle);
        $table->addCell(6000)->addText('[Enter Show Name]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Graphics Operator', $boldStyle);
        $table->addCell(6000)->addText('[Enter Your Name]');

        $section->addTextBreak();

        // Graphics Summary
        $section->addTitle('Graphics Summary', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(4000, ['bgColor' => 'CCCCCC'])->addText('Item', $boldStyle);
        $table->addCell(2500, ['bgColor' => 'CCCCCC'])->addText('Count', $boldStyle);
        $table->addCell(2500, ['bgColor' => 'CCCCCC'])->addText('Notes', $boldStyle);

        $items = ['Lower Thirds', 'Full Screen Graphics', 'OTS (Over-the-Shoulder)', 'Bumpers/Stingers'];
        foreach ($items as $item) {
            $table->addRow();
            $table->addCell(4000)->addText($item);
            $table->addCell(2500)->addText('[Number]');
            $table->addCell(2500)->addText('');
        }

        $section->addTextBreak();

        // Segment Details
        $section->addTitle('Segment 1', 2);
        $section->addText('Bulletin Name: [Enter Bulletin Name]', $boldStyle);
        $section->addTextBreak();

        $table = $section->addTable('ReportTable');
        $table->addRow();
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Timing', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('DTS', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Actual', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Variance', $boldStyle);

        $table->addRow();
        $table->addCell(2250)->addText('In Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $table->addRow();
        $table->addCell(2250)->addText('Out Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $section->addTextBreak();
        $section->addText('Comment:', $boldStyle);
        $section->addText('[Enter any comments]');

        $section->addTextBreak(2);
        $section->addText('Report submitted by: [Your Name]');
    }

    private function generateSTOTemplate(PhpWord $phpWord, array $headerStyle, array $boldStyle): void
    {
        $section = $phpWord->addSection();

        $section->addTitle('STO Log Report', 1);

        // Production Details
        $section->addTitle('Production Details', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Date', $boldStyle);
        $table->addCell(6000)->addText('[YYYY-MM-DD]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Shift', $boldStyle);
        $table->addCell(6000)->addText('[Morning/Afternoon/Evening]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('STO Operator', $boldStyle);
        $table->addCell(6000)->addText('[Enter Your Name]');

        $section->addTextBreak();

        // Equipment Check
        $section->addTitle('Equipment Check', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Equipment', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Pre-Show', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Post-Show', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Notes', $boldStyle);

        $equipment = ['Cameras', 'Lighting', 'Audio Console', 'Teleprompter', 'Intercom'];
        foreach ($equipment as $item) {
            $table->addRow();
            $table->addCell(2250)->addText($item);
            $table->addCell(2250)->addText('OK / Issue');
            $table->addCell(2250)->addText('OK / Issue');
            $table->addCell(2250)->addText('');
        }

        $section->addTextBreak();

        // Show Log
        $section->addTitle('Show 1', 2);
        $section->addText('Show Name: [Enter Show Name]', $boldStyle);
        $section->addTextBreak();

        $table = $section->addTable('ReportTable');
        $table->addRow();
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Timing', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('DTS', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Actual', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Variance', $boldStyle);

        $table->addRow();
        $table->addCell(2250)->addText('In Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $table->addRow();
        $table->addCell(2250)->addText('Out Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $section->addTextBreak();
        $section->addText('Comment:', $boldStyle);
        $section->addText('[Enter any comments]');

        $section->addTextBreak(2);
        $section->addText('Report submitted by: [Your Name]');
    }

    private function generateAudioTemplate(PhpWord $phpWord, array $headerStyle, array $boldStyle): void
    {
        $section = $phpWord->addSection();

        $section->addTitle('Audio Log Report', 1);

        // Production Details
        $section->addTitle('Production Details', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Date', $boldStyle);
        $table->addCell(6000)->addText('[YYYY-MM-DD]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Show/Program', $boldStyle);
        $table->addCell(6000)->addText('[Enter Show Name]');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'EEEEEE'])->addText('Sound Technician', $boldStyle);
        $table->addCell(6000)->addText('[Enter Your Name]');

        $section->addTextBreak();

        // Equipment Status
        $section->addTitle('Equipment Status', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText('Equipment', $boldStyle);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText('Status', $boldStyle);
        $table->addCell(3000, ['bgColor' => 'CCCCCC'])->addText('Notes', $boldStyle);

        $equipment = ['Audio Console', 'Microphones', 'IFB System', 'Audio Playback', 'Audio Levels'];
        foreach ($equipment as $item) {
            $table->addRow();
            $table->addCell(3000)->addText($item);
            $table->addCell(3000)->addText('OK / Issue');
            $table->addCell(3000)->addText('');
        }

        $section->addTextBreak();

        // Microphone Assignment
        $section->addTitle('Microphone Assignment', 2);
        $table = $section->addTable('ReportTable');

        $table->addRow();
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Position', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Mic Type', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Channel', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Notes', $boldStyle);

        $positions = ['Anchor 1', 'Anchor 2', 'Guest'];
        foreach ($positions as $pos) {
            $table->addRow();
            $table->addCell(2250)->addText($pos);
            $table->addCell(2250)->addText('[Lav/Desk]');
            $table->addCell(2250)->addText('[Ch #]');
            $table->addCell(2250)->addText('');
        }

        $section->addTextBreak();

        // Segment Details
        $section->addTitle('Segment 1', 2);
        $section->addText('Bulletin Name: [Enter Bulletin Name]', $boldStyle);
        $section->addTextBreak();

        $table = $section->addTable('ReportTable');
        $table->addRow();
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Timing', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('DTS', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Actual', $boldStyle);
        $table->addCell(2250, ['bgColor' => 'CCCCCC'])->addText('Variance', $boldStyle);

        $table->addRow();
        $table->addCell(2250)->addText('In Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $table->addRow();
        $table->addCell(2250)->addText('Out Time');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('00:00:00');
        $table->addCell(2250)->addText('+/- 0:00');

        $section->addTextBreak();
        $section->addText('Comment:', $boldStyle);
        $section->addText('[Enter any comments]');

        $section->addTextBreak(2);
        $section->addText('Report submitted by: [Your Name]');
    }
}
