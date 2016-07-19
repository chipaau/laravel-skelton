<?php 

namespace Chipaau\Versioning;

use Illuminate\Http\Request;
use Chipaau\Versioning\VersionException;

class ApiVersion {

    const DEFAULT_VERSION = 1;
    const DEFAULT_VERSION_NAMESPACE = 'V1';

    protected $request;
    protected $version;


    private static $valid_api_versions = [
        1 => 'V1',
        2 => 'V2',
    ];



    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->loadVersion();
    }

    /**
     * Resolve the requested api version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return integer
     */
    private function loadVersion() {
        if ($this->request->hasHeader('Api-Version')) {
            $version = strtoupper($this->request->header('Api-Version'));
            if (is_numeric($version)) {
                $this->version = $version;
            } elseif (in_array($version, self::$valid_api_versions)) {
                $this->version = intval(substr($version, 1));
            } else {
                $this->version = intval($version);
            }
        } else {
            $this->version = self::DEFAULT_VERSION;
        }
    }

    /**
     * Determines if a version is valid or not
     *
     * @param integer $apiVersion
     * @return bool
     */
    private static function isValid($apiVersion) {
        return in_array(
            $apiVersion,
            array_keys(self::$valid_api_versions)
        );
    }

    /**
     * Resolve namespace for a api version
     *
     * @param integer $apiVersion
     * @return string
     */
    public function getVersion()
    {
        if (!self::isValid($this->version)) {
            throw new VersionException("Invalid verson number supplied");
        }
        return self::$valid_api_versions[$this->version];
    }

}