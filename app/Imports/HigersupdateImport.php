<?php

namespace App\Imports;

use App\Higer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class HigersupdateImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    public function __construct($status)
    {
        $this->status = $status;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        Higer::where('fol_form', $row['FOL_FORM'] ?? $row['fol_form'])
        ->update(['status' => $this->status]);
    }

    public function rules(): array
    {
        return [
            //'fam_id' => 'required|integer',
            //'claveofi' => 'required|integer',
            //'remesa' => 'required|string',
            '*.fol_form' => 'required|integer',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 700;
    }

    public function chunkSize(): int
    {
        return 700;
    }
}
