<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Helpers\Contracts\HelperContract; 

class DataBatchImport implements ToCollection, WithHeadingRow
{
	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;            
    }
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $this->helpers->addToData($row); 
        }
    }
}

?>