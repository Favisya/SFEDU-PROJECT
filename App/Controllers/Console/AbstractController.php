<?php

namespace App\Controllers\Console;

use App\Models\AbstractModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

abstract class AbstractController
{
    private $fileFormat;

    public function printToFile(AbstractModel $model): bool
    {
        $fileFormat = $this->getFileFormat();
        $path = APP_ROOT . "/var/output/" . $model . '_' . $this->getDate() . '.' . $fileFormat;

        if ($fileFormat == 'csv') {
            $this->handleCsv($path, $model);
        } elseif ($fileFormat == 'xlsx') {
            $this->handleXlsx($path, $model);
        } else {
            echo 'Incorrect file format' . PHP_EOL;
            return false;
        }

        echo 'All done!' . PHP_EOL;
        return true;
    }

    public function setFileFormat(string $fileFormat): void
    {
        $this->fileFormat = $fileFormat;
    }

    public function getFileFormat(): string
    {
        return $this->fileFormat;
    }


    private function getDate(): string
    {
        $time = new \DateTime();
        return date('d_m_o__H_i', $time->getTimestamp());
    }

    private function parseItem($item)
    {
        $data = [];
        $keys = array_keys($item->getList());
        foreach ($keys as $key) {
            $keySplit = explode('_', $key);

            foreach ($keySplit as &$element) {
                $element = ucfirst($element);
            }

            $key = implode('', $keySplit);
            $data[$key] = $item->{'get' . $key}();
        }

        return $data;
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
