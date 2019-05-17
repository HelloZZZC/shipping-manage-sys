<?php

namespace App\Biz\Importer;

use App\Biz\Importer\Factory\AliStandardImporter;
use App\Biz\Importer\Factory\BaseImporter;
use App\Biz\Importer\Factory\ChinaPostImporter;
use App\Biz\Importer\Factory\EMailImporter;
use App\Common\Exception\InvalidArgumentException;

class ImporterFactory
{
    /**
     * 根据type创建工厂instance
     * @param $type
     * @return BaseImporter
     * @throws InvalidArgumentException
     */
    public static function createFactory($type)
    {
        $factories = self::getFactories();

        $types = array_keys($factories);
        if (!in_array($type, $types)) {
            throw new InvalidArgumentException('Invalid Type');
        }

        return new $factories[$type](app());
    }

    /**
     * 需要创建的工厂
     * @return array
     */
    public static function getFactories()
    {
        return [
            'chinaPost' => ChinaPostImporter::class,
            'eMail' => EMailImporter::class,
            'aliStandard' => AliStandardImporter::class,
        ];
    }
}
