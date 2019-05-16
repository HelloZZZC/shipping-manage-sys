<?php

namespace App\Biz\Importer;

use App\Biz\Importer\Factory\AliStandardImporter;
use App\Biz\Importer\Factory\ChinaPostImporter;
use App\Biz\Importer\Factory\EMailImporter;
use App\Common\Exception\InvalidArgumentException;

class ImporterFactory
{
    public static function createFactory($type)
    {
        if (!in_array($type, ['chinaPost', 'eMail', 'aliStandard'])) {
            throw new InvalidArgumentException('Invalid Type');
        }

        $factories = [
            'chinaPost' => ChinaPostImporter::class,
            'eMail' => EMailImporter::class,
            'aliStandard' => AliStandardImporter::class,
        ];


        return new $factories[$type](app());
    }
}
