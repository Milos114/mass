<?php

namespace App\Imports;

use App\Events\ImportFailedEvent;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class OrdersImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation, SkipsOnFailure, ShouldQueue
{
    use SkipsFailures;

    public function __construct(private string $fileType)
    {
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Order::updateOrCreate([
            'sku' => $row['sku'],
            'so_num' => $row['so_num'],
        ], [
            'order_date' => $row['order_date'],
            'channel' => $row['channel'],
            'item_description' => $row['item_description'],
            'origin' => $row['origin'],
            'coast' => $row['coast'],
            'shipping_cost' => $row['shipping_cost'],
            'total_price' => $row['total_price'],
            'sku' => $row['sku'],
            'so_num' => $row['so_num'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        $rules = config("mass.orders.files.$this->fileType.headers_to_db");

        return [
            'order_date' => $rules['order_date']['validation'],
            'channel' => [
                $rules['channel']['validation'][0],
                Rule::in($rules['channel']['validation']['in'])
            ],
            'sku' => [
                $rules['sku']['validation'][0],
                Rule::exists(
                    $rules['sku']['validation']['exists']['table'],
                    $rules['sku']['validation']['exists']['column']
                )
            ],
            'item_description' => $rules['item_description']['validation'],
            'origin' => $rules['origin']['validation'],
            'so_num' => $rules['so_num']['validation'],
            'coast' => $rules['coast']['validation'],
            'shipping_cost' => $rules['shipping_cost']['validation'],
            'total_price' => $rules['total_price']['validation'],
        ];
    }

    public function onFailure(Failure ...$failures): void
    {
        foreach ($failures as $failure) {
            DB::table('failed_imports')->insert([
                'import_name' => $this->fileType,
                'row_number' => $failure->row(),
                'column_name' => $failure->attribute(),
                'error_message' => $failure->errors()[0],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        event(new ImportFailedEvent());
    }
}
