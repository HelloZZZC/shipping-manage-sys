<?php

namespace App\Biz\File\Service\Impl;

use App\Biz\File\Service\FileService;
use App\Common\Exception\InvalidArgumentException;
use Illuminate\Http\File;

class FileServiceImpl implements FileService
{
    /**
     * @param File $file
     * @param $to
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function moveTo(File $file, $to)
    {
        if (!$file->isFile()) {
            throw new InvalidArgumentException("上传无效的文件");
        }

        if (!is_dir($to)) {
            mkdir($to, 0777, true);
        }

        $file = $file->move($to);

        return $file->getPath();
    }

    /**
     * @param $path
     * @return mixed|void
     */
    public function remove($path)
    {
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}
