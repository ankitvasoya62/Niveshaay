<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\NewsletterUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;


class NewsletterUserImport implements ToModel,WithHeadingRow,WithValidation,SkipsOnFailure
{
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $collection)
    // {
    //     //
    // }
    use SkipsFailures;
    private $rows = 0;

    public function model(array $row){
        $matchThese = ['email'=>$row['email']];
        return NewsletterUser::updateOrCreate($matchThese,$row);
    }
    public function rules(): array
    {
        return [
            '*.email'=>['required','email'],
            
        ];
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
