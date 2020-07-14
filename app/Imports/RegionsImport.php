<?php

namespace App\Imports;

ini_set('max_execution_time', 1200);

use App\Region;
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

class RegionsImport implements ToModel, WithHeadingRow, SkipsOnFailure, SkipsOnError, WithValidation,  WithBatchInserts, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        Region::firstOrCreate(
            ['id' => $row['CVE_REG'] ?? $row['cve_reg']],
            [
                'nameRegion' => $row['NOM_REG'] ?? $row['nom_reg'],
                'region' => $row['REGION'] ?? $row['region'],
            ]
        );
    }

    public function rules(): array
    {
        return [
            '*.cve_reg' => 'required|integer|unique:regions,id',
            '*.nom_reg' => 'required|string',
            '*.region' => 'required|integer',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 900;
    }

    public function chunkSize(): int
    {
        return 900;
    }
}
