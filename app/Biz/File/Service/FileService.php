<?php

namespace App\Biz\File\Service;

use Illuminate\Http\File;

interface FileService
{
    /**
     * 移动文件到指定路径下
     * @param $file
     * @param $to
     * @return mixed
     */
    public function moveTo(File $file, $to);

    /**
     * 删除本地路径下的文件
     * @param $path
     * @return mixed
     */
    public function remove($path);
}
