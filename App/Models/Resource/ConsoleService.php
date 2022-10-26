<?php

namespace App\Models\Resource;

use App\Exceptions\MvcException;
use App\Models\AbstractModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ConsoleService extends Service
{
    public function printToFile(AbstractModel $model, string $fileFormat): bool
    {
        $path = APP_ROOT . "/var/output/" . $model . '_' . $this->getDate() . '.' . $fileFormat;

        if ($fileFormat == 'csv') {
            $this->handleCsv($path, $model);
        } elseif ($fileFormat == 'xlsx') {
            $this->handleXlsx($path, $model);
        } else {
            throw new MvcException('incorrect type');
        }

        echo 'All done!' . PHP_EOL;
        return true;
    }


    private function handleCsv(string $path, AbstractModel $model)
    {
        $stream = fopen($path, 'w+');
        foreach ($model->getList() as $item) {
            $data = $this->parseItem($item);
            fputcsv($stream, $data);
        }
        fclose($stream);
    }

    private function handleXlsx(string $path, AbstractModel $model)
    {
        $data = [];
        foreach ($model->getList() as $item) {
            $data[] = $this->parseItem($item);
        }

        $spreadSheet = new Spreadsheet();
        $sheet = $spreadSheet->getActiveSheet();
        $sheet->fromArray($data);

        $writer = new Xlsx($spreadSheet);
        $writer->save($path);
    }
}