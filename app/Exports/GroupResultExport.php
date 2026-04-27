<?php

namespace App\Exports;

use App\Models\GroupMember;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GroupResultExport implements FromArray, ShouldAutoSize, WithStyles
{
    protected $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function array(): array
    {
        $members = GroupMember::where('group_session_id', $this->sessionId)
            ->orderBy('nomor_kelompok')
            ->get();

        $data = [];

        $currentGroup = null;

        foreach ($members as $member) {
            $student = Student::find($member->student_id);

            if ($currentGroup !== $member->nomor_kelompok) {
                if ($currentGroup !== null) {
                    $data[] = [];
                }

                $currentGroup = $member->nomor_kelompok;

                $data[] = ["Kelompok {$currentGroup}", '', ''];
                $data[] = ['Nama', 'NPM', 'Kelas'];
            }

            $data[] = [
                $student->nama,
                $student->npm,
                $student->kelas,
            ];
        }

        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();

        for ($row = 1; $row <= $highestRow; $row++) {
            $cellValue = $sheet->getCell("A{$row}")->getValue();

            if (str_starts_with($cellValue ?? '', 'Kelompok')) {
                $sheet->mergeCells("A{$row}:C{$row}");

                $sheet->getStyle("A{$row}:C{$row}")->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle("A{$row}:C{$row}")->getAlignment()->setHorizontal('center');
            }

            if ($cellValue === 'Nama') {
                $sheet->getStyle("A{$row}:C{$row}")->getFont()->setBold(true);
                $sheet->getStyle("A{$row}:C{$row}")->getBorders()->getAllBorders()->setBorderStyle('thin');
            }
        }

        $sheet->getStyle("A1:C{$highestRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle('thin');

        return [];
    }
}