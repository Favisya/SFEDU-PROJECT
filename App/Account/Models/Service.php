<?php

namespace App\Account\Models;

use App\Core\Exceptions\MvcException;
use App\Core\Models\AbstractService;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Service extends AbstractService
{
    private $xslx;
    private $spreadsheet;

    public function __construct(Spreadsheet $spreadsheet, Xlsx $xlsx)
    {
        $this->spreadsheet = $spreadsheet;
        $this->xslx        = $xlsx;
    }

    public function parseItem($item)
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

    public function getDate(): string
    {
        return date('d_m_o__H_i');
    }

    public function printToFile(AbstractModel $model, string $fileFormat): bool
    {
        $appRoot = APP_ROOT;
        $path = "{$appRoot}/var/output/{$model}_{$this->getDate()}.{$fileFormat}";

        if ($fileFormat == 'csv') {
            $this->handleCsv($path, $model);
        } elseif ($fileFormat == 'xlsx') {
            $this->handleXlsx($path, $model);
        } else {
            throw new MvcException('incorrect type');
        }

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

        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->fromArray($data);

        $this->xslx->save($path);
    }
}
