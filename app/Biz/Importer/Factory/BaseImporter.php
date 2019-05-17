<?php

namespace App\Biz\Importer\Factory;

use App\Biz\File\Service\FileService;
use App\Common\Exception\NotFoundException;
use Illuminate\Contracts\Foundation\Application;
use App\Component\BizAutoloader;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class BaseImporter
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Worksheet
     */
    protected $worksheet;

    protected $rowTotal;

    protected $colTotal;

    protected $startRow;

    protected $startCol;

    /**
     * 获取必要字段
     * @return mixed
     */
    abstract public function getRequiredFields();

    /**
     * 执行导入
     * @param $data
     * @return mixed
     */
    abstract public function execute($data);

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param UploadedFile $file
     * @throws NotFoundException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function import(UploadedFile $file)
    {
        $filePath = Storage::putFile('files/tmp', $file);
        $absolutePath = storage_path().'/app/'.$filePath;
        if (!is_file($absolutePath)) {
            throw new NotFoundException("Import File #{$absolutePath} Not Found");
        }

        $this->analyseFile($absolutePath);

        $requiredFields = $this->getRequiredFields();
        $data = $this->extractData($requiredFields);

        $this->execute($data);

        $this->getFileService()->remove($absolutePath);
    }

    /**
     * 提取excel中的数据
     * @param $requiredFields
     * @return array
     */
    protected function extractData($requiredFields)
    {
        $data = [];

        for ($row = $this->startRow; $row <= $this->rowTotal; ++$row) {
            $importData = [];
            for ($col = $this->startCol; $col <= $this->colTotal; ++$col) {
                $importData[$requiredFields[($col - 1)]] = $this->worksheet->getCellByColumnAndRow($col, $row)->getFormattedValue();
            }
            $data[] = $importData;
        }

        return $data;
    }

    /**
     * 解析导入的excel
     * @param $filePath
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    protected function analyseFile($filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $this->worksheet = $spreadsheet->getActiveSheet();
        $this->rowTotal = $this->worksheet->getHighestRow();
        $highestColumn = $this->worksheet->getHighestColumn();
        $this->colTotal = Coordinate::columnIndexFromString($highestColumn);
    }

    /**
     * 获取Biz\Service
     * @param $alias
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function createService($alias)
    {
        $autoloader = $this->app->make(BizAutoloader::class);

        return $autoloader->load('Service', $alias);
    }

    /**
     * @return FileService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getFileService()
    {
        return $this->createService('File:FileService');
    }
}
